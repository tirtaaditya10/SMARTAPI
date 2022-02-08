<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . 'controllers/api/Rest.php';
class Sms extends Rest {
	private $uname;
	private	$upswd;

	public function __construct() {
		parent::__construct();
		$this->uname = 'wyeth.nestle';
		$this->upswd = '123456789';
		$this->response_140 = array(
			'status_code' => '140',
			'data'  => array(
				'msg'    => 'SMS Sent Error'
			)
		);
	}

	#API SMS_SEND
	public 		function send_post() {
		if($this->auth_check('110')) {
			if (!empty($this->post['customer_telp']) && !empty($this->post['sms_content'])) {
				$url = "http://103.16.199.187/masking/send_post.php";
				$dat = array(
					'username' 	=> $this->uname,
					'password' 	=> $this->upswd,
					'hp' 		=> $this->post['customer_telp'],
					'message' 	=> $this->post['sms_content']
				);
				$ref = curl_post($url, $dat);

				if ($ref == -1) {
					$response = $this->response_140;
				}
				else {
					$rsp = array(
						'customer_telp' => $this->post['customer_telp'],
						'sms_ref' 		=> $ref,
						'sms_rsp' 		=> 'Success Send',
						'sms_status_id' => 3,
						'sms_status' 	=> 'Sent to Telco'
					);

					$response               = $this->response_000;
					$response['data']       = $rsp;
					
					$this->post['sms_ref']  = $ref;
					$this->post['sms_rsp']  = isset($rsp['sms_rsp']) ? $rsp['sms_rsp'] : 0;
					if(!empty($this->post['customer_id']))
						$this->mapi->sms_send($this->post);
				}
			}
			else
				$response = $this->response_100;
			$this->set_response($response, REST_Controller::HTTP_OK);
		}
	}
	
	/*
	public 		function status_post() {
		$err = false;
		$pst = file_get_contents('php://input');
		$arr = json_decode($pst, true);
		
		switch (json_last_error()) {
			case JSON_ERROR_NONE:
				$this->mapi->sms_report($arr);
				break;
			case JSON_ERROR_DEPTH:
				$err = ' - Maximum stack depth exceeded';
				break;
			case JSON_ERROR_STATE_MISMATCH:
				$err =  ' - Underflow or the modes mismatch';
				break;
			case JSON_ERROR_CTRL_CHAR:
				$err =  ' - Unexpected control character found';
				break;
			case JSON_ERROR_SYNTAX:
				$err =  ' - Syntax error, malformed JSON';
				break;
			case JSON_ERROR_UTF8:
				$err =  ' - Malformed UTF-8 characters, possibly incorrectly encoded';
				break;
			default:
				$err = ' - Unknown error';
				break;
		}
		if($err) {
			$log = fopen("logs/sms_status.txt", "a") or die("Unable to open file!");
			fwrite($log, date('Y-m-d H:i:s'));
			fwrite($log, "\narr: ");
			fwrite($log, json_encode($arr, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT));
			fwrite($log, "\nerr: ");
			fwrite($log, $err);
			fwrite($log, "\nstring: ");
			fwrite($log, $pst);
			fwrite($log, "\n");
			fclose($log);
		}
	}
	*/
	public 		function status_get($ref, $just_send=0) {
		if($just_send) {
			$dat = array(
				'customer_telp' => 0,
				'sms_ref' => $ref,
				'sms_rsp' => 'Success Send',
				'sms_status_id' => 3,
				'sms_status' => 'Sent to Telco'
			);
			return $dat;
		}
		else {
			$url = "http://103.16.199.187/masking/report.php?rpt=$ref";
			$xx1 = curl_get($url);
			$xx2 = explode(',', $xx1);
			$ref = $xx2[0];
			switch ($ref) {
				case 22:
					$dat = array(
						'sms_ref' => $ref,
						'sms_status_id' => 0,
						'sms_status' => 'Delivered'
					);
					break;
				case 20:
					$dat = array(
						'sms_ref' => $ref,
						'sms_status_id' => 1,
						'sms_status' => 'Pending. Pesan terkirim, nomor tujuan / handphone tidak aktif dalam waktu tertentu'
					);
					break;
				default:
					$dat = array(
						'sms_ref' => $ref,
						'sms_status_id' => 2,
						'sms_status' => "Failed. $rsp"
					);
					if ($rsp == 52)
						$dat['sms_status'] .= '. Wrong format phone number';
					break;
			}
			
			$response = $this->response_000;
			$response['data'] = $dat;
			$this->set_response($response, REST_Controller::HTTP_OK);
		}
	}
	public		function saldo_get() {
		$url = "http://103.16.199.187/masking/balance.php?username=$this->uname&password=$this->upswd";
		$rsp =  curl_get($url);
		$this->set_response($rsp, REST_Controller::HTTP_OK);
	}
    public 		function report_post() {
        $url = "http://103.16.199.187/masking/reports_post.php";
        $dat = array(
            'username' 	=> $this->uname,
            'password' 	=> $this->upswd,
            'start'     => $this->post['start'],
            'end' 	    => $this->post['end']
        );
        $ref = curl_post($url, $dat);
        $this->set_response($ref, REST_Controller::HTTP_OK);
    }
}
