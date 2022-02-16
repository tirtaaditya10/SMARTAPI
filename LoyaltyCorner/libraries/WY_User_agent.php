<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class WY_User_Agent extends CI_User_agent {
    public function __construct() {
        parent::__construct();
		$this->ci =& get_instance();
		$this->ignore = $this->ci->session->userdata('ignore_browser', true) ? 1 : 0;
    }
	public function profile() {
		$name 		= 'unknown';
		$code 		= 'unknown';
		$version	= 0;
		$compliance	= 0;
		$os			= 'unknown';
		$vendor		= 'unknown';
		$type		= 'unknown';
		if($this->is_browser()) {
			$name       = $this->browser();
			$type		= 'browser';
			$version    = floatval(substr($this->version(), 0, 3));
			$compliance = 0;
			$code		= str_replace('internet explorer', 'ie', strtolower($name));
			switch($name) {
				case 'Firefox':
					$compliance = ($version >= 50) ? 1 : 0;
					$vendor		= 'Mozilla';
					break;
				case 'Mozilla':
					$compliance = ($version >= 50) ? 1 : 0;
					break;
				case 'Gekco':
					$compliance = ($version >= 1.8) ? 1 : 0;
					break;
				case 'Internet Explorer':
					$compliance = ($version >= 11) ? 1 : 0;
					$vendor		= 'Microsoft';
					break;
				case 'Edge':
					$compliance = ($version >= 14) ? 1 : 0;
					$vendor		= 'Microsoft';
					break;
				case 'Opera':
					$compliance = ($version >= 41) ? 1 : 0;
					$vendor		= 'Opera';
					break;
				case 'Safari':
					$compliance = ($version >= 10) ? 1 : 0;
					$vendor		= 'Apple';
					break;
				case 'Chrome':
					$compliance = ($version >= 54) ? 1 : 0;
					$vendor		= 'Google';
					break;
				default:
					$code = 'Others';
					break;
			}
		}
		elseif ($this->is_mobile()) {
			$type		= 'mobile';
			$name       = $this->browser();
			$version    = $this->version();
			$code		= str_replace('internet explorer', 'ie', strtolower($name));
		}
		elseif ($this->is_robot()) {
			$type		= 'robot';
			$name       = $this->browser();
			$version    = $this->version();
			$code		= strtolower($name);
		}
		elseif ($this->is_referral()) {
			$type		= 'referral';
			$name       = $this->browser();
			$version    = $this->version();
			$code		= strtolower($name);
		}
		else {
			$type		= 'unknown';
			$name       = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'unknown';
			$version    = 'unknown';
			$code		= strtolower($name);
		}
        return array("name"=>$name, "code"=>$code, "version"=>$version, "compliance"=>$compliance, "ignore"=>$this->ignore, 'os'=>strtolower($this->platform()), 'vendor'=>$vendor, 'type'=>$type);
    }
}
// end of file BL_User_agent.php
