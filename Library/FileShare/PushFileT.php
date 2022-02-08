<?php
$value = getenv('StorageCon');

    //INI YANG DITARIK
    $srcfileName ='index.php';

    $srcContent = 'index.php';

    $accountName = preg_replace("/^.*AccountName=(.+?);.*$/", "\\1", $value);
    $accountKey = preg_replace("/^.*AccountKey=(.+?);.*$/", "\\1", $value);

echo $accountName;
echo $accountKey;

