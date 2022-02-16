<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
/* DBlog_Hook.php */
/* Location: ./system/application/hooks/DBlog_Hook.php */

class DBlog_Hook {
	
	var $path = 'system/logs/';
	
	function DBlog_Hook() {
		$this->CI =& get_instance();
	}
	
	function log_all_query() {
		$dbs    = array();
		$output = null;
		
		$queries = $this->CI->db->queries;
		
		if (count($queries) == 0) {
			$output .= "no queries\n";
		}
		else {
			foreach ($queries as $query) {
				$output .= $query . "\n";
			}
			$output .= "===\n";
		}
		
		$this->CI->load->helper('file');
		if (!write_file($this->path . 'queries.txt', $output, 'a+')) {
			log_message('debug', 'Unable to write the file');
		}
	}
}