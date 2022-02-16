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

foreach($data['statuses'] as $item){
	$MSG_ID =  $item['id'];
	$WA_ID = $item['recipient_id'];
	$status = $item['status'];
	$timestamp= $item['timestamp'];
}

if(
	!empty($MSG_ID)&&
	!empty($WA_ID)&&
	!empty($status)&&
	!empty($timestamp)
){

$sql = "EXEC SP_WA_API_UPDATE_STAT @MSGID = '".$MSG_ID."', @WAID= '".$WA_ID."', @STATUS= '".$status."', @TIMESTAMP= ".$timestamp."";
$stmt = sqlsrv_query($conn, $sql);
http_response_code(200);
		echo json_encode(array("message"=>"Inbound Data Saved"));


}else{
	http_response_code(526);
	echo json_encode(array("message" => "Unable to Save Inbound. Data not complete"));
}
?>
