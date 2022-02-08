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


  require_once "vendor/autoload.php";
  use MicrosoftAzure\Storage\Blob\BlobRestProxy;
  use MicrosoftAzure\Storage\Common\ServiceException;
  use WindowsAzure\Common\ServicesBuilder;
  
 
  $connectionString = "BlobEndpoint=https://nidndvloyaidslnasse02sta.blob.core.windows.net/;SharedAccessSignature=".$Sas; //Enter deployment key
  $blobClient = BlobRestProxy::createBlobService($connectionString);

  $file_name = "Temp/".$_GET['File'];
  error_log($file_name);
  $ext = pathinfo($file_name, PATHINFO_EXTENSION);
  $content = fopen($file_name, "r");
  $blob_name = str_replace("Temp/","",$file_name);

  try {
    //Upload blob
    $blobClient->createBlockBlob($containerName, $blob_name, $content);
    unlink("Temp/".$blob_name);
    
  } catch (ServiceException $e) {
    $code = $e->getCode();
    $error_message = $e->getMessage();
    echo $code.": ".$error_message.PHP_EOL;
 }

?> 


