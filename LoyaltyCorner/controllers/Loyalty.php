<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . 'controllers/api/Rest.php';
class Loyalty extends Rest {
    public 		function __construct() {
		parent::__construct();
		
		$this->response_101 = array(
			'status_code' => '101',
			'data'  => array(
				'msg'    => 'Unknown / Invalid Resource'
			)
		);
	    $this->response_110 = array(
		    'status_code' => '110',
		    'data'  => array(
			    'msg'    => 'Customer Is Not Exist'
		    )
	    );
	    $this->response_111 = array(
		    'status_code' => '111',
		    'data'  => array(
			    'msg'    => 'Customer Is Not Member'
		    )
	    );
	    $this->response_112 = array(
		    'status_code' => '112',
		    'data'  => array(
			    'msg'    => 'Address Shipping not Available'
		    )
	    );
	    $this->response_113 = array(
		    'status_code' => '113',
		    'data'  => array(
			    'msg'    => 'Address Shipping Registration Failed'
		    )
	    );
		$this->response_120 = array(
			'status_code' => '120',
			'data'  => array(
				'msg'    => 'Registration Customer Failed'
			)
		);
		$this->response_121 = array(
			'status_code' => '121',
			'data'  => array(
				'msg'    => 'Registration Customer Rejected, Mam/Dad and Child already registered'
			)
		);
		$this->response_130 = array(
			'status_code' => '130',
			'data'  => array(
				'msg'    => 'Upload Error'
			)
		);
	    $this->response_180 = array(
		    'status_code' => '180',
		    'data'  => array(
			    'msg'    => 'SMS Sent Error'
		    )
	    );
	    $this->response_140 = array(
		    'status_code' => '140',
		    'data'  => array(
			    'msg'    => 'Customer belum pernah meng-upload Struk'
		    )
	    );
	    
	    $this->response_160 = array(
		    'status_code' => '160',
		    'data'  => array(
			    'msg'    => 'Reward not Available'
		    )
	    );
	    $this->response_170 = array(
		    'status_code' => '170',
		    'data'  => array(
			    'msg'    => 'Redeem Failed'
		    )
	    );
	    $this->response_171 = array(
		    'status_code' => '171',
		    'data'  => array(
			    'msg'    => 'Redeem Failed. Reward sudah tidak tersedia'
		    )
	    );
	    $this->response_172 = array(
		    'status_code' => '172',
		    'data'  => array(
			    'msg'    => 'Redeem Failed. Saldo Poin and Sendok tidak mencukupi'
		    )
	    );
	    $this->response_173 = array(
		    'status_code' => '173',
		    'data'  => array(
			    'msg'    => 'Redeem Failed. Saldo Poin tidak mencukupi'
		    )
	    );
	    $this->response_174 = array(
		    'status_code' => '174',
		    'data'  => array(
			    'msg'    => 'Redeem Failed. Saldo Sendok tidak mencukupi'
		    )
	    );
	    $this->response_175 = array(
		    'status_code' => '175',
		    'data'  => array(
			    'msg'    => 'Redeem Failed. Telah melewati batas jumlah maksimum per jenis reward'
		    )
	    );
            $this->response_176 = array(
		    'status_code' => '176',
		    'data'  => array(
			    'msg'    => 'Store List error.'
		    )
	    );

	}
	
	public      function index_post() {
		$cmd = $this->input->get_request_header('command');
    	if($cmd) {
    		if(method_exists($this, $cmd))
    			$this->$cmd();
    		else {
			    $this->api_rsp = $this->response_101;
			    $this->set_response($this->api_rsp, REST_Controller::HTTP_BAD_REQUEST);
		    }
	    }
	    else {
		    $this->api_rsp = $this->response_101;
		    $this->set_response($this->api_rsp, REST_Controller::HTTP_BAD_REQUEST);
	    }
	}
	
	#1 API REQUEST_TOKEN
    private 	function request_token() {
   	    if(!empty($this->post['cpid']) && !empty($this->post['cpassword'])) {
			$rst = $this->token_request();
	        if($rst['authorization']) {
		        $this->api_rsp = array(
			        'status_code' => '000',
			        'data' => array(
				        'authorization' => $rst['authorization']
			        )
		        );
		        $this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
	        }
	        else {
		        $this->api_rsp = $this->response_401;
		        $this->api_rsp['data']['msg'] = 'Incorrect UserID and/or Password';
		        $this->set_response($this->api_rsp, REST_Controller::HTTP_UNAUTHORIZED);
	        }
	    }
        else {
			$this->api_rsp = $this->response_100;
			$this->set_response($this->api_rsp, REST_Controller::HTTP_BAD_REQUEST);
		}
    }
	
