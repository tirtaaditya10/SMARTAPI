<?php if (!defined ('BASEPATH')) die ();

class Msms extends CI_Model {
	public		function __construct() {
		parent::__construct ();
		$this->crm 		= $this->load->database('default', true);
		$this->api_acc	= 16;
		$this->api_err  = false;
	}
    
   public function prep_cekpendingwa(){
	$sql = "SELECT *  FROM T_WA_TO_SEND WHERE ProcessStat=0 and left(WA_ID,2)<>'04'";
			return $this->crm->query($sql)->result_array();
   

   }
   
   public function update_nadyne($dat,$trx)
   {
	$this->crm->update('T_STAGING_UPDLOAD_SMS', $dat, array('ReffNo' => $trx));
	$sql = "select * from T_STAGING_UPDLOAD_SMS where ReffNo = '$trx'";
	$rst = $this->crm->query($sql)->row_array();
	
       

   }

    public function prep_mymasking(){
	$now = date('Y-m-d H:i');		
		$sql = "select * from T_SMS_BOT where is_run = 1";
		$run = $this->crm->query($sql)->row_array();
		if(!$run) {
		echo "<br/>Starting Sending SMS Via MyMaskingSMS: ". date('Y-m-d H:i:s');
			$sql = "EXEC SP_SMSToSendGetAll @ID=1";
			return $this->crm->query($sql)->result_array();
		}
		else
			return false;
    }

    public function prep_nadyne(){
	$now = date('Y-m-d H:i');		
		$sql = "select * from T_SMS_BOT where is_run = 1";
		$run = $this->crm->query($sql)->row_array();
		if(!$run) {
		echo "<br/>Starting Sending SMS Via Nadyne: ". date('Y-m-d H:i:s');
			$sql = "EXEC SP_SMSToSendGetAll @ID=0";
			return $this->crm->query($sql)->result_array();
		}
		else
			return false;
    }
    public function Prep_PendingSMS(){
	$now = date('Y-m-d H:i');
        
        $sql = "select is_run from T_SMS_BOT where is_run = 1";
        $run = $this->crm->query($sql)->row();
	echo $run;
	$sql="SELECT '081385731234'customer_telp ,STUFF((SELECT '; ' + [status] +' = '+ CAST(count(*) as VARCHAR(10))
              FROM T_STAGING_UPDLOAD_SMS US WHERE [status] in ('Pending','Prepare')  
	      group by [status]       
              FOR XML PATH('')), 1, 1, '') sms_content";

	return $this->crm->query($sql)->result_array();
   }

    public function prep_regular($type=null) {
        $now = date('Y-m-d H:i');
        
        $sql = "select is_run from T_SMS_BOT where is_run = 1";
        $run = $this->crm->query($sql)->row();

        if(!$run) {
	echo "<br/>Starting SMS Regular: ". date('Y-m-d H:i:s');
	        switch ($type) {
		        default:
			        $sql = "select 	top 600
       					ROW_ID oid, FK_ACC_ID customer_id, [TELP.NUMBER] customer_telp, REPLACE(Message,'''','')sms_content
	                        from 	T_STAGING_UPDLOAD_SMS
	                        where   status = 'Prepare' 
				AND [TELP.NUMBER]  not in(SELECT PhoneNumber1 FROM T_LOYALTY_MEMBER WHERE OID IN (
							  SELECT FK_MEMBER_ID FROM T_OPT_INOUT WHERE OptType=1))
	                        and     [Sent Date] 			   <= '$now'
						    -- and		cast([Sent Date] as date)  >= '2019-02-01'
	                        and     SMS_TYPE_ID in  (1,2,4,15,20,21,22,23,24,25,26,28,29,30,31,32,33,34,35,36,37,38,41,42,
							43,44,45,46,47,48,49,50,51,52,53,54,55,57,58,59,60,61,62,63,64,
							65,66,67,68,69,70,71,73,74,75,77,78,79,80,81,82,84,85,86,87,91)

					--1 and 93
						    and     SMS_TYPE_ID != 7
							order by ROW_ID desc";
			        break;
	        }
	        return $this->crm->query($sql)->result_array();
        }
        else
        	return false;
    }

	public function prep_adhoc() {
		$now = date('Y-m-d H:i');		
		$sql = "select * from T_SMS_BOT where is_run = 1";
		$run = $this->crm->query($sql)->row_array();
		if(!$run) {
		echo "<br/>Starting SMS AdHoc: ". date('Y-m-d H:i:s');
			$sql = "select 	top 600
                            ROW_ID oid, FK_ACC_ID customer_id, [TELP.NUMBER] customer_telp, REPLACE(Message,'''','')sms_content
                    from 	T_STAGING_UPDLOAD_SMS
                    where   status              = 'PENDING'
		    AND [TELP.NUMBER]  not in(SELECT PhoneNumber1 FROM T_LOYALTY_MEMBER WHERE OID IN (
							  SELECT FK_MEMBER_ID FROM T_OPT_INOUT WHERE OptType=1))

                    and    ([Sent Date]         <= '$now' or [Sent Date] is null)
				    and     SMS_TYPE_ID         = 7
					order by ROW_ID desc";
			return $this->crm->query($sql)->result_array();
		}
		else
			return false;
	}
	
    public		function sent($pst) {
        $dat = array('Status' => $pst['sms_status'], 'ReffNo' => $pst['sms_ref'], 'UpdatedBy' => 16);
        if(isset($pst['oid']))
	{
        	$this->crm->update('T_STAGING_UPDLOAD_SMS', $dat, array('ROW_ID' => $pst['oid']));
		$sql = "INSERT into T_SMS_OUTBOX(
                                        [PhoneNumber], [FK_ACC_ID], [SMS_TYPE_ID], [SMS_REF], [Description], [Message], [SentDate], [Status], [StagingID],
                                        StagingBatchID,
                                        [Batch_ID],
                                        [CreatedOn], [CreatedBy], [UpdatedOn], [UpdatedBy])
                            select 		[TELP.NUMBER], [FK_ACC_ID], [SMS_TYPE_ID], 0, [Description], [Message], isnull([Sent Date], getdate()), [Status], [ROW_ID],
                                        case when SMS_TYPE_ID = 7 then Batch_ID else null end StagingBatchID,
                                        case when SMS_TYPE_ID = 7 then null else Batch_ID end Batch_ID,
                                        getdate(), 16, getdate(), 16
                            from		T_STAGING_UPDLOAD_SMS
                            where		ROW_ID=".$pst['oid']."
                            and 		FK_ACC_ID is not null";
		
					$this->crm->simple_query($sql);

	}
    }

    public      function logz($dat) {
	    if(isset($dat['Ended'])) {
	        $oid = $dat['Oid'];
	        unset($dat['Oid']);
            $this->crm->update('T_SMS_BOT', $dat, array('Oid' => $oid));
        }
        else {
	        $dat['is_run'] = 1;
	        $this->crm->insert('T_SMS_BOT', $dat);
	        return $this->crm->insert_id();
        }
    }
    
    private     function prep_run() {
	    $sql = "select * from V_SMS_BOT where is_run = 1 order by OID desc";
	    $run = $this->crm->query($sql)->row_array();
	    if($run && $run['Delta'] > 60) {
	    	$this->crm->update('T_SMS_BOT', array('is_run' => 0));
	    }
    }
}
