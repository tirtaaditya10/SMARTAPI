<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
/* application/hooks/LogQueryHook.php */

class LogQueryHook {
	
	function log_queries() {
		$CI     =& get_instance();
		$times  = $CI->db->query_times;
		$dbs    = array();
		$output = null;
		$queries = $CI->db->queries;
		
		if (count($queries) == 0) {
			$output .= "no queries\n";
		}
		else {
			foreach ($queries as $key => $query) {
				$time = $this->CI->db->query_times[$key];
				
				$output .= $query . "-" . $time . "\n";
				// $output .= $query . "\n";
			}
			$took    = round(doubleval($times[$key]), 3);
			$output .= "===[took:{$took}]\n\n";
		}
		
		$CI->load->helper('file');
		if (!write_file(APPPATH . "/logs/queries.log.txt", $output, 'a+')) {
			log_message('debug', 'Unable to write query the file');
		}
	}
}

