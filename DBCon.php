<?php

$value = getenv('DBCON');

$connectstr_dbhost	= preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
$connectstr_dbname	= preg_replace("/^.*Initial Catalog=(.+?);.*$/", "\\1", $value);
$connectstr_dbusername	= preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
$connectstr_dbpassword	= preg_replace("/^.*Password=(.+?)$/", "\\1", $value);

$serverName		= $connectstr_dbhost;   
$uid			= $connectstr_dbusername;     
$pwd			= $connectstr_dbpassword;
$databaseName		= $connectstr_dbname;  

?>