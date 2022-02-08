<?php

function getlogin($t){
	logErr("Get Token ". $t .".". date('Y-m-d H:i:s'));
	$url = 'https://wyeth.coster.id/proxy/wa/users';
	$credentials= 'wyeth:Sduaenam123$';
	$ch = curl_init($url);
	$headers = array( 
            "POST HTTP/1.0", 
            "Content-type: text/xml;charset=\"utf-8\"", 
            "Accept: text/xml", 
            "Cache-Control: no-cache", 
            "Pragma: no-cache", 
            "SOAPAction: \"run\"", 
            "Authorization: Basic " . base64_encode($credentials) 
        ); 
       
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL,$url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

       
        // Apply the XML to our curl call 
        curl_setopt($ch, CURLOPT_POST, 1); 		
	$data = curl_exec($ch); 
        if (curl_errno($ch)) { 
            logErr("Error: " . curl_error($ch)); 
        } else { 
            // Show me the result 
            curl_close($ch); 
	    logErr("Generate New Token: ". $data);
	return $data; 
        } 
	
	
}

function sendWA($headers,$data,$isPost){

	if($isPost==1){
	$curl_opts = array(CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_MAXREDIRS => 5,
						CURLOPT_CONNECTTIMEOUT => 15,
			           	CURLOPT_TIMEOUT => 15,
			            CURLOPT_RETURNTRANSFER => 1,
			            CURLOPT_POST =>1,	
				        CURLOPT_HTTPHEADER => $headers,
				        CURLOPT_POSTFIELDS => $data,
 				        CURLOPT_URL => "https://wyeth.coster.id/proxy/wa/messages"
				        );
	}else{
	$curl_opts = array(CURLOPT_FOLLOWLOCATION => true,
        			   CURLOPT_MAXREDIRS => 5,
			           CURLOPT_CONNECTTIMEOUT => 15,
			           CURLOPT_TIMEOUT => 15,
			           CURLOPT_RETURNTRANSFER => 1,
					    CURLOPT_HEADER => 0,
			           CURLOPT_URL => "https://messaging.jatismobile.com/index.ashx?".$data
				);
	}
	$ch = curl_init();
        curl_setopt_array($ch, $curl_opts);
	$data = curl_exec($ch);
	return $data;


}

function logErr($data){
  $logPath ="Logs/WAOutBoundLog_".date('Y-m-d').".log";
  $mode = (!file_exists($logPath)) ? 'w':'a';
  $logfile = fopen($logPath, $mode);
  fwrite($logfile, "\r\n". $data);
  fclose($logfile);
}


$my_file = 'login.conf';
$handler = fopen($my_file, 'r');
if(!$handler){
	$handle = fopen($my_file, 'w')or die('Cannot open file:  '.$my_file);
	$res= getlogin('New');
 	fwrite($handle, $res);
	fclose($handle);
	$ArrayData = json_decode($res, true);
		foreach($ArrayData['users'] as $item){
			$token =  $item['token'];
			$expires_after = $item['expires_after'];
		}
	ReadDB($token);
}else{
	//If Exsits, read file
	$data = fread($handler,filesize($my_file));

	//check Expired
	$ArrayData = json_decode($data, true);
	foreach($ArrayData['users'] as $item){
		$token =  $item['token'];
		$expires_after = $item['expires_after'];
	}
	
	$dt=explode(" ",$expires_after);
	

	if($dt[0] == date("Y-m-d"))
	{
		$handle = fopen($my_file, 'w')or die('Cannot open file:  '.$my_file);
		$res= getlogin('Update'); 

		fwrite($handle, $res);
		fclose($handle);
		$ArrayData = json_decode($res, true);
		foreach($ArrayData['users'] as $item){
			$token =  $item['token'];
			$expires_after = $item['expires_after'];
		}
		ReadDB($token);
		
	}else{

		ReadDB($token);
	}
}