	#2 API MEMBER_STATUS
    private 	function member_status() {
    	if($this->auth_check()) {
		    if (!empty($this->post['customer_id'])) {
			    $rst = $this->mapi->member_status($this->post);
			    if (!empty($rst['customer_id']) && !empty($rst['member_id'])) {
				    $this->api_rsp = array(
					    'status_code' => '000',
					    'data' => array(
						    'msg' => 'Registered as Member',
						    'customer_id' => $rst['customer_id'],
						    'member_id' => $rst['member_id']
					    )
				    );
			    }
			    elseif (!empty($rst['customer_id']) && empty($rst['member_id'])) {
				    $this->api_rsp = array(
					    'status_code' => '000',
					    'data' => array(
						    'msg' => 'Registered as Customer',
						    'customer_id' => $rst['customer_id']
					    )
				    );
			    }
			    else
				    $this->api_rsp = $this->response_110;
		    }
		    else
			    $this->api_rsp = $this->response_100;
		    $this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
	    }
    }
	
	#3 API MEMBER_REGISTER (POST DATA)
	private 	function member_register() {
 	    if($this->auth_check('110')) {
		    if (!empty($this->post['customer_name']) && !empty($this->post['customer_telp']) && !empty($this->post['child_name']) && !empty($this->post['child_dob'])) {
			    $rst = $this->mapi->member_register($this->post);
			    if ($rst) {
				    if (!empty($rst['mom_id']) && !empty($rst['chd_id'])) {
					    $this->api_rsp = $this->response_121;
					    $this->api_rsp['data']['customer_id'] = $rst['customer_id'];
				    }
				    else {
					    $msg = '';
					    if (isset($rst['mom_id']))
						    $msg .= ', Mom/Dad already registered';
					    else
						    $msg .= ', New Customer registered';
					
					    if (isset($rst['chd_id']))
						    $msg .= ', Child already registered';
					    else
						    $msg .= ', New Child registered';
					    $this->api_rsp = array(
						    'status_code' => '000',
						    'data' => array(
							    'msg' => "Success{$msg}",
							    'customer_id' => $rst['customer_id']
						    )
					    );
				    }
			    }
			    else
				    $this->api_rsp = $this->response_120;
		    }
		    else
			    $this->api_rsp = $this->response_100;
		
		    $this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
	    }
    }

	#4 API MEMBER INFO
	private 	function member_info() {
	    if($this->auth_check()) {
		    if (!empty($this->post['customer_id'])) {
			    $rst = $this->mapi->member_info($this->post);
			    if ($rst) {
				    $this->api_rsp = $this->response_000;
				    $this->api_rsp['data'] = $rst;
			    }
			    else
				    $this->api_rsp = $this->response_110;
		    }
		    else
			    $this->api_rsp = $this->response_100;
		
		    $this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
	    }
    }

	#5 API POINT_INFO
	private		function point_info() {
	    if($this->auth_check()) {
		    if (!empty($this->post['customer_id'])) {
			    $rst = $this->mapi->member_point($this->post);
			    if ($rst) {
				    $this->api_rsp = $this->response_000;
				    $this->api_rsp['data'] = $rst;
				    //if (!$rst['member_id'])
					//    $this->api_rsp['data']['member_id'] = 'Not a Member';
			    }
			    else
				    $this->api_rsp = $this->response_110;
		    }
		    else
			    $this->api_rsp = $this->response_100;
		
		    $this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
	    }
    }

	#6 API POINT_HISTORY
	private		function point_history() {
		if($this->auth_check()) {
			if (!empty($this->post['customer_id'])) {
				$rst = $this->mapi->member_point_history($this->post);
				if($this->api_err)
					$this->check_err();
				else {
					if(!$rst) {
						$rst = array('customer_id' => $this->post['customer_id'],
						             'member_id' => null,
						             'point_expire_this_month' => 0,
						             'point_expire_next_month' => 0,
						             'history' => array());
						$rst = array();
					}
					$this->api_rsp         = $this->response_000;
					$this->api_rsp['data'] = $rst;
				}
			}
			else
				$this->api_rsp = $this->response_100;
			
			$this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
		}
	}

