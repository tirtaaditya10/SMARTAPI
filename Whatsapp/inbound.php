<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "DBCon.php";    
   
$connectionInfo = array( "UID"=>$uid,                              
                         "PWD"=>$pwd,                              
                         "Database"=>$databaseName);   
    
/* Connect using SQL Server Authentication. */    
$conn = sqlsrv_connect( $serverName, $connectionInfo);   
if($conn == false){
	echo "conect erooorr nieee";
}
 
//$inbound = new inbound();
//echo file_get_contents('php://input');
$data = json_decode(file_get_contents('php://input'), true);

//If no POST Data, reply with this
if(!is_array($data)){
	http_response_code(400);
	 echo json_encode(array("message" => "Unable to Save Inbound. No POST Data."));
	return;
}

foreach($data['messages'] as $item){
	$from = "0". substr($item['from'], 2);
 
	$id = $item['id'];
	$timestamp = $item['timestamp'];
	$txt= $item['text']['body'];
	
}
if(
	!empty($from)&&
	!empty($id)&&
	!empty($timestamp)&&
	!empty($txt)
){
	
	$procedure_params = array(
array($from,SQLSRV_PARAM_IN),
array($id, SQLSRV_PARAM_IN),
array($txt, SQLSRV_PARAM_IN),
array($timestamp, SQLSRV_PARAM_IN),
);

$sql = "EXEC SP_WA_API_CHECK_HP @WAID = ?, @MSGID= ?, @MSG= ?, @TIMESTAMP= ?";
$stmt = sqlsrv_query($conn, $sql, $procedure_params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}

http_response_code(200);
	echo json_encode(array("message"=>"Inbound Data Saved"));

}else{
	http_response_code(526);
	echo json_encode(array("message" => "Unable to Save Inbound. Data not complete"));
}
?>
