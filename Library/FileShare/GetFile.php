<?php

//Rubah ini ya nanti
$fileName = 'index.php';
$shareName = "fs-smart-1";


require_once "vendor/autoload.php";
use MicrosoftAzure\Storage\Common\Internal\Resources;
use MicrosoftAzure\Storage\File\FileSharedAccessSignatureHelper;

$value = getenv('STORAGECON');

$accountName = preg_replace("/^.*AccountName=(.+?);.*$/", "\\1", $value);
$accountKey = preg_replace("/^.*AccountKey=(.+?);.*$/", "\\1", $value);

$now = date(DATE_ISO8601);
$date = date_create($now);
date_add($date, date_interval_create_from_date_string("1 hour"));
$expiry = str_replace("+0000", "Z", date_format($date, DATE_ISO8601));

$helper = new FileSharedAccessSignatureHelper($accountName, $accountKey);
$sas = $helper->generateFileServiceSharedAccessSignatureToken(
        Resources::RESOURCE_TYPE_FILE,
        "$shareName/$fileName",
        'r',
        $expiry
    );
$fileUrlWithSAS = "https://$accountName.file.core.windows.net/$shareName/$fileName?$sas";
echo $fileUrlWithSAS;

?>