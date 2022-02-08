<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "../DBCon.php"; 
   
$connectionInfo = array( "UID"=>$uid,                              
                         "PWD"=>$pwd,                              
                         "Database"=>$databaseName);   
    
/* Connect using SQL Server Authentication. */    
$conn = sqlsrv_connect( $serverName, $connectionInfo);   

$MessageId = $_GET["messageId"];
$DeliveryStatus = $_GET["deliverystatus"];
$Datereceived = urldecode($_GET["datereceived"]);
$disort = strtotime($Datereceived);
$convertDate = date("Y-m-d H:i:s", $disort);
$timestamps = strtotime($convertDate);

if($DeliveryStatus == "1"){
    $DeliveryStatus = "Sent";
}
elseif($DeliveryStatus == "2"){
    $DeliveryStatus = "Delivered";
}
elseif($DeliveryStatus == "3"){
    $DeliveryStatus = "Read";
}
elseif($DeliveryStatus == "4"){
    $DeliveryStatus = "Unkown Number";
}
elseif($DeliveryStatus == "5"){
    $DeliveryStatus = "Failed";
}

$sql = "EXEC SP_WA_API_UPDATE_STAT @MSGID = '".$MessageId."', @WAID= '0', @STATUS= ".$DeliveryStatus.", @TIMESTAMP= ".$timestamps."";
$stmt = sqlsrv_query($conn, $sql);

?>