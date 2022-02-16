<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;
use \Firebase\JWT\JWT;

class Rest extends REST_Controller {
	protected $jwt;
	protected $rest;
	protected $post;
	protected $halt;
	
	protected $response_000;
	protected $response_100;
	protected $response_401;

	protected $api_rsp;
	protected $api_err;
	protected $api_usr;

	public 		function __construct() {
		parent::__construct();
		$this->load->model('api/Mapi', 'mapi');
		$this->mapi->sync($this->api_err);
		$this->config->load('jwt', true);
		$this->jwt	= $this->config->item('jwt');

		$this->response_000 = array(
			'status_code' => '000',
			'data'  => array(
				'msg'    => 'Success'
			)
		);
		$this->response_100 = array(
			'status_code' => '100',
			'data'  => array(
				'msg'    => 'Incorrect / Insufficient Parameter'
			)
		);
		$this->response_401 = array(
			'status_code' => '401',
			'data'  => array(
				'msg'    => 'Incorrect Authorization | Incorrect UserID and/or Password  | Token Expire'
			)
		);
		
		$this->post     = $this->input->post();
		$this->halt     = array();
		$this->api_err  = false;
		// $this->auth_ip();
		$this->auth_token();
		$this->auth_customer();
	}
	public      function __destruct() {
		if($this->api_rsp) {
			$dat = array('response' => $this->api_rsp, 'aaa_account_id' => $this->api_usr);
			$this->mapi->set_log_response($this->_insert_id, $dat);
		}
		if($this->api_err || (isset($this->api_rsp['status_code']) &&  $this->api_rsp['status_code']!= '000'))
			$this->trx_log();
		
		parent::__destruct(); // TODO: Change the autogenerated stub
	}
	// method untuk melihat token pada user
	protected   function token_request() {
		$time = time();
		$user = $this->config->item('rest_valid_logins');
		$auth = array('user' => false, 'authorization' => false);
		if(isset($user[$this->post['cpid']]))  {
			$auth['user'] = true;
			if (password_verify($this->post['cpassword'], $user[$this->post['cpid']])) {
				$this->api_usr       = $this->post['cpid'];
				$payload['usr']      = $this->post['cpid'];
				$payload['iat']      = $time;
				$payload['exp']      = $time + $this->jwt['tto'];
				$auth['authorization']	= JWT::encode($payload, $this->jwt['key']);
			}
		}
		return $auth;
	}
	private     function token_updated($user, $key) {
		$this->db->update('sys_api_keys', $key, array('aaa_account_id' => $user));
	}
	protected   function token_request_aaa() {
		$time = time();
		$user = $this->db->get_where('aaa_account', array('id_code' => $this->post['cpid']))->row_array();
		
		$auth = array('user' => false, 'authorization' => false);
		if($user && isset($user['id_code']) && $user['id_code'] == $this->post['cpid'])  {
			$auth['user'] = true;
			if (password_verify($this->post['cpassword'], $user['credential'])) {
				$this->rest->user_id = $user['id'];
				$payload['usr']      = $this->post['cpid'];
				$payload['iat']      = $time;
				$payload['exp']      = $time + $this->jwt['tto'];
				$auth['authorization']	= JWT::encode($payload, $this->jwt['key']);
				
				$this->token_updated($user['id'], $auth['authorization']);
			}
		}
		return $auth;
	}
	
	private     function auth_ip() {
		$whitelist = explode(',', $this->config->item('rest_ip_whitelist'));
		array_push($whitelist, '127.0.0.1', '0.0.0.0');

		foreach ($whitelist as &$ip) {
			// As $ip is a reference, trim leading and trailing whitespace, then store the new value
			// using the reference
			$ip = trim($ip);
		}
		$myIP = $this->input->ip_address();
		// dump($myIP, '#');
		if (in_array($myIP, $whitelist) === FALSE) {
			$this->halt = $this->response_401;
			$this->halt['data']['msg'] = 'Unauthorized IP';
		}
	}
	private     function auth_token() {
		if(!$this->halt) {
			$auth = $this->input->get_request_header('authorization');
			if (empty($auth)) {
				$this->halt = array(
					'status_code' => '401',
					'data' => array(
						'msg' => 'Incorrect Authorization'
					)
				);
			}
			try {
				$load = JWT::decode($auth, $this->jwt['key'], array($this->jwt['alg']));
				if ($load) {
					$user = $this->config->item('rest_valid_logins');
					if (!isset($user[$load->usr])) {
						$this->halt = array(
							'status_code' => '401',
							'data' => array(
								'msg' => 'Incorrect Authorization'
							)
						);
					}
					else {
						$this->api_usr = $load->usr;
					}
					if (isset($load->exp) && $load->exp < time()) {
						$this->halt = array(
							'status_code' => '401',
							'data' => array(
								'msg' => 'Token Expire'
							)
						);
					}
				}
				else {
					$this->halt = array(
						'status_code' => '401',
						'data' => array(
							'msg' => 'Incorrect Authorization'
						)
					);
				}
			} catch (\Exception $e) {
				$this->halt = array(
					'status_code' => '401',
					'data' => array(
						'msg' => 'Token Expire'
					)
				);
			}
		}
	}
	
	private		function auth_customer() {
		if(!$this->halt) {
			if (isset($this->post['customer_id'])) {
				$this->post['customer_id'] = (int)$this->post['customer_id'];
			}
		}
	}
	protected	function auth_check($bypass=null) {
		$ack = true;
		if($this->halt) {
			$this->api_rsp = $this->halt;
			if($bypass && in_array($this->halt['status_code'], explode(',', $bypass)))
				$ack = true;
			else {
				$ack = false;
				if($this->halt['status_code'] == '401')
					$this->set_response($this->halt, REST_Controller::HTTP_UNAUTHORIZED);
				else
					$this->set_response($this->halt, REST_Controller::HTTP_OK);
			}
		}
		return $ack;
	}
	
	protected   function trx_log() {
		$dt = date('Ymd');
		$fp = fopen(FCPATH."/logs/trx_log-$dt.txt", 'a');
		fwrite($fp, PHP_EOL);
		fwrite($fp, date('Y-m-d H:i:s'));
		fwrite($fp, PHP_EOL);
		fwrite($fp, $this->uri->uri_string());
		fwrite($fp, PHP_EOL);
		fwrite($fp, json_encode($this->_args, JSON_PRETTY_PRINT ));
		fwrite($fp, PHP_EOL);
		$content = file_get_contents('php://input');
		if($content) {
			if (is_string($content))
				fwrite($fp, $content);
			else if (is_array($content))
				fwrite($fp, json_encode($content, JSON_PRETTY_PRINT));
			fwrite($fp, PHP_EOL);
		}
		fwrite($fp, json_encode($this->api_rsp, JSON_PRETTY_PRINT ));
		fwrite($fp, PHP_EOL);
		fclose($fp);
	}
}