	# API RECEIPT_STATUS
	private 	function receipt_status() {
	    if($this->auth_check()) {
		    if (!empty($this->post['customer_id'])) {
			    $rst = $this->mapi->receipt_status($this->post);
			    if ($rst) {
				    $this->api_rsp = $this->response_000;
				    $this->api_rsp['data'] = $rst;
			    }
			    else
				    $this->api_rsp = $this->response_110;
		    }
		    else
			    $this->api_rsp = $this->response_100;
		
		    $this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
	    }
    }

	#7 API RECEIPT_UPLOAD
	private function receipt_upload() {
	    $file_name  = '';
	    $err_msg    = $this->check_upload($file_name);
	    if (!$err_msg) {
		    if ($this->auth_check()) {
			    $file = $_FILES;
			    if (!empty($this->post['customer_id']) && !empty($file['receipt_file'])) {
				    $rst = $this->mapi->receipt_upload($this->post, $file_name);
				    if ($rst)
					    $this->api_rsp = array(
						    'status_code' => '000',
						    'data' => array(
							    'msg' => 'Receipt Uploaded',
							    'customer_id' => $rst['customer_id'],
							    'receipt_ref' => $this->post('receipt_ref'),
							    'receipt_date' => date('Y-m-d H:i', time()),
							    'receipt_process' => 'PENDING',
							    'receipt_status_id' => 0,
							    'receipt_status' => 'Uploaded, pending for review'
						    )
					    );
				    else
					    $this->api_rsp = $this->response_110;
			    }
			    else
				    $this->api_rsp = $this->response_100;
			
			    $this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
		    }
	    }
	    else {
		    $this->api_rsp = $this->response_130;
		    $this->api_rsp['data']['msg'] .= ", $err_msg";
		    $this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
	    }
    }

	#8 API RECEIPT_HISTORY
	private 	function receipt_history() {
		if($this->auth_check()) {
			if (!empty($this->post['customer_id'])) {
				$rst = $this->mapi->receipt_history($this->post);
				if ($rst) {
					$this->api_rsp = array(
						'status_code' => '000',
						'customer_id' => $this->post['customer_id'],
						'data' => $rst
					);
				}
				else {
					$this->api_rsp = $this->response_140;
					$this->api_rsp['data']['msg'] = 'Customer belum pernah meng-upload Struk';
				}
			}
			else
				$this->api_rsp = $this->response_100;
			
			$this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
		}
	}
	
