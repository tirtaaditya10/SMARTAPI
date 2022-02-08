<?php
	$system_path = 'c:/www/ci319';
	define('BASEPATH', $system_path);
	
	require_once 'dyn_helper.php';
	// 'ins','upd','del','bat','doc','exp'
	$x =  date('Y-m-d H:i:s', 1536566026);
	dump($x);
