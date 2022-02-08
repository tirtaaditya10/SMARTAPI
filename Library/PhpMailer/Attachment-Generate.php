<?php
	$Oid = $_GET['id']; 
	include '../../DBCon.php';
	$connectionInfo = array( "UID"=>$uid,                              
		 "PWD"=>$pwd,                              
		 "Database"=>$databaseName);   
		
	 
	$conn = sqlsrv_connect( $serverName, $connectionInfo);   

	if($conn == false){
		echo "Internal Server ERROR: Cannot connect to DB";
	}

	#GET DATA
	$sql = "SELECT * FROM T_EMAIL_TO_SEND_ATTACHMENT WHERE Oid=".$Oid;
	$stmt = sqlsrv_prepare($conn, $sql);
	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
		$Oid	       = $row['OID'];
		$SP	       = $row['SProcedure'];
	}

	#GET HEADER
	$flag = false;
	$sql = "EXEC ".$SP;
	$stmt = sqlsrv_prepare($conn, $sql);
	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}
	$flag = false;
	while(false !== ($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))) 
  	{
	    	if(!$flag) {
    		  	echo implode("\t", array_keys($row)) . "\r\n";
			$flag = true;
    		}
  	}

	#GET BODY
	$sql = "EXEC ".$SP;
	$stmts = sqlsrv_query($conn, $sql);
	if ($stmts === false) {
    		die(print_r(sqlsrv_errors(), true));
	}
	$fc = sqlsrv_num_fields($stmts);
	while (sqlsrv_fetch($stmts)) {
   	    for($i = 0; $i < $fc; $i++) {
		echo str_replace(array(chr(13), chr(10)), ' ',sqlsrv_get_field($stmts, $i, SQLSRV_PHPTYPE_STRING(SQLSRV_ENC_CHAR)))."\t";
	    }
	    echo "\n";
}    
?>