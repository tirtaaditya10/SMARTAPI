<?php
    error_reporting(0); 
?>
<?php

	include '../../DBCon.php';
	$connectionInfo = array( "UID"=>$uid,                              
		 "PWD"=>$pwd,                              
		 "Database"=>$databaseName);   
		
	 
	$conn = sqlsrv_connect( $serverName, $connectionInfo);   

	if($conn == false){
		echo "Internal Server ERROR: Cannot connect to DB";
	}

	#GET DATA
	$sql = "select TOP 1 * from T_SAS_TOKEN Where Used='images-lc' ORDER  BY CreatedOn DESC";
	$stmt = sqlsrv_prepare($conn, $sql);
	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
		$Sas	       = $row['SAS'];
		$containerName = $row['Used'];

	}
$FileName = 'CC202202-B32906133EDBA62E9DF5DD4375B86B59.png';

?> 

<img src="https://nidndvloyaidslnasse02sta.blob.core.windows.net/images-lc/<?=$FileName;?>?<?=$Sas;?>">



