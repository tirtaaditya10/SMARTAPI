<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Sms extends CI_Controller {
	private $uname;
	private	$upswd;

	public function __construct() {
		parent::__construct();
        $this->uname = 'wyeth.nestle';
        $this->upswd = '123456789';
		$this->load->model('msms');
	}

	public function cekpendingwa(){
		$dat= $this->msms->prep_cekpendingwa();
		$tot = is_array($dat) ? count($dat) : 0;
                if($tot>5){
			$url="https://apitoken.nadyne.com/sms.php?user=s26smsreg&pwd=reg789&sender=S26+Loyalty&msisdn=6281385731234&message=Cek+Server+WA&desc=Internal Warning";
			echo "<br/>$url<br/>";
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
		}
		
	}
	public function nadynestatus(){

		$dat['status']= $this->input->get('dlr');
		$trx= $this->input->get('trx'); 
		
		$dats = $this->msms->update_nadyne($dat,$trx);
		echo $dats;
		

	}
	
	public function sendmymaskingsms(){
		$jam = date('H', time());
		print $jam;
	    	if($jam >= 8 && $jam <=18 ) {

			$job = date('Y-m-d H:i:s', time());
			$dat = $this->msms->prep_mymasking();
			$tot = is_array($dat) ? count($dat) : 0;

			if($tot==0){
				echo "Exit";
				exit;
			};
			$dtx = array('Bot' => 'SMS Marketing (Masking)', 'Dat' => $tot, 'Started' => $job);
			if($dtx['Dat'])
				$dtx['Oid'] = $this->msms->logz($dtx);

			while ($dat) {
                foreach ($dat as $k => $v) {
                    $this->sendMyMasking($v);
                }
                sleep(10);

				$dat = $this->msms->prep_mymasking();
                if($dat)
					$dtx['Dat'] += count($dat);
                else {
					$dtx['Ended']   = date('Y-m-d H:i:s', time());
					$dtx['is_run']  = 0;
					$this->msms->logz($dtx);

					if (!is_cli()) echo "<br/>Send SMS To MyMaskingSMS". ' @' . time();
				}
            }
        }
	    else
			if (!is_cli()) echo ' next time ya, antara  jam 08-16 WIB';
	}        


        public function sendnewsms(){
		$jam = date('H', time());
	    	if($jam >= 8 && $jam <= 19) {

			$job = date('Y-m-d H:i:s', time());
			$dat = $this->msms->prep_nadyne();
			$tot = is_array($dat) ? count($dat) : 0;

			if($tot==0){
				echo "Exit";
				exit;
			};
			$dtx = array('Bot' => 'SMS Marketing (Nadyne)', 'Dat' => $tot, 'Started' => $job);
			if($dtx['Dat'])
				$dtx['Oid'] = $this->msms->logz($dtx);

			while ($dat) {
                foreach ($dat as $k => $v) {
                    $this->sendNadyne($v);
                }
                sleep(10);

				$dat = $this->msms->prep_nadyne();
                if($dat)
					$dtx['Dat'] += count($dat);
                else {
					$dtx['Ended']   = date('Y-m-d H:i:s', time());
					$dtx['is_run']  = 0;
					$this->msms->logz($dtx);

					if (!is_cli()) echo "<br/>Send SMS To Nadyne". ' @' . time();
				}
            }
        }
	    else
			if (!is_cli()) echo ' next time ya, antara  jam 08-16 WIB';
	}        
		public function getpendingsms(){
		$dats = $this->msms->Prep_PendingSMS();
		$tot = is_array($dats) ? count($dats) : 0;
		if($tot>0){
			foreach ($dats as $k => $v) {
                    		$url = "http://103.16.199.187/masking/send_post.php";
            			$dat = array(
                			'username' 	=> $this->uname,
			                'password' 	=> $this->upswd,
			                'hp' 		=> $v['customer_telp'],
			                'message' 	=>'SMS Warning: '. $v['sms_content']
			            );
            			$ref = curl_post($url, $dat);

                	}		
		}



	}
	public 	    function regular($bot='Daily-0800', $arg=null) {
        set_time_limit(0);

	    $jam = date('H', time());
	    if($jam >= 8 && $jam <= 19) {
		    $job = date('Y-m-d H:i:s', time());
		    $dat = $this->msms->prep_regular($arg);
		    $tot = is_array($dat) ? count($dat) : 0;
			$dtx = array('Bot' => $bot, 'Dat' => $tot, 'Started' => $job);
			if($dtx['Dat'])
				$dtx['Oid'] = $this->msms->logz($dtx);

			while ($dat) {
                foreach ($dat as $k => $v) {
                    $this->send($v);
                }
                sleep(10);

				$dat = $this->msms->prep_regular($arg);
                if($dat)
					$dtx['Dat'] += count($dat);
                else {
					$dtx['Ended']   = date('Y-m-d H:i:s', time());
					$dtx['is_run']  = 0;
					$this->msms->logz($dtx);

					if (!is_cli()) echo $bot . ' @' . time();
				}
            }
        }
	    else
			if (!is_cli()) echo ' next time ya, antara  jam 08-16 WIB';
	}
	public function adhoc() {
		set_time_limit(0);
		
		$jam = date('H', time());
		if($jam >= 8 && $jam <= 16) {
			$job = date('Y-m-d H:i:s', time());
			$dat = $this->msms->prep_adhoc();
			$tot = is_array($dat) ? count($dat) : 0;
			$dtx = array('Bot' => 'SMS Adhoc', 'Dat' => $tot, 'Started' => $job);
			if($dtx['Dat'])
				$dtx['Oid'] = $this->msms->logz($dtx);

			while ($dat) {
				foreach ($dat as $k => $v) {
					$this->send($v);
				}
				sleep(10);
				
				$dat = $this->msms->prep_adhoc();
				if($dat)
					$dtx['Dat'] += count($dat);
				else {
					$dtx['Ended']   = date('Y-m-d H:i:s', time());
					$dtx['is_run']  = 0;
					$this->msms->logz($dtx);
					
					if (!is_cli()) echo 'SMS Adhoc' . ' @' . time();
				}
			}
		}
		else
			if (!is_cli()) echo ' next time ya, antara  jam 08-16 WIB';
	}

	private function sendNadyne($post){

		if (!empty($post['customer_telp']) && !empty($post['sms_content'])) {
	
			$hp="62".substr($post['customer_telp'],1,strlen($post['customer_telp']));
			$url="https://apitoken.nadyne.com/sms.php?user=postregs26&pwd=s26Yes&sender=S26+Loyalty&msisdn=$hp&message=".urlencode($post['sms_content'])."&desc=";
			echo "<br/>$url<br/>";
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
			        echo "<br/>Error: " . curl_error($ch)."<br/>";
		        }	
			$p = xml_parser_create();
			xml_parse_into_struct($p, $r , $vals, $index);
			xml_parser_free($p);

			$val=$vals[2];
			$refID=$val["value"];
			//echo $refID;
			if($refID!="0") {
				$post['sms_ref'] 		= $refID;
				$post['sms_rsp'] 		= 'Success Send';
				$post['sms_status_id']	= 3;
				$post['sms_status'] 	= 'Sent to Telcos';
			}
            	else {
                		$ref = $ref ? $ref : 'Faileds, Unknown';
                		$post['sms_ref'] 		= 0;
				$post['sms_rsp'] 		= 'Failed Send';
				$post['sms_status_id']	= 2;
				$post['sms_status'] 	= $refID;
            }

            $this->msms->sent($post);


		}
            
	}

	private function sendMyMasking($post){

		if (!empty($post['customer_telp']) && !empty($post['sms_content'])) {
	
			$hp="62".substr($post['customer_telp'],1,strlen($post['customer_telp']));
			$url = "http://103.16.199.187/masking/send_post.php";
            		$dat = array(
                			'username' 	=> $this->uname,
			                'password' 	=> $this->upswd,
			                'hp' 		=> $post['customer_telp'],
			                'message' 	=> $post['sms_content']
            				);
		        $ref = curl_post($url, $dat);

			
			if(is_numeric($ref)) {
				$post['sms_ref'] 		= $ref;
				$post['sms_rsp'] 		= 'Success Send';
				$post['sms_status_id']	= 3;
				$post['sms_status'] 	= 'Sent to Telco';
			}
            else {
                $ref = $ref ? $ref : 'Failed, Unknown';

                $post['sms_ref'] 		= 0;
				$post['sms_rsp'] 		= 'Failed Send';
				$post['sms_status_id']	= 2;
				$post['sms_status'] 	= $ref;
            }

            $this->msms->sent($post);


		}
            
	}

	private function send($post) {
        if (!empty($post['customer_telp']) && !empty($post['sms_content'])) {
            $url = "http://103.16.199.187/masking/send_post.php";
            $dat = array(
                'username' 	=> $this->uname,
                'password' 	=> $this->upswd,
                'hp' 		=> $post['customer_telp'],
                'message' 	=> $post['sms_content']
            );
            $ref = curl_post($url, $dat);
            if(is_numeric($ref)) {
				$post['sms_ref'] 		= $ref;
				$post['sms_rsp'] 		= 'Success Send';
				$post['sms_status_id']	= 3;
				$post['sms_status'] 	= 'Sent to Telco';
			}
            else {
                $ref = $ref ? $ref : 'Failed, Unknown';

                $post['sms_ref'] 		= 0;
				$post['sms_rsp'] 		= 'Failed Send';
				$post['sms_status_id']	= 2;
				$post['sms_status'] 	= $ref;
            }

            $this->msms->sent($post);
        }
    }
}