function ReadDB($Token){
if($Token =="")
{
	logErr("No Token (Internal) :".date('Y-m-d H:i:s'));
	$handle = fopen($my_file, 'w')or die('Cannot open file:  '.$my_file);
	$res= getlogin('ReNew'); 
 	fwrite($handle, $res);
	fclose($handle);
	$ArrayData = json_decode($res, true);
		foreach($ArrayData['users'] as $item){
			$token =  $item['token'];
			$expires_after = $item['expires_after'];
		}


	exit;

}
include "../DBCon.php"; 



$connectionInfo = array( "UID"=>$uid,                              
                         "PWD"=>$pwd,                              
                         "Database"=>$databaseName);   
    
 
$conn = sqlsrv_connect( $serverName, $connectionInfo);   

if($conn == false){
	echo "Internal Server ERROR: Cannot connect to DB";
}



$sql = "EXEC SP_WA_TO_SEND_GetALL @TypeID=0";
$stmt = sqlsrv_prepare($conn, $sql);

if (!sqlsrv_execute($stmt)) {
    echo "Your code is fail!";
    die;}

while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	$timestamp = getdate(date("U"));
	$AccID =$row["FK_ACC_ID"];
	$ImgId = $row["IMGID"];
	$RefID = $row["REF_ID"];
	$WAID=$row["WA_ID"];
	if($row["Message"]){
	$Msg = $row["Message"];}else{
	$Msg = $row["MsgBC"];
	}
	$Res_code = $row["RES_CODE"];
	if($row["Subject"]){
	$Subject ='Open Ticket '. strtoupper($row["Subject"]);}
	else
		{$Subject ='';}
	$OID=$row["Oid"];
	$SendWAID = "62". substr($WAID , 1);
	$param =$row["Param1"];

	if(!empty($row["Param2"]))
	{	
		$param =$param .'","'. $row["Param2"];
	}
	if(!empty($row["Param3"]))
	{
		$param =$param .'","'. $row["Param3"];
	}
	if(!$AccID){
		$AccID="NULL";
	}
	if(!$RefID ){
		$RefID ="NULL";
	}	
	
	if($row["Channel"]=="0"){

		//$json = '{ "recipient_type": "individual","to": "'.$SendWAID .'", "type":"text","text":{"body":"'. $Msg.'"}}';
		$json = '{ "recipient_type": "individual","to": "'.$SendWAID .'", "type":"image","image":{"id":"'. $ImgId.'", "Mime_type":"image/png","Caption":"'. $Msg.'"}}'; 
		$headers = array(
    			'Content-Type:application/json',
    			'Authorization: Bearer '. $Token,
				'Coster:  '. $Res_code,
			'Subject:'.$Subject 
			);
	
		$res = sendWA($headers,$json,1);
		$data = json_decode($res, true);
		if(!$data['errors'])
		{
			foreach($data['messages'] as $item){
				$MSGID = $item['id'];
			}
			$sqlWA = "EXEC SP_WA_API_MSG_OUT_LOG @AccID=".$AccID.",@RefID=".$RefID.", @WAID ='". $WAID ."', @MSGID='". $MSGID ."', @Timestamp= ".$timestamp[0].", @Msg= '". str_replace("'","",$Msg)."', @WAToSendID=".$OID;
        	        $stmtWA = sqlsrv_query($conn, $sqlWA);
			if( $stmtWA === false ) {
     				die( print_r( sqlsrv_errors(), true));
			}
			logErr('Sending To: '. $WAID .'. At: '.date('Y-m-d H:i:s').'. Success, with MSGID '.$MSGID);

		}else{
			foreach($data['errors'] as $item){
				$details=$item['details'];
			}
			logErr('Sending To: '. $WAID .'. At: '.date('Y-m-d H:i:s').'. ERROR, with details '.$details);
			
		}
		
	}else if($row["Channel"]=="4"){

		//$json = '{ "recipient_type": "individual","to": "'.$SendWAID .'", "type":"text","text":{"body":"'. $Msg.'"}}';
		$json = '{ "recipient_type": "individual","to": "'.$SendWAID .'", "type":"video","video":{"id":"'. $ImgId.'", "mime_type":"video/MP4","Caption":"'. $Msg.'"}}'; 
		$headers = array(
    			'Content-Type:application/json',
    			'Authorization: Bearer '. $Token,
				'Coster:  '. $Res_code,
			'Subject:'.$Subject 
			);
	
		$res = sendWA($headers,$json,1);
		$data = json_decode($res, true);
		if(!$data['errors'])
		{
			foreach($data['messages'] as $item){
				$MSGID = $item['id'];
			}
			$sqlWA = "EXEC SP_WA_API_MSG_OUT_LOG @AccID=".$AccID.",@RefID=".$RefID.", @WAID ='". $WAID ."', @MSGID='". $MSGID ."', @Timestamp= ".$timestamp[0].", @Msg= '". str_replace("'","",$Msg)."', @WAToSendID=".$OID;
        	        $stmtWA = sqlsrv_query($conn, $sqlWA);
			if( $stmtWA === false ) {
     				die( print_r( sqlsrv_errors(), true));
			}
			logErr('Sending To: '. $WAID .'. At: '.date('Y-m-d H:i:s').'. Success, with MSGID '.$MSGID);

		}else{
			foreach($data['errors'] as $item){
				$details=$item['details'];
			}
			logErr('Sending To: '. $WAID .'. At: '.date('Y-m-d H:i:s').'. ERROR, with details '.$details);
			
		}

	
	}else{
		$param="";
		$headers="";
		if (!$param)
		{
			$msgs='{"templateid":"'.$row["JatisTemplateID"].'","parameters":[]}';

		}else{
			$msgs='{"templateid":"'.$row["JatisTemplateID"].'","parameters":["'.$param.'"]}';
		}
		$parm ="userid=wyethns&password=wyethns778&msisdn=".$SendWAID."&message=".urlencode($msgs)."&Sender=s26+loyalty_wa&Division=CRM&batchname=".$row["batchID"]."&uploadby=ITTest&channel=2&type=wa";
		$res = sendWA($headers,$parm,0);
		$tmp= explode("&", $res);

		$Status=explode("=", $tmp[0]);

                if($Status[1]==1){
			$MSGID=explode("=", $tmp[1]);	
			$sqlWA = "EXEC SP_WA_API_MSG_OUT_LOG @AccID=".$AccID.",@RefID=".$RefID.", @WAID ='". $WAID ."', @MSGID='". $MSGID[1] ."', @Timestamp= ".$timestamp[0].", @Msg= '". $Msg ."', @WAToSendID=".$OID;
			logErr('Sending To: '. $WAID .'. At: '.date('Y-m-d H:i:s').'. Success, with MSGID '.$sqlWA);

			$stmtWA = sqlsrv_query($conn, $sqlWA);
			echo $sqlWA;
			if( $stmtWA === false ) {
     				die( print_r( sqlsrv_errors(), true));
			}
			logErr('Sending To: '. $WAID .'. At: '.date('Y-m-d H:i:s').'. Success, with MSGID '.$MSGID[1]);

		}else{
			logErr('Sending To: '. $WAID .'. At: '.date('Y-m-d H:i:s').'. ERROR,Couldnt remove this data');

			unlink($my_file) or die("Couldn't remove this data");

		}
	}	

	}
 
}

//UPLOAD LOG KE FILE SHARE
  $files = "Logs/WAOutBoundLog_".date('Y-m-d', strtotime($date. ' - 1 days')).".log";

  if (file_exists($files)) {
	$srcfileName ="Logs-WAOutBoundLog_".date('Y-m-d', strtotime($date. ' - 1 days')).".log";
        $srcContent = "Logs/WAOutBoundLog_".date('Y-m-d', strtotime($date. ' - 1 days')).".log";

	include "../Library/FileShare/PushFile.php";

        unlink($files);
  }






?>
