<?php
function smarty_modifier_phone_format($phone) {
	// note: making sure we have something
	if(!isset($phone{3})) { return ''; }
	// note: strip out everything but numbers
	$phone  = preg_replace("/[^0-9]/", "", $phone);
	$length = strlen($phone);
	if(preg_match('/^08/', $phone)) {
		switch ($length) {
			case 10:
				// 0811 888-005
				$phone = preg_replace("/([0-9]{4})([0-9]{3})([0-9]{3})/", "$1 $2-$3", $phone);
				break;
			case 11:
				// 0811 888-0055
				$phone = preg_replace("/([0-9]{4})([0-9]{3})([0-9]{4})/", "$1 $2-$3", $phone);
				break;
			case 12:
				// 0811 8888-0055
				$phone = preg_replace("/([0-9]{4})([0-9]{4})([0-9]{4})/", "$1 $2-$3", $phone);
				break;
			case 13:
				// 0811 8888-00555
				$phone = preg_replace("/([0-9]{4})([0-9]{4})([0-9]{5})/", "$1 $2-$3", $phone);
				break;
			case 14:
				// 0811 88123-00555
				$phone = preg_replace("/([0-9]{4})([0-9]{5})([0-9]{5})/", "$1 $2-$3", $phone);
				break;
		}
	}
	elseif(preg_match('/628/', $phone)) {
		switch ($length) {
			case 11:
				// (62)811-888-005
				$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{3})/", "0$2 $3-$4", $phone);
				break;
			case 12:
				// (62)811-888-0055
				$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})/", "0$2 $3-$4", $phone);
				break;
			case 13:
				// (62)811-8888-0055
				$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{4})([0-9]{4})/", "0$2 $3-$4", $phone);
				break;
			case 14:
				// (62)811-8888-00555
				$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{4})([0-9]{5})/", "0$2 $3-$4", $phone);
				break;
			case 15:
				// (62)811-8888-0055
				$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{5})([0-9]{5})/", "0$2 $3-$4", $phone);
				break;
		}
	}
	else {
		if(preg_match('/^62(21|22|24|31|61)/', $phone)) {
			switch ($length) {
				case 9:
					// (62)21-88-005
					$phone = preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{3})/", "(0$2) $3-$4", $phone);
					break;
				case 10:
					// (62)21-888-005
					$phone = preg_replace("/([0-9]{2})([0-9]{2})([0-9]{3})([0-9]{3})/", "(0$2) $3-$4", $phone);
					break;
				case 11:
					// (62)21-888-0055
					$phone = preg_replace("/([0-9]{2})([0-9]{2})([0-9]{3})([0-9]{4})/", "(0$2) $3-$4", $phone);
					break;
				case 12:
					// (62)21-8888-0055
					$phone = preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})([0-9]{4})/", "(0$2) $3-$4", $phone);
					break;
			}
		}
		elseif(preg_match('/^62(230-799)/', $phone)) {
			switch($length) {
				case 9:
					// (62)230-88-05
					$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{2})([0-9]{2})/", "(0$2) $3-$4", $phone);
					break;
				case 10:
					// (62)230-88-005
					$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{2})([0-9]{3})/", "(0$2) $3-$4", $phone);
					break;
				case 11:
					// (62)230-888-055
					$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{3})/", "(0$2) $3-$4", $phone);
					break;
				case 12:
					// (62)230-888-0555
					$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})/", "(0$2) $3-$4", $phone);
					break;
				case 13:
					// (62)230-8888-0555
					$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{4})([0-9]{4})/", "(0$2) $3-$4", $phone);
					break;
			}
		}
	}
	return $phone;
}