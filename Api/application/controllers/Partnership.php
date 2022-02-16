<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script allowed');

/*----------------------------------------REQUIRE THIS PLUGIN----------------------------------------*/
require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';
use chriskacerguis\RestServer\RestController;

class Partnership extends RestController{
	/*----------------------------------------CONSTRUCTOR----------------------------------------*/
	function __construct($config = 'rest'){
		parent::__construct($config);
		$this->load->database();
		$this->load->Model('Mpartnership');

	    $this->$response_401 = array(
		    'Result' => '401',
		    'data'  => array(
			    'msg'    => 'Access Denied'
		    )
	    );

	    $this->$response_501 = array(
		    'Result' => '501',
		    'data'  => array(
			    'msg'    => 'Invalid Login'
		    )
	    );

	    $this->$response_200 = array(
		    'Result' => '200',
		    'data'  => array(
			    'msg'    => 'No Data Found(s)'
		    )
	    );

	}

	/*----------------------------------------SET COMMAND----------------------------------------*/
	function index_post(){
		$Auth = $this->input->get_request_header('Authorization');
		if($Auth){
			$result=$this->Mpartnership->Auth($Auth);			
				if ($result==FALSE) {
						$this->set_response($this->$response_501, 501);
					}else{
						$cmd = str_replace(" ", "", $this->input->get_request_header('command'));
						if($cmd) {
							foreach ($result as $row)
							{
								$PartnerID = $row->OID;
							}
							if(method_exists($this, $cmd))
								$this->$cmd($PartnerID);
							else {
								$this->set_response($this->$response_401, 401);
							}
						}
						else {
							$this->set_response(array('Result'=>'200','data'=>$result),200);
						}
					}			
		}else{
			$this->set_response($this->$response_401, 401);
		}

	}

	#1 PARTNERSHIP VERIFICATION
	private function verification($PartnerID) {
		$Ip = $this->input->ip_address();
		$result = $this->Mpartnership->Verification($PartnerID, $Ip);
 			if ($result==FALSE) {
				$this->set_response($this->$response_200, 200);
			}
			else{	
				$array=[];
				foreach ($result as $row) {
				    $BatchNo = $row->BatchNo;
				    $array[] = $row->MemberCardID;
				}
				$this->set_response(array('Result'=>'200','Data'=>array('BatchNo'=>$BatchNo, 'MemberCardID'=>$array)),200);
			}
	}

	#2 PARTNERSHIP UPDATE MEMBER
	private function updatemember($PartnerID) {
		$MemberCardID	= $this->post('MemberCardID');

		if($this->post('Status')=="Valid"){
			$Status	= '1';
		}else{
			$Status	= '2';
		}
		$SCVFilename 	= 'API';
		$Ip 		= $this->input->ip_address();
		$result = $this->Mpartnership->UpdateMember($PartnerID, $MemberCardID, $Status, $SCVFilename, $Ip);
 			if ($result==FALSE) {
				$this->set_response($this->$response_200, 200);
			}
			else{	
				foreach ($result as $row) {
				    $TransNo = $row->TransNo;
				}
				$this->set_response(array('Result'=>'200','Data'=>array('Message'=>$TransNo)),200);
			}
	}
	
	#KURANG SKU
	#3 MEMBER CAMPAIGN
	private function campaign($PartnerID) {
		$result = $this->Mpartnership->Campaign($PartnerID);
 			if ($result==FALSE) {
				$this->set_response($this->$response_200, 200);
			}
			else{	
				$array=[];
				foreach ($result as $row) {
				    $CampaignCode = $row->MappingCampaign;
				    $StartDate 	  = $row->StartingDate;
				    $EndDate	  = $row->EndingDate;
				    $array[]	  = $row->MemberCardID;
				}
				    $results 	  = $this->Mpartnership->GetSKU($PartnerID, $CampaignCode);
					$arraySKU=[];
					foreach ($results as $rows) {
					    $arraySKU[]	  = $rows->PartnershipSKUMappingID;
					}


				$this->set_response(array('Result'=>'200','Data'=>array('CampaignCode'=>$CampaignCode, 'StartDate'=>$StartDate, 'EndDate'=>$EndDate, 'SKU'=>$arraySKU, 'MemberCardID'=>$array)),200);
			}
	}

	#4 UPDATE CAMPAIGN
	private function updatecampaign($PartnerID) {
		$MemberCardID	= $this->post('MemberCardID');
		$CampaignCode	= $this->post('CampaignCode');
		$VoucherID	= $this->post('VoucherID');
		$FileName	= "API-".$this->input->ip_address();

		$result = $this->Mpartnership->UpdateCampaign($PartnerID, $FileName, $MemberCardID, $VoucherID, $CampaignCode);
 			if ($result==FALSE) {
				$this->set_response($this->$response_200, 200);
			}
			else{	
				foreach ($result as $row) {
				    $TransNo = $row->TransNo;
				}
				$this->set_response(array('Result'=>'200','Data'=>array('Message'=>$TransNo)),200);
			}
	}

	#5 TABUNG POINT
	private function tabungpoin($PartnerID) {
		$MemberCardID		= $this->post('MemberCardID');
		$NewMemberCardID	= $this->post('NewMemberCardID');
		$TransactionNo		= $this->post('TransactionNo');
		$TransactionDate	= $this->post('TransactionDate');
		$SKU			= $this->post('SKU');
		$QTY			= $this->post('QTY');
		$Price			= $this->post('Price');
		$OutletID		= $this->post('OutletID');
		$CampaignCode		= $this->post('CampaignCode');
		$VoucherCode		= $this->post('VoucherCode');

		$result = $this->Mpartnership->TabungPoin($MemberCardID, $NewMemberCardID, $TransactionNo, $TransactionDate, $SKU, $QTY, $Price, $OutletID, $CampaignCode, $VoucherCode);
 			if ($result==FALSE) {
				$this->set_response($this->$response_200, 200);
			}
			else{	
				foreach ($result as $row) {
				    $TransNo = $row->TransNo;
				}
				$this->set_response(array('Result'=>'200','Data'=>array('Message'=>$TransNo)),200);
			}
	}

}