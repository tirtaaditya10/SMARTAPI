<?php

	include '../../DBCon.php';
	$connectionInfo = array( "UID"=>$uid,                              
		 "PWD"=>$pwd,                              
		 "Database"=>$databaseName);   
		
	 
	$conn = sqlsrv_connect( $serverName, $connectionInfo);   

	if($conn == false){
		echo "Internal Server ERROR: Cannot connect to DB";
	}

	#PROCESS DATA
	$sql = "UPDATE T_EMAIL_TO_SEND_ATTACHMENT SET ProcessStat=9, ProcessOn=getdate() WHERE Oid=
		(Select Top 1 Oid from T_EMAIL_TO_SEND_ATTACHMENT where ProcessStat is null)";
	$stmt = sqlsrv_prepare($conn, $sql);
	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	#GET DATA
	$sql = "SELECT * FROM T_EMAIL_TO_SEND_ATTACHMENT WHERE ProcessStat=9";
	$stmt = sqlsrv_prepare($conn, $sql);
	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
		$Oid	       = $row['OID'];
		$Name	       = $row['FileName'];
	}

	if($Oid>=1){
		shell_exec('wget http://localhost:8080/Library/PhpMailer/Attachment-Generate.php?id='.$Oid);
	}
	$FileName= $Name.'-'.date("dmYhis").'.xls';
	rename('Attachment-Generate.php?id='.$Oid, $FileName);

	#PROCESS FILENAME
	$sql = "UPDATE T_EMAIL_TO_SEND_ATTACHMENT SET FileName='".$FileName."' WHERE Oid=".$Oid;
	$stmt = sqlsrv_prepare($conn, $sql);
	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}
	
	#PROCESS DONE
	$sql = "UPDATE T_EMAIL_TO_SEND_ATTACHMENT SET ProcessStat=1 WHERE Oid=".$Oid;
	$stmt = sqlsrv_prepare($conn, $sql);
	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

   
?>