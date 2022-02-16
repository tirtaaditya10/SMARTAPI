<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "library/PHPMailer.php";
require_once "library/Exception.php";
require_once "library/OAuth.php";
require_once "library/POP3.php";
require_once "library/SMTP.php";
 
	$mail = new PHPMailer;
 
	$mail->SMTPDebug = 3;                               
	$mail->isSMTP();            
	$mail->Host = "tls://smtp.gmail.com";				  //host mail server
	$mail->SMTPAuth = true;                          
	$mail->Username = "tirta.iswara@sabgroupindonesia.com";   	 //nama-email smtp          
	$mail->Password = "MIRACLE123";           			//password email smtp
	$mail->SMTPSecure = "tls";                           
	$mail->Port = 587;                                   
 
	$mail->From = "tirta.aditya.pratama.iswara@gmail.com"; //email pengirim
	$mail->FromName = "Auto System - SMART CRM SYSTEM"; //nama pengirim
 
	include '../../DBCon.php';
	$connectionInfo = array( "UID"=>$uid,                              
		 "PWD"=>$pwd,                              
		 "Database"=>$databaseName);   
		
	 
	$conn = sqlsrv_connect( $serverName, $connectionInfo);   

	if($conn == false){
		echo "Internal Server ERROR: Cannot connect to DB";
	}

	#GET DATE
	$sql = "
	SELECT * FROM T_EMAIL_TO_SEND WHERE 
		(ProcessStat=0 
			AND OID NOT IN (Select FK_EMAIL_ID FROM T_EMAIL_TO_SEND_ATTACHMENT WHERE ProcessStat!=1)
			AND OID IN (select distinct FK_EMAIL_ID from T_EMAIL_TO_SEND_ATTACHMENT WHERE ProcessStat=1)
		)
	 OR
		(ProcessStat=0 and Attachment is null) 
	";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
		//$mail->addAddress($row['Email'], ''); //email penerima

		$addresses = explode(',', $row["Email"]); //LOOP
		foreach ($addresses as $address) {
		    $mail->AddAddress($address, '');
		} 

		$mail->isHTML(true);
 
		$mail->Subject = $row['Subject']; //subject
		$mail->Body    = $row['Message']; //isi email
		$id	       = $row['Oid'];

	}

	sleep(5);

	#ADD ATTACHMENT
	$sqla = "select STRING_AGG(FileName, ',') as FileName from T_EMAIL_TO_SEND_ATTACHMENT WHERE ProcessStat=1 AND FK_EMAIL_ID=".$id;
	$stmta = sqlsrv_prepare($conn, $sqla);

	if (!sqlsrv_execute($stmta)) {
		Save('Your code is fail!');
		die;}

	while( $rowa = sqlsrv_fetch_array($stmta, SQLSRV_FETCH_ASSOC) ) {	

		$at = explode(',', $rowa["FileName"]); //LOOP
		foreach ($at as $attach) {
		    	$mail->addAttachment($attach);
		} 

	}

        $mail->AltBody = "PHP mailer"; //body email (optional)
 
	if(!$mail->send()) 
	{
	    echo "Mailer Error: " . $mail->ErrorInfo;

	    $sqlg = "UPDATE T_EMAIL_TO_SEND SET ProcessStat=2 where Oid=".$id;
	    $stmtg = sqlsrv_prepare($conn, $sqlg);
	    if (!sqlsrv_execute($stmtg)) {
		Save('Your code is fail!');
		die;}

	} 
	else 
	{
	    echo "Email Terkirim";
	    $sqls = "UPDATE T_EMAIL_TO_SEND SET ProcessStat=1, SendOn=getdate() where Oid=".$id;
	    $stmts = sqlsrv_prepare($conn, $sqls);
	    if (!sqlsrv_execute($stmts)) {
		Save('Your code is fail!');
		die;}

	}

?>
