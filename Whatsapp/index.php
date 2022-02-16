<?php

  $files = "Logs/WA_Media_Log_".date('Y-m-d', strtotime($date. ' - 1 days')).".log";

  if (file_exists($files)) {
	$srcfileName ="Logs-WA_Media_Log_".date('Y-m-d', strtotime($date. ' - 1 days')).".log";
        $srcContent = "Logs/WA_Media_Log_".date('Y-m-d', strtotime($date. ' - 1 days')).".log";

	include "../Library/FileShare/PushFile.php";

        unlink($files);
  }

?>