	#9 API SMS SEND
	private 	function sms_send() {
		$uname = 'wyeth.nestle';
		$upswd = '123456789';
		
		if($this->auth_check('110')) {
			if (!empty($this->post['customer_telp']) && !empty($this->post['sms_content'])) {
				$url = "http://103.16.199.187/masking/send_post.php";
				$dat = array(
					'username' 	=> $uname,
					'password' 	=> $upswd,
					'hp' 		=> $this->post['customer_telp'],
					'message' 	=> $this->post['sms_content']
				);
				$ref = curl_post($url, $dat);
				
				if ($ref == -1) {
					$response = $this->response_180;
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
	
	#10 API ADDRESS-SHIPPING-INFO
	private 	function address_shipping_info() {
		if($this->auth_check()) {
			if (!empty($this->post['customer_id'])) {
				$rst = $this->mapi->address_shipping_info($this->post);
				$mid = $rst['member_id'];
				unset($rst['member_id']);
				if ($mid) {
					if ($rst) {
						$this->api_rsp = $this->response_000;
						$this->api_rsp['data'] = $rst;
					}
					else
						$this->api_rsp = $this->response_112;
				}
				else
					$this->api_rsp = $this->response_111;
			}
			else
				$this->api_rsp = $this->response_100;
			
			$this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
		}
	}
	
	#11 API ADDRESS SHIPPING (POST DATA)
	private 	function address_shipping() {
		if($this->auth_check()) {
			if (!empty($this->post['customer_id']) && !empty($this->post['address_type']) && !empty($this->post['address']) && !empty($this->post['city_id']) && !empty($this->post['province_id'])) {
				$rst = $this->mapi->address_shipping($this->post);
				if ($rst) {
					$this->api_rsp = $this->response_000;
					$this->api_rsp['data'] = $rst;
				}
				else
					$this->api_rsp = $this->response_113;
			}
			else
				$this->api_rsp = $this->response_100;
			
			$this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
		}
	}
	
	#12 API REWARD_INFO
	private 	function reward_info() {
		if($this->auth_check()) {
			$rst = $this->mapi->reward_info($this->post);
			if ($rst) {
				$this->api_rsp = $this->response_000;
				$this->api_rsp['data'] = $rst;
			}
			else
				$this->api_rsp = $this->response_160;
			
			$this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
		}
	}
	
	#13 API REDEEM-REQUEST (POST DATA)
	private 	function redeem_request() {
    	$ack        = false;
		if($this->auth_check()) {
			if (!empty($this->post['customer_id']) && !empty($this->post['address_id']) && !empty($this->post['reward_id']) && !empty($this->post['reward_qty'])) {
				$rst = $this->mapi->redeem($this->post);
				if (empty($rst['member_id']))
					$this->api_rsp = $this->response_110;
				elseif(isset($rst['msg'])) {
					$rsp = "response_{$rst['msg']}";
					$this->api_rsp = $this->$rsp;
				}
				else {
					$ack = true;
					$this->api_rsp = $this->response_000;
					$this->api_rsp['data']['redeem_id'] = $rst['redeem_id'];
				}
			}
			else
				$this->api_rsp = $this->response_100;
			if ($ack)
				$this->set_response($this->api_rsp, REST_Controller::HTTP_CREATED);
			else
				$this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
		}
	}
	
	#14 API REDEEM_HISTORY
	private 	function redeem_history() {
		if($this->auth_check()) {
			if (!empty($this->post['customer_id'])) {
				$rst = $this->mapi->redeem_history($this->post);
				if($this->api_err)
					$this->check_err();
				else {
					if(!$rst)
						$rst = array();
					$this->api_rsp = array(
						'status_code' => '000',
						'customer_id' => $this->post['customer_id'],
						'data' => $rst
					);
				}
			}
			else
				$this->api_rsp = $this->response_100;
			
			$this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
		}
	}
	
	private function check_upload(&$file_name) {
    	$err_msg = null;
		// Check $_FILES['receipt_file']['error'] value.
        if($_FILES) {
            $tgl = date('Y-m-d');
            $log = fopen("logs/upload_log-{$tgl}.txt", "a") or die("Unable to open file!");
            fwrite($log, date('Y-m-d H:i:s'));
            fwrite($log, "\narr: ");
            fwrite($log, json_encode($_FILES, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT));
            fclose($log);
        }
		if(isset($_FILES['receipt_file']['error'])) {
			switch ($_FILES['receipt_file']['error']) {
				case UPLOAD_ERR_OK:
					break;
				case UPLOAD_ERR_NO_FILE:
					$err_msg = 'No file sent';
					break;
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					$err_msg = 'Exceeded filesize limit';
					break;
				default:
					$err_msg = 'Unknown errors';
					break;
			}
		}
		if(!$err_msg) {
			// You should also check filesize here.
			if ($_FILES['receipt_file']['size'] > 2097152)
				$err_msg = 'Exceeded filesize limit 2 MB';
		}
		if(!$err_msg) {
			// DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
			// Check MIME Type by yourself.
			$finfo = new finfo(FILEINFO_MIME_TYPE);
			if (false === $ext = array_search(
					$finfo->file($_FILES['receipt_file']['tmp_name']),
					array('jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'), true))
				$err_msg = 'invalid file format, only accept image/jpeg or image/png';
		}

		if(!$err_msg) {
			// You should name it uniquely.
			// DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
			// On this example, obtain safe unique name from its binary data.
			$file_name = '../Library/AzureStorage/Temp';

		}
		if(!$err_msg) {
			$namefile = $this->post['customer_id'] . '-' . time() . '.'.$ext;
			$file_name .= '/' . $namefile;
			if (!move_uploaded_file($_FILES['receipt_file']['tmp_name'], $file_name))
				$err_msg = 'Failed to move uploaded file';
			
		}
		if(!$err_msg) {
			
			if (!shell_exec('curl http://localhost:8080/Library/AzureStorage/PushFile.php?File='.$namefile))
				$err_msg = 'Failed to move uploaded file';

		}
		return $err_msg;
	}
	private     function check_err($ack=false) {
    	if($this->api_err) {
    		$err = "response_{$this->api_err}";
    		$this->api_rsp = $this->$err;
	    }
	    elseif($ack) {
		    $err = "response_{$ack}";
		    $this->api_rsp = $this->$err;
	    }
	}

	#15 NADYNE API SMS SEND
	private function send_otp_wa(){
		if($this->auth_check()) {
		if (!empty($this->post['customer_telp']) && !empty($this->post['sms_content'])) {
			$rsp = array(
				'WA_ID' => $this->post['customer_telp'],
				'Param1' =>"Hebat",
				'Param2' => $this->post['sms_content'],
				'Param3' =>", silakan hubungi layanan 24 jam Wyeth Nutrition Careline di 0800-1821-526 (bebas pulsa) atau ketik TANYA CS ke WhatsApp Interaktif di 0812-11111-526"
			);
			$this->mapi->send_otp_wa($rsp);
		}
		}
	}
	private function sms_send_otp() {
		$uname = 'postotps26';
		$upswd = 's26Oke';
	
		if($this->auth_check('110')) {
				
			if (!empty($this->post['customer_telp']) && !empty($this->post['sms_content'])) {
				$hp=$this->post['customer_telp'];
				$hp="62".substr($hp,1,strlen($hp));
				$rsp = array(
				'WA_ID' => $this->post['customer_telp'],
				'Param1' =>"Hebat",
				'Param2' => $this->post['sms_content'],
				'Param3' =>", silakan hubungi layanan 24 jam Wyeth Nutrition Careline di 0800-1821-526 (bebas pulsa) atau ketik TANYA CS ke WhatsApp Interaktif di 0812-11111-526"
			);
			$SMSWording='Your activation code is '.$this->post['sms_content'];
			$this->mapi->send_otp_wa($rsp);


				$url = "http://api-otp.nadyne.com/sms.php?user=postotps26&pwd=s26Oke&sender=S26+Loyalty&msisdn=$hp&message=". urlencode($SMSWording)."+S26+Loyalty+OTP&desc=test2";
				
				$curl_opts = array(CURLOPT_FOLLOWLOCATION => true,
        			   CURLOPT_MAXREDIRS => 5,
			           CURLOPT_CONNECTTIMEOUT => 15,
			           CURLOPT_TIMEOUT => 15,
			           CURLOPT_RETURNTRANSFER => 1,
				   CURLOPT_HEADER => 0,
			           CURLOPT_URL => $url
				);
			
			$ch = curl_init();
        		curl_setopt_array($ch, $curl_opts);
			$r = curl_exec($ch);		
			if (curl_errno($ch))
        		{
				$response = $this->response_180;

			        //echo "<br/>Error: " . curl_error($ch)."<br/>";
		        }	
			
				$p = xml_parser_create();
				xml_parse_into_struct($p, $r , $vals, $index);
				xml_parser_free($p);
				$tx=$vals[1];
				$trxid=$tx["value"];
				$val=$vals[2];
				if(!empty($val)){
				$refID=$val["value"];}
				if ($trxid=="0") {
					$response = $this->response_180;
					$rsp = array(
						'customer_telp' => $hp,
						'Provider Response'=> $refID,
						'Response No' => $tx["value"]
	
					);
					$response['data']       = $rsp;

				}
				else {
					$rsp = array(
						'customer_telp' => $hp,
						'sms_ref' 		=> $trxid,
						'sms_rsp' 		=> 'Success Send',
						'sms_status_id' => 3,
						'sms_status' 	=> 'Sent to Telco'
					);
					
					$response               = $this->response_000;
					$response['data']       = $rsp;
				
					//$this->post['sms_ref']  = $ref;
					//$this->post['sms_rsp']  = isset($rsp['sms_rsp']) ? $rsp['sms_rsp'] : 0;
					//if(!empty($this->post['customer_id']))
						//$this->mapi->sms_send($this->post); 
				}
			}
			else
				$response = $this->response_100;
			$this->set_response($response, REST_Controller::HTTP_OK);
		}
	}
	private function SendWA(){
		$this->set_response($channel);
	}

	#16 API Store List (POST Data)
	private function storelist() {
		if($this->auth_check()) {
			$rst = $this->mapi->storelist($this->post);
			if ($rst) {
				$this->api_rsp = $this->response_000;
				$this->api_rsp['data'] = $rst;
			}
			else
				$this->api_rsp = $this->response_176;
			
			$this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
		}
	}

	#17 API Tiering Level
	private 	function tiering_level() {
	    if($this->auth_check()) {
		    if (!empty($this->post['customer_id'])) {
			    $rst = $this->mapi->tiering_level($this->post);
			    if ($rst) {
				    $this->api_rsp = $this->response_000;
				    $this->api_rsp['data'] = $rst;
			    }
			    else
				    $this->api_rsp = $this->response_110;
		    }
		    else
			    $this->api_rsp = $this->response_100;
		
		    $this->set_response($this->api_rsp, REST_Controller::HTTP_OK);
	    }
    }


}
