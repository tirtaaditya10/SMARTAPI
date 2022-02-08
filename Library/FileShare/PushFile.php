<?php

    //INI YANG DITARIK
    $srcfileName ='index.php';

    $srcContent = 'index.php';

    require_once "vendor/autoload.php"; 
    use MicrosoftAzure\Storage\File\FileRestProxy;
    use MicrosoftAzure\Storage\Common\Models\Range;

    $shareName = "fs-smart-1";

    $connectionString = "DefaultEndpointsProtocol=https;AccountName=nidndvloyaidslnasse02sta;AccountKey=6dc7Q~_KED8X7UvUTj~susUYeDnGtfXqwYUGt";
    $fileClient = FileRestProxy::createFileService($connectionString);

    $content = file_get_contents("$srcContent");

    $range = new Range(0, filesize($srcfileName) - 1);
    $sourcePath = sprintf(
    '%s%s/%s',
    (string)$fileClient->getPsrPrimaryUri(),
    $shareName,
    $srcfileName
);

try {
    $fileClient->createFileFromContent($shareName, $srcfileName, $content, null);

} catch (ServiceException $e) {
    $code = $e->getCode();
    $error_message = $e->getMessage();
    echo $code . ": " . $error_message . PHP_EOL;
}