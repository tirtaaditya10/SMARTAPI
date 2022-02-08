<?php
 
	include '../../DBCon.php';
	$connectionInfo = array( "UID"=>$uid,                              
		 "PWD"=>$pwd,                              
		 "Database"=>$databaseName);   
		
	 
	$conn = sqlsrv_connect( $serverName, $connectionInfo);   

	if($conn == false){
		echo "Internal Server ERROR: Cannot connect to DB";
	}


header("Content-Disposition: attachment; filename=\"$FileName\".xls");
header("Content-Type: application/vnd.ms-excel");
//PARSE HEAD
$sql = "Exec TestAttMail";
$stmt = sqlsrv_query($conn, $sql);

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    if (!$flag) {
        // display field/column names as first row
	echo "<span style='background-color:#2DA0F5;'>";
        echo implode("\t", array_keys($row)) . "\r\n";
	echo "</span>";
        $flag = true;
    }
}

//PARSE VALUE
$sql = "Exec TestAttMail";
$stmt = sqlsrv_query($conn, $sql);

$fc = sqlsrv_num_fields($stmt);
while (sqlsrv_fetch($stmt)) {
    for($i = 0; $i < $fc; $i++) {
        echo sqlsrv_get_field($stmt, $i, SQLSRV_PHPTYPE_STRING(SQLSRV_ENC_CHAR))."\t";
    }
    echo "\r\n";
}
?>