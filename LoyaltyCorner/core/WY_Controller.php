<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
	qp(a|s|c)    = query parameter  (a=array, s=string, c=copy)
	sp(a|s|x)    = search parameter (a=array, s=string, x=special)
	ri(d|c)      = request          (d=id, c=code)
	sfn          = sibling function (from other controller)
	wf(a|s)      = workflow (a=approval, s=task)
	cmt          = comment
	ntf          = notification
	uta          = user target audience
	aut          =
 **/

class WY_Controller extends CI_Controller {
	protected $sys;
	protected $svc;
	
	public      function __construct($app = 1) {
		parent::__construct();
		$this->benchmark->mark('code_start');
		
		header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		header("Cache-Control: private");
		header("Pragma: no-cache");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("If-Modified-Since: Mon, 22 Jan 2008 00:00:00 GMT");
		
		$agent = $this->agent->profile();
		$index = $this->config->item('index_page');
		$base  = $this->config->item('base_url');
		
		$this->sys['cfg']           = array('app' => null);
        $this->sys['cfg']['host']   = $base;
		$this->sys['cfg']['asset']  = str_replace(array('https:'), "http", $base) . 'asset/';
		$this->sys['cfg']['url']    = empty($index) ? $this->sys['cfg']['host'] : $this->sys['cfg']['host'] . $index;
		$this->sys['cfg']['csrf']   = $this->security->get_csrf_hash();
		$this->sys['cfg']['agent']  = $agent;
		$this->sys['cfg']['debug']  = 2; // 0: no-debug, 1:full-debug, 2:sys_process only
		
		$this->sys['usr']   = array();
		$this->sys['req']   = array(
			'cmd' => 'inq',     'rid' => 0,
            'pid' => null,      'fid' => null,  'xid' => null,  'yid' => null,  'zid' => null,
			'out' => 'html',
			'tab' => null,
			// page, limit, nav, search_text_type
			'p'   => 1,          'l'  => 10,    'n'   => false,  's'  => null,  'f'   => null,
			// crud command
			'aud' => null,      'ro' => 0,
            'pst' => array(),
            'upl' => array()
		);
		$this->sys['bpm']   = array(
			'tbl'       => null,    'qry'       => null,    'bpm'       => null,
			'qp_arr'    => array(), 'qp_str'    => '',      'sp_arr'    => array(),
			'off'       => null,    'ord'       => null,
			'cfg'       => array(
				'tbm'   => true,        // flag: table-master
				'ccd'   => null,        // cascade delete
				'tree'  => 0),
			'has'       => array(),
			'aux'       => array(),
			'ext'       => array(),
			'sfn'       => array(
				'pre'   => null,
				'xtd'   => null)
		);
		$this->sys['svc']   = array();
		$this->sys['prc']   = array();
		$this->sys['rpc']   = array();
		$this->sys['nav']   = array();
		$this->sys['uix']   = array(
			'tpl' => null,     'top' => true,      'hst' => null,  'aside' => array(),
			'tab' => null,     'nav' => null,      'gui' => null,  'uxt'   => null,
			'pcm' => 'PCM',    'pcd' => 'PCD',     'pct' => 'PCT',
			'g2x' => 'g2l',    'elm' => 'elm/bs3', 'fwd' => false,
			'reload' => false,
			'btnUpd' => true,  'btnDel'=> true,   'btnCls' => true
		);
		$this->sys['tbl']   = array();
		$this->sys['aaa']   = array('uta' => array('act' => '',    'role'=>'',      'orgz'   => '',      'cmop'   => '',      'geo' => ''));
		$this->sys['ack']   = array('err' => 0,             'msg'       => '');
		$this->sys['err']   = array('error_code' => null,   'error_msg' => null);
		
		$this->sys['rsp']   = array(
			'dat' => null,      'ref'   => null,
			'meta'=> array(),   'menu'  => array(),     'bc' => array(),
			'prf' => array()        // performance
		);
		
		$this->MAAA->sync($this->sys);
		$this->model->sync($this->sys);
		
		// $this->model->sys_load('tbl');
		$this->model->sys_cfg('sys', $app);
		$this->sys['event'] = array(
			'id'                    => uuid(),
			'is_log'                => false,
			'sys_app_id'            => $app,
			'sys_response_code_id'  => 0,
			'aaa_account_id'        => 1002,
			'aaa_audit_trail_id'    => 'inquiry',
			'event_ts_in'           => $this->sys['cfg']['ts'],
			'url'                   => $_SERVER['REQUEST_URI'],
			'ip'                    => $this->input->ip_address(),
			'computer_name'         => gethostbyaddr($_SERVER['REMOTE_ADDR']),
			'agent_browser'         => $agent['name'],
			'agent_browser_version' => $agent['version'],
			'agent_os'              => $agent['os'],
			'agent_vendor'          => $agent['vendor'],
			'agent_type'            => $agent['type']
		);
	}
	protected   function clear_cache() {
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
	}
	
	protected   function init_sys_req($cmd, $rid) {
		/** registered command:
		 *  get ->  inq | inf | opt
		 *  post -> add | upd | del | upl | unique
		 *  url -> rid/pid/fid/xid/yid/zid(redirect/out)
		*/
		$this->init_sys_req_std($cmd, $rid);

		if ($this->sys['req']['zid'] == 'redirect') {
			// re-init after aud
			$this->sys['req']['zid'] = 0;
			$nav = $this->session->userdata('nav');
			if (!$this->sys['req']['pid'] && $this->sys['req']['rid'] == $nav['rid'] && !empty($this->sys['req']['aud'])) {
				$this->sys['req']['p']      = $nav['p'];
				$this->sys['req']['l']      = $nav['l'];
				$this->sys['req']['f']      = $nav['f'];
				$this->sys['req']['s']      = $nav['s'];
				$this->sys['bpm']['sp_arr'] = $nav['sp_arr'];
			}
		}
		else {
			// request-id is valid
			if(!$this->sys['ack']['err']) {
				// exception
				switch ($this->sys['req']['cmd']) {
					case 'splash':
					case 'unique':
						$this->sys['req']['out'] = null;
						break;
					
					case 'upl':
					case 'opt':
					case 'acs':
						$this->sys['req']['pid'] = $this->uri->segment(4);
						$this->sys['req']['fid'] = $this->uri->segment(5);
						$this->sys['req']['xid'] = $this->uri->segment(6);
						$this->sys['req']['yid'] = $this->uri->segment(7);
						$this->sys['req']['zid'] = $this->uri->segment(8);
						$this->sys['req']['out'] = $this->uri->segment(9, 'html');
						break;
					
					case 'inq' :
					case 'aud' :
						if ($this->sys['req']['zid'] != 'redirect') {
							if (is_numeric($this->uri->segment(2))) {
								$this->sys['req']['pid'] = $this->uri->segment(3);
								$this->sys['req']['fid'] = $this->uri->segment(4);
								$this->sys['req']['xid'] = $this->uri->segment(5);
								$this->sys['req']['yid'] = $this->uri->segment(6);
								$this->sys['req']['zid'] = $this->uri->segment(7);
							}
							else {
								$this->sys['req']['pid'] = $this->uri->segment(4);
								$this->sys['req']['fid'] = $this->uri->segment(5);
								$this->sys['req']['xid'] = $this->uri->segment(6);
								$this->sys['req']['yid'] = $this->uri->segment(7);
								$this->sys['req']['zid'] = 0;
							}
						}
						break;
					default :
						// unknown command
						if(method_exists($this, $this->sys['req']['cmd'])) {
							// $this->sys['req']['rid'] = $rid;
							$this->sys['req']['pid'] = $this->uri->segment(4);
							$this->sys['req']['fid'] = $this->uri->segment(5);
							$this->sys['req']['xid'] = $this->uri->segment(6);
							$this->sys['req']['yid'] = $this->uri->segment(7);
							$this->sys['req']['zid'] = $this->uri->segment(8);
						}
						else
							$this->sys['ack']['err'] = 404;
						break;
				}
				
				// referer
				if(is_numeric($this->sys['req']['rid']))
					if($this->sys['req']['rid']) {
						$this->sys['req']['uri'] = $this->session->userdata('referer');
						$this->session->set_userdata('referer', str_replace($this->sys['cfg']['app']['id_code'] . '/', '', $this->sys['req']['uri']));
					}
					else
						$this->session->unset_userdata('referer');
				
				// out
				switch($this->sys['req']['cmd']) {
					case 'acs':
						if(empty($this->sys['req']['q'])) {
							if ($this->sys['req']['pid'])
								$this->sys['req']['q'] = urldecode($this->sys['req']['pid']);
							elseif (!empty($this->sys['req']['term']))
								$this->sys['req']['q'] = urldecode($this->sys['req']['term']);
							elseif (!empty($this->sys['req']['query']))
								$this->sys['req']['q'] = urldecode($this->sys['req']['query']);
						}
						break;
				}
			}
		}
		
		$this->init_sys_model();
		
		if($this->sys['ack']['err'])
			$this->init_err();
	}
	private     function init_sys_req_std($cmd, $rid) {
		// default;
		$this->sys['req']['cmd'] = $cmd;
		$this->sys['req']['rid'] = $rid;
		if (empty($cmd) || is_numeric($cmd)) {
			$this->sys['req']['cmd'] = 'inq';
			$this->sys['req']['rid'] = $cmd;
		}
		
		// exception
		$tmp = explode('.', $cmd);
		if(isset($tmp[1])) {
			/** registered standard output: html (default), xls, doc, pdf, json
			 *  registered special output: opt, inf, acs, unq (option, info, auto-complete, unique-pk)
			 *  next-dev : rpt -> report, chart
			**/
			$this->sys['req']['cmd'] = 'inq';
			
			$this->sys['req']['rid'] = $tmp[0];
			$this->sys['req']['out'] = $tmp[1];
		}
		
		// -> normalize cmd
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':
				$this->init_sys_req_xtd_get();
				break;
			case 'POST':
				if($this->sys['req']['zid'] == 'redirect')
					$this->init_sys_req_xtd_get();
				else
					$this->init_sys_req_xtd_post();
				break;
			default:
				/**
				 *  todo: learn first
				 *  $this->input->cookie()
				 *  $this->input->server()
				 *
				 */
				break;
		}
		
		if($_FILES) {
			if($this->sys['req']['cmd'] == 'inq')
				$this->sys['req']['cmd'] = 'upl';
			
			$this->load->library('upload');
			$this->init_sys_var('svc_upl');
		}
		
		/**
		 *  todo
		 *  If you want to utilize the PUT, DELETE, PATCH or other exotic request methods, they can only be accessed via a special input stream, that can only be read once. This isn’t as easy as just reading from e.g. the $_POST array, because it will always exist and you can try and access multiple variables without caring that you might only have one shot at all of the POST data.
		 *  $this->input->raw_input_stream;
		 *
		 *  Additionally if the input stream is form-encoded like $_POST you can access its values by calling the input_stream() method:
		 *  $this->input->input_stream('key');
		 *
		 **/
		
		// detect controller and method
		$this->sys['cfg']['app']['ctrl'] = $this->router->class;
		$this->sys['cfg']['app']['cdir'] = $this->router->directory;
	}
	private     function init_sys_req_xtd_get() {
		// -> normalize arg from query-string
		parse_str($_SERVER['QUERY_STRING'], $qs);
		if ($qs) {
			foreach ($qs as $k => $v) {
				is_array($v) && $v = array_filter(array_values($v));
				if($v != '') {
					switch ($k) {
						case 'p':
						case 'f':
						case 's':
						case 'n':
						case 'q':
							$this->sys['req'][$k] = $v;
							break;
						case 'l':
							if($this->sys['req']['l'] != $v)
								$this->sys['req']['p'] = 1;
							$this->sys['req'][$k] = $v;
							break;
							
						case preg_match('/start|begin/', $k) == 1:
							$this->sys['bpm']['sp_arr'][$k] = ">= $v";
							break;
						
						case preg_match('/end|finish/', $k) == 1:
							$this->sys['bpm']['sp_arr'][$k] = "<= $v";
							break;
						
						default:
							if (is_array($v) && ($v = array_filter(array_values($v)))) {
								if (is_date($v[0]) && $v[0] = date_iso8601($v[0])) {
									if(!empty($v[1]) && is_date($v[1]) && $v[1] = date_iso8601($v[1]))
										$this->sys['bpm']['sp_arr'][$k] = "between '" . implode("' and '", $v) . "'";
									else
										$this->sys['bpm']['sp_arr'][$k] = $v[0];
								}
								else
									$this->sys['bpm']['sp_arr'][$k] = "in ('" . implode("','", $v) . "')";
							}
							else {
								if(!is_numeric($v) && is_date($v)) {
									$v = date_iso8601($v);
									$this->sys['bpm']['sp_arr'][$k] = "between '$v 00:00:00' and '$v 23:59:59'";
								}
								else
									$this->sys['bpm']['sp_arr'][$k] = $v;
							}
							break;
					}
					
				}
			}
			if($this->sys['req']['s'] && $this->sys['req']['f'])
				$this->sys['req']['p'] = 1;
			
			if($this->sys['req']['n'] || $this->sys['req']['s']) {
				$this->session->set_userdata('nav', array(
					                                  'rid'     => $this->sys['req']['rid'],
					                                  'sp_arr'  => $this->sys['bpm']['sp_arr'],
					                                  'p'       => $this->sys['req']['p'],
					                                  'l'       => $this->sys['req']['l'],
					                                  's'       => $this->sys['req']['s'],
					                                  'f'       => $this->sys['req']['f'])
				);
			}
			unset($this->sys['req']['_']);
			$this->sys['req']['uri'] = $this->uri->uri_string();
		}
	}
	private     function init_sys_req_xtd_post() {
		$pst = $this->input->post(null, true);
		// $pst = $this->input->post();
		// $pst = $_POST;
		if(isset($pst['act'])) {
			// override cmd from pst
			$this->sys['req']['cmd'] = isset($pst['act']) ? $pst['act'] : 'add';
			switch($act = $pst['act']) {
				case 'add':
				case 'upd':
				case 'del':
					$this->sys['req']['cmd'] = 'aud';
					$this->sys['req']['aud'] = $act;
					break;
			}
		}
		else {
			switch ($this->sys['req']['cmd']) {
				case 'jsn':
					// $this->sys['req']['cmd'] = 'upl';
					break;
				case 'unq':
				case 'unique': // url: cmd/tbl
					if ($this->sys['req']['pid'])
						$this->sys['req']['xid'] = $this->sys['req']['pid'];
					
					foreach ($pst as $x => $y) {
						$this->sys['req']['pid'] = $x;
						$this->sys['req']['fid'] = $y;
					}
					break;
			}
		}
		
		unset($pst['act'], $pst['csrf_blg'], $pst['_wysihtml5_mode']);
		if($pst)
			$this->sys['req']['pst'] = $pst;
	}
	
	protected   function init_sys_cmd($cmd, $rid) {
		$this->init_sys_req($cmd, $rid);
		if(!$this->sys['ack']['err']) {
			if ($this->sys['req']['rid']) {
				$cmd = $this->sys['req']['cmd'];
				$ctr = $this->sys['cfg']['app']['ctrl'] . '_';
				
				if ($cmd == 'inq')
					$ctr .= $this->sys['req']['pid'] ? 'frm' : 'lst';
				
				$this->sys['bpm']['sfn']['pre'] = "sys_cmd_{$cmd}_{$ctr}_pre";
				$this->sys['bpm']['sfn']['xtd'] = "sys_cmd_{$cmd}_{$ctr}_xtd";
			}
			
			switch ($this->sys['req']['cmd']) {
				case 'inq':
					if (in_array($this->sys['req']['out'], array('opt', 'acs', 'inf', 'upl', 'helper', 'viewer'))) {
						$call = "init_sys_cmd_{$this->sys['req']['out']}";
						$this->$call();
					}
					else {
						if($this->sys['req']['rid'])
							$this->smarty->assign('aud', $this->session->flashdata('aud'));
						
						if(!$this->input->is_ajax_request())
							$this->init_sys_cmd_inq_menu();
						
						$this->init_sys_cmd_inq();
					}
					break;
				
				case 'aud':
					$this->sys['req']['out'] = null;
					$this->init_sys_cmd_aud();
					break;
				
				case 'upl':
					$this->sys['req']['out'] = 'json';
					$this->init_sys_cmd_upl();
					break;
					
				case 'splash':
				case 'opt':
				case 'acs':
				case 'inf':
					$call = "init_sys_cmd_{$this->sys['req']['cmd']}";
					$this->$call();
					break;
				
				case 'unq':
				case 'unique':
					$this->sys['req']['out'] = null;
					echo $this->init_sys_cmd_unq();
					break;
				
				case 'chart':
					$this->sys['req']['out'] = null;
					$this->init_sys_cmd_chart();
					if (isset($this->sys['rsp']['jsonn'])) {
						$this->sys['rsp']['chart'] = json_encode($this->sys['rsp']['jsonn'], JSON_PRETTY_PRINT);
						unset($this->sys['rsp']['jsonn']);
					}
					echo $this->sys['rsp'];
					break;
				
				default:
					if (method_exists($this, $cmd)) {
						// output dispatch defined in each method
						$this->sys['req']['out'] = null;
						$this->$cmd();
					}
					else
						$this->sys['ack']['err'] = 404;
					break;
			}
			
			if (!$this->sys['ack']['err']) {
				// => no processing error
				switch ($this->sys['req']['out']) {
					case 'json':
					case 'jsonn':
					case 'jsonp':
						$this->init_dispatch_json();
						break;
					
					case 'html':
					case 'xml':
					case 'Batch':
					case 'xls_tpl':
					case 'xls_wkhtml':
					case 'doc':
					case 'pdf':
						$out = "init_dispatch_{$this->sys['req']['out']}";
						$this->$out();
						break;
				}
			}
			else
				$this->init_err();
		}
	}
	private     function init_sys_cmd_inq() {
		$this->sys_cmd_inq();
	}
	private     function init_sys_cmd_inq_menu() {
		// if($this->sys['req']['rid'] === 0)
			$this->model->sys_rsp_menu();
	}
	
	private     function init_sys_cmd_aud() {
		$datain = $this->sys['req']['pst'];
		unset($datain['password']);
		$act = array('add' => 'insert', 'upd' => 'update', 'del' => 'delete', 'upl' => 'upload');
		$this->sys['event']['aaa_audit_trail_id']   = $act[$this->input->post('act', true)];
		$this->sys['event']['datain']               = json_encode($datain);
		$datain = null;

		$this->model->sys_cmd_aud();

		if(!$this->sys['ack']['err']) {
			if($this->sys['uix']['g2x'] == 'gno')
				echo $this->sys['ack']['msg'];
			else  {
				if(is_string($this->sys['uix']['g2x'])) {
					$this->session->unset_userdata('uix_fwd');
					if ($this->sys['uix']['g2x'] == 'g2l' || $this->sys['req']['cmd'] == 'del')
						$this->sys['req']['pid'] = 0;
					else {
						if ($this->sys['req']['pid'] == 'new') {
							$col = $this->sys['bpm']['tbl'] . '_id';
							if (isset($this->sys['bpm']['aux'][$col]))
								$this->sys['req']['pid'] = $this->sys['bpm']['aux'][$col];
						}
					}
				}
				else {
					// forward to another sys-process
					$this->sys['req']['rid'] = $this->sys['uix']['g2x']['rid'];
					$this->session->set_userdata('uix_fwd', $this->sys['req']['rid']);
					
					if ($this->sys['uix']['g2x']['whr'] == 'g2l')
						$this->sys['req']['pid'] = 0;
					else {
						if ($this->sys['req']['pid'] == 'new') {
							$col = $this->sys['bpm']['tbl'] . '_id';
							if (isset($this->sys['bpm']['aux'][$col]))
								$this->sys['req']['pid'] = $this->sys['bpm']['aux'][$col];
						}
					}
				}
				$this->sys['req']['cmd'] = 'inq';
				$this->sys['req']['zid'] = 'redirect';
				// $this->sys['bpm']['ord'] = '';
				$this->init_sys_cmd($this->sys['req']['cmd'], $this->sys['req']['rid']);
			}
		}
		else {
			echo 'error';
		}
	}
	
	private     function init_sys_cmd_inf() {
		// $out: html, xml, json, jsonp
		$this->model->sys_cmd_inf();
		
		if($this->sys['req']['out'] == 'html') {
			$this->smarty->display("{$this->sys['uix']['tpl']}/inf/{$this->sys['req']['rid']}.tpl");
		}
		else {
			$this->sys['req']['out'] = isset($this->sys['req']['callback']) ? 'jsonp' : 'json';
			
			if($this->sys['req']['out'] == 'jsonp')
				header("access-control-allow-origin: *");
			if($this->sys['req']['out'] == 'jsonp' && !is_valid_callback($this->sys['req']['callback'])) {
				header('status: 400 Bad Request', true, 400);
				exit();
			}
			if($this->sys['rsp']['dat']) {
				if(isset($this->sys['rsp']['tot']))
					$this->sys['rsp']['dat'] = array('total'=>count($this->sys['rsp']['tot']), 'items'=>$this->sys['rsp']['dat']);
				
				if($this->sys['req']['out'] == 'jsonp') {
					$jsn        = json_encode($this->sys['rsp']['dat']);
					$this->sys['rsp']['dat'] = "{$this->sys['req']['callback']}($jsn)";
				}
			}
			echo $this->sys['rsp']['dat'];
		}
	}
	private     function init_sys_cmd_opt() {
		// out: html, xml, json, jsonp
        $opt = '';
		$this->model->sys_cmd_opt();
		if($this->sys['req']['out'] == 'echo') {
			$opt = '<option value=""></option>';
			if(!empty($this->sys['rsp']['dat']))
				foreach($this->sys['rsp']['dat'] as $k => $v) {
					$disabled   = !empty($v['disabled']) ? ' disabled'   : false;
					$icon       = !empty($v['icon'])     ? $v['icon']    : false;
					$title      = !empty($v['title'])    ? $v['title']   : false;
					$subtext    = !empty($v['subtext'])  ? $v['subtext'] : false;
					$content    = !empty($v['content'])  ? $v['content'] : false;
					$value      = !empty($v['value'])    ? $v['value']   : false;
					$opt .= "<option value='{$v['id']}'";
					$opt .= $title   ? " title='$title'" : '';
					$opt .= $icon    ? " data-icon='$icon'" : '';
					$opt .= $value   ? " data-value='$value'" : '';
					$opt .= $subtext ? " data-subtext='$subtext'" : '';
					$opt .= $content ? " data-content='$content'" : '';
					$opt .= $disabled;
					$opt .= ">{$v['nm']}</option>";
				}
			echo $opt;
			
		}
		else {
			$this->sys['req']['out'] = isset($this->sys['req']['callback']) ? 'jsonp' : 'json';
			
			if($this->sys['req']['out'] == 'jsonp')
				header("access-control-allow-origin: *");
			if($this->sys['req']['out'] == 'jsonp' && !is_valid_callback($this->sys['req']['callback'])) {
				header('status: 400 Bad Request', true, 400);
				exit();
			}
			if(isset($this->sys['rsp']['dat']) && $this->sys['rsp']['dat']) {
				if(isset($this->sys['rst']['tot']))
					$opt = array('total'=>count($this->sys['rsp']['tot']), 'items'=>$this->sys['rsp']['dat']);
				else
					$opt = $this->sys['rsp']['dat'];
				
				if($this->sys['req']['out'] == 'jsonp') {
					$jsn = json_encode($opt);
					$opt = "{$this->sys['req']['callback']}($jsn)";
				}
			}
		}
	}
	private     function init_sys_cmd_acs() {
		$this->sys['req']['out'] = 'json';
		$this->model->sys_cmd_acs();
	}
	private     function init_sys_cmd_unq() {
		// url: rid/<column>/<value>
		return $this->model->sys_cmd_unq();
	}
	private     function init_sys_cmd_upl() {
		// flow -> ctrl - model || app -> model
		$this->model->sys_var('sys_upload', $this->sys);
		
		switch($this->sys['req']['rid']) {
			case 'tpl':
				$this->sys['bpm']['aux']['cmd'] = 'tpl';
				$this->sys['bpm']['aux']['tbl'] = $this->sys['req']['xid'] ? $this->sys['req']['xid'] : 'dms_doc_path';
				
				$this->model->sys_cmd_upl();
				
				$this->sys['req']['out'] = 'smarty';
				$this->smarty->assign('accept', 'doc');
				$this->smarty->assign('obj', 'doc');
				$this->smarty->assign('loc', 'fix');
				$this->smarty->assign('sys', $this->sys);
				$this->smarty->display('__ecm/dms/dms_upload.tpl');
				break;
			
			case 'del':
				$this->sys['event']['event']                = 'Delete Doc';
				$this->sys['event']['aaa_audit_trail_id']   = 'delete';
				$this->sys['bpm']['aux']['tbl']             = $this->sys['req']['fid'];
				if(preg_match('/path$/', $this->sys['req']['fid']))
					$this->sys['bpm']['aux']['cmd'] = 'del_paths';
				else
					$this->sys['bpm']['aux']['cmd'] = 'del_path';
				
				$this->model->sys_cmd_upl();
				if($this->sys['rsp']['dat'] != 'error')
					@unlink($this->sys['rsp']['dat']);
				break;
			
			case 'doc':
			case 'img':
				// url -> rid - pid - loc - dms_catalog - table
				
				$UPL = null;
				if(isset($_FILES['file']))      $UPL = $_FILES['file'];
				elseif(isset($_FILES['docs']))  $UPL = $_FILES['docs'];
				
				if($UPL['name']) {
					$ext = strtolower(pathinfo($UPL['name'], PATHINFO_EXTENSION));
					
					$this->sys['req']['pst'] = $_POST;

					$xtd = $this->sys['prc']['rid'];
					if(isset($this->sys['req']['pst']['cat']) && $this->sys['req']['pst']['cat'])
						$cat = $this->sys['req']['pst']['cat'];
					elseif(isset($xtd['dms_catalog_id']))
						$cat = $xtd['dms_catalog_id'];
					else
						$cat = $this->sys['req']['yid'];
					
					if(!empty($this->sys['req']['pst']['nik'])) {
						$this->sys['req']['pst']['id_code'] = $this->sys['req']['pst']['nik'];
						unset($this->sys['req']['pst']['nik']);
					}
					
					// $this->sys['bpm']['aux']['tbl'] = $this->sys['req']['pst']['tbl'];
					$dmt = $this->model->proxy('util_db_qry', 'dms_media_type', array('mime' => "like '%$ext%'"));
					
					if(isset($xtd['wfs_jsn']) && $xtd['wfs_jsn'])
						$this->sys['bpm']['wfs']['wfs_jsn'] = $xtd['wfs_jsn'];
					
					
					if($cat) {
						$cfg = $this->model->proxy('util_db_qry', 'dms_catalog', $cat);
						$cfg['rename_to'] && $cfg['rename_to'] = json_decode($cfg['rename_to'], true);
						
						$file = 'pubs/tmp/'.strtr(base64_encode(openssl_random_pseudo_bytes(16)), "+/=", "XXX") . $UPL['name'];
						
						switch($this->sys['req']['pst']['loc']) {
							case 'tmp' :
								$cfg['path'] = "pub/tmp/";
								$cfg['file'] = file_name_rfc($UPL['name']);
								$cfg['file'] = $this->sys['usr']['aaa_account']."___{$cfg['file']}";
								$this->session->set_flashdata('upl_tmp', $cfg['path'].$cfg['file']);
								break;
							
							case 'fix' :
								$cfg['path'] = $cfg['folder'];
								if($cfg['sub_folder'])
									$cfg['path'] .= $this->model->proxy('util_upl_rename_dir', $cfg['sub_folder']);
								
								$cfg['file'] = $this->model->proxy('util_upl_rename_file', $UPL['name'], $cfg, $ext);
								break;
						}
						
						if(!is_dir($cfg['path']) && !@mkdir($cfg['path'], 0777, true))
							throw $php_errormsg;
						
						else {
							if(file_exists($cfg['path'] . $cfg['file']))
								@unlink($cfg['path'] . $cfg['file']);
							move_uploaded_file($UPL["tmp_name"], $cfg['path'] . $cfg['file']);
							
							if($this->sys['req']['pst']['tbl'] == 'summernote')
								$this->sys['rsp'] = array('ack' => true, 'dat' => $cfg['path'] . $cfg['file']);
							else {
								$this->sys['req']['out'] = 'json';
								
								if($UPL['error']) {
									$this->sys['rsp']['ack'] = false;
									$this->sys['rsp']['msg'] = $UPL['error'];
									$this->sys['rsp']['dat'] = array('ack' => false, 'msg' => $UPL['error']);
								}
								else {
									$this->sys['rsp']['ack'] = true;
									$this->sys['rsp']['msg'] = $cfg['file'];
									$this->sys['rsp']['dat'] = array('ack' => true, 'msg' => $cfg['file'],
			                                 'pid' => $this->sys['req']['pid'],
                                             // 'id'  => $this->sys['bpm']['aux'][$this->sys['req']['xid']]['id'],
			                                 'ext' => $ext, 'icon' => $dmt['icon'], 'dms_media_type_id' => $dmt['id'],
			                                 'path' => $cfg['path'] . $cfg['file']);
								}
							}
							
							if($this->sys['req']['pst']['loc'] == 'fix') {
								$this->sys['event']['event']              = 'Upload Doc';
								$this->sys['event']['aaa_audit_trail_id'] = 'upload_doc';
								
								$this->sys['bpm']['aux']['cmd'] = 'upd_paths';
								
								$this->model->sys_cmd_upl();
							}
						}
					}
				}
				break;
				
			case 'Batch':
				$this->init_sys_cmd_upl_xls();
				break;
		}
	}
	
	private     function init_sys_cmd_helper() {
		// echo json_encode(array());
		// return;
		switch($this->sys['req']['cmd']) {
			case 'helper' :
				$this->sys['req']['out'] = 'json';
				$this->cmd_bpm();
				break;
		}
		
		if($this->sys['req']['out']=='html') {
			$this->smarty->assign('dat', $this->sys['rsp']['dat']);
			$this->smarty->display("{$this->sys['uix']['tpl']}/{$this->sys['req']['rid']}.tpl");
		}
	}
	private     function init_sys_cmd_chart() {
		$pst = $this->input->post(null, true);
		return $this->model->sys_cmd_inq_chart($this->sys, $pst);
	}
	private     function init_sys_cmd_viewer() {
		// format url: rid/pid/tbl
		
		if($path = $this->session->flashdata('upl_tmp'))
			$this->sys['bpm']['aux']['path'] = $path;
		else {
			$this->sys['bpm']['aux']['tbl'] = $this->sys['req']['fid'];
			$this->sys['bpm']['aux']['cmd'] = 'path';
			$this->model->sys_cmd_upl();
		}
		
		if(empty($this->sys['bpm']['aux']['viewer_id']))
			$this->sys['bpm']['aux']['viewer_id'] = $this->model->proxy('util_upl_inf', 'dms_media_viewer', strtolower(pathinfo($this->sys['bpm']['aux']['path'], PATHINFO_EXTENSION)));
		
		if($this->sys['bpm']['aux']['viewer_id'] == 2)
			$this->sys['cfg']['online']  = ping('www.google.com');
		
		$this->smarty->assign('sys', $this->sys);
		$this->smarty->display('__ecm/dms/dms_doc_viewer.tpl');
	}
	private     function init_sys_cmd_splash() {
		if(method_exists($this->model, 'splash'))
			$this->model->splash();
		
		$this->smarty->assign('sys', $this->sys);
		$this->smarty->display("{$this->sys['uix']['tpl']}/splash.tpl");
		exit();
	}
	
	protected   function init_sys_model() {
		// validate request-id & check authorization
		$req = $this->sys['req']['cmd'];
		if (in_array($req, array('inq', 'upl', 'opt', 'acs', 'unique')))
			$req = $this->sys['req']['rid'];
		
		if($req && $this->sys['usr']) {
			if ($prc = $this->model->sys_load('prc_loader', $req)) {
				if (!$prc['sys_aaa']['right']['inq'])
					$this->sys['ack']['err'] = 403;
				else {
					$model = isset($this->sys['prc']['sys_tbl']['attr']['model']) ? $this->sys['prc']['sys_tbl']['attr']['model'] : $this->sys['cfg']['app']['model'];
					if($model && !in_array($model, array('iop\/MIOP', 'iop\/MAAA'))) {
						$this->load->unload('model');
						$this->load->model($model, 'model');
						$this->model->sync($this->sys);
					}
				}
			}
			else
				$this->sys['ack']['err'] = 404;
		}
	}
	protected   function init_sys_var($var) {
		$this->model->sys_var($var);
	}
	
	private     function init_dispatch_html() {
		if ($this->sys['req']['rid']) {
			$this->sys['event']['aaa_audit_trail_id']   = $this->sys['req']['pid'] ? 'inquiry_detail' : 'inquiry_list';
			$this->sys['event']['out']                  = json_encode($this->sys['rsp']['dat']);
			$this->sys['event']['rows']                 = $this->sys['req']['pid'] ? 1 : is_array($this->sys['rsp']['dat']) ? count($this->sys['rsp']['dat']) : 0;

			if ($this->sys['req']['pid'] && isset($this->sys['rsp']['dat'][$this->sys['bpm']['tbl']]))
				$this->sys['rsp']['bc'][] = txt_shorten($this->sys['rsp']['dat'][$this->sys['bpm']['tbl']]);
		}

		if(isset($this->sys['rsp']['chart'])) {
			$this->sys['rsp']['chart'] = json_encode($this->sys['rsp']['chart'], JSON_PRETTY_PRINT);
		}
		if(isset($this->sys['rsp']['gantt'])) {
			$this->sys['rsp']['gantt'] = json_encode($this->sys['rsp']['gantt'], JSON_PRETTY_PRINT);
		}
		
		if ($this->sys['req']['rid'] && $this->sys['cfg']['xhr'])
			$page = "{$this->sys['uix']['elm']}/hst/portlet_proxy.tpl";
		else
			$page = "index.tpl";
		
		$mem_usage = function () {
			$mem = memory_get_usage();
			
			if ($mem < 1024)
				$mem = $mem ." B";
			elseif ($mem < 1048576)
				$mem = round($mem/1024,2) ." KB";
			else
				$mem = round($mem/1048576,2) ." MB";
			return $mem;
		};

        unset($this->sys['tbl']);
		
		$this->benchmark->mark('code_end');
		$this->sys['rsp']['prf']['elapsed_time'] = $this->benchmark->elapsed_time('code_start', 'code_end');
		$this->sys['rsp']['prf']['memory_usage'] = $mem_usage();
		//$this->sys['rsp']['prf']['memory_usage'] = $this->benchmark->memory_usage();
		
		$this->output->parse_exec_vars = false;
		$this->smarty->assign('sys', $this->sys);
		$this->smarty->display($page);
	}
	protected   function init_dispatch_json() {
		header('Content-type: text/json');
		header('content-type: application/json; charset=utf-8');
		
		if(empty($this->sys['rsp']['dat']) || $this->sys['ack']['err'])
			echo json_encode($this->sys['ack']);
		else
			echo json_encode($this->sys['rsp']['dat'], JSON_PRETTY_PRINT);
	}
	private     function init_dispatch_xml() {
		header('Content-type: text/xml');
	}

	private     function init_dispatch_xls($pdf=false) {
		$cfg = $this->model->proxy('util_db_qry', 'sys_process_exim', array('sys_process_id'=>$this->sys['req']['rid']));
		
		$response   = array('ack'=>false, 'msg'=>null, 'url'=>'', 'doc'=>'');
		$auto_fit   = true;
		$ext        = $pdf ? 'pdf' : 'xlsx';
		$url        = $this->sys['cfg']['asset'] . "template/usr/__{$this->sys['usr']['aaa_account']}.$ext";
		$file       = FCPATH . $url;
		
		if($cfg) {
			$cfg = json_decode($cfg['export_xls'], true);
			if (file_exists($file))
				@unlink($file);
			
			$this->load->library(array('PHPExcel'));
			$prcPHPExcel = PHPExcel_IOFactory::load(FCPATH . $cfg['tpl']);
			
			switch ($this->sys['req']['rid']) {
				default:
					foreach ($cfg['sheets'] as $k => $s) {
						$dtr = array();
						$dtt = $this->sys['rsp'][$s['dat']];
						if ($dtt) {
							// header
							if ($s['hdr'])
								foreach ($s['hdr'] as $cel => $idx)
									if (isset($this->sys['rsp']['hdr'][$k][$idx]))
										$prcPHPExcel->getSheet($k)->getCell($cel)->setValue($this->sys['rsp']['hdr'][$k][$idx]);
							
							// payload
							if ($dtt) {
								foreach ($dtt as $r => $v)
									foreach (array_column($s['col'], 'name') as $x => $f)
										$dtr[$r][$f] = $v[$f];
								$prcPHPExcel->getSheet($k)->insertNewRowBefore($s['rxy'] + 1, count($dtr));
								$prcPHPExcel->getSheet($k)->fromArray($dtr, null, $s['cxy'] . $s['rxy']);
							}
							// footer
						}
					}
					break;
			}
			
			// auto fit
			if ($auto_fit)
				foreach ($cfg['sheets'] as $k => $sheet) {
					$prcPHPExcel->setActiveSheetIndex($k);
					foreach (range('A', $prcPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
						$prcPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
					}
				}
			
			$response['ack']    = true;
			$response['url']    = $url;
			$response['doc']    = "{$cfg['rpt']}.$ext";
			
			if ($pdf) {
				// name: PDF_RENDERER_TCPDF | PDF_RENDERER_DOMPDF | PDF_RENDERER_MPDF
				// lib: tcpdf | mpdf | dompdf
				$rendererName        = PHPExcel_Settings::PDF_RENDERER_MPDF;
				$rendererLibrary     = 'mpdf';
				$rendererLibraryPath = APPPATH .'libraries/pdf/'. $rendererLibrary;
				if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath))
					$response['msg'] = "Please set the $rendererName and $rendererLibraryPath values as appropriate for your directory structure";
				
				if(!$response['msg']) {
					$prcWriter = new PHPExcel_Writer_PDF($prcPHPExcel);
					$prcWriter->setPreCalculateFormulas(false);
				}
				else {
					$response['ack']    = false;
					$response['url']    = '';
					$response['doc']    = '';
				}
			}
			else {
				$prcWriter = PHPExcel_IOFactory::createWriter($prcPHPExcel, 'Excel2007');
			}
			$prcWriter->save($file);
			$prcPHPExcel->disconnectWorksheets();
			unset($prcPHPExcel);
		}
		else {
			$response['msg'] = 'Error Creating Excel';
		}
		
		header('Content-type: text/json');
		header('Content-type: application/json');
		echo json_encode($response);
		
	}
	private     function init_dispatch_xls_wkhtml($pdf=false) {
		$response   = array('ack'=>false, 'msg'=>null, 'url'=>'', 'doc'=>'');
		$auto_fit   = true;
		$ext        = $pdf ? 'pdf' : 'xlsx';

		$cfg = $this->model->proxy('util_db_qry', 'sys_process_ext', array('sys_process_id'=>$this->sys['req']['rid']));

	}

	private     function init_dispatch_pdf() {
		if($this->sys['req']['pid'])
			$this->init_dispatch_doc(true);
		else
			$this->init_dispatch_xls(true);
	}
	private     function init_dispatch_doc($pdf=false) {}
	
	protected   function init_err() {
		// please sync the method with SysErr to gain same result
		
		switch($err = $this->sys['ack']['err']) {
			case 400:
			case 401:
			case 402:
			case 403:
			case 404:
			case 405:
			case 406:
			case 410:
			case 500:
			case 502:
			if(!$this->sys['ack']['msg'])
				$this->sys['ack']['msg']                    = $this->init_sys_var('sys_response_code', 'HTTP__' . $err);
				$err_page                                   = "{$this->sys['uix']['elm']}/misc/page_err_{$err}.tpl";
				$this->sys['event']['event']               .= " (HTTP__{$err}: {$this->sys['ack']['msg']})";
				$this->sys['event']['sys_response_code_id'] = 'HTTP__' . $err;
				$this->sys['ack']['err']                    = 'HTTP__' . $err;
				break;
		}
		
		$this->model->sys_cmd_aud();
		if($this->sys['req']['out'] == 'json')
			$this->init_dispatch_json();
		else {
			$this->smarty->assign("sys", $this->sys);
			$this->smarty->display($err_page);
		}
		exit();
	}

	protected   function util_escape($v, $escape = true) {
		if($escape)
			return is_numeric($v) ? $v : $this->db->escape($v);
		else
			return str_replace("'", '', $v);
	}
	protected   function util_file_ext($filename, $case = null) {
		$ext = array_search_path(mime_content_type($filename), get_mimes());
		switch ($case) {
			case 'ucfirst':
				$ext = ucfirst($ext);
				break;
			
			case 'upper':
				$ext = strtoupper($ext);
				break;
			
			case 'lower':
			default:
				$ext =  strtolower($ext);
				break;
		}
		return $ext;
	}
	
	protected   function aaa_must_logged() {
		$this->sys['usr']   = $this->session->userdata('usr');
		if(!$this->sys['usr'] && (isset($_SERVER['AUTH_USER']) || isset($_SERVER['REMOTE_USER']))) {
			$usr = $_SERVER['AUTH_USER'] ? $_SERVER['AUTH_USER'] : $_SERVER['REMOTE_USER'];
			if($this->model->proxy('ldap_users', $usr)) {
				$this->MAAA->get_acm($usr);
			}
		}
		
		if(!$this->sys['usr']) {
			$this->session->unset_userdata('usr');
			$this->session->sess_destroy();
			
			if (is_xhr()) {
				$this->smarty->assign('sys', $this->sys);
				$this->smarty->display("index/aaa_login-expired.tpl");
				exit();
			}
			else {
				$this->load->helper('captcha');
				$cap                         = array(
					'word'          => 'Random word',
					'img_path'      => './pub/image/captcha/',
					'img_url'       => "{$this->sys['cfg']['url']}pub/image/captcha",
					'font_path'     => "{$this->sys['cfg']['asset']}font/texb.ttf",
					'img_width'     => 150,
					'img_height'    => 30,
					'expiration'    => 7200,
					'word_length'   => 8,
					'font_size'     => 16,
					'img_id'        => 'Imageid',
					'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
					
					// White background and border, black text and red grid
					'colors' => array(
						'background'    => array(255, 255, 255),
						'border'        => array(255, 255, 255),
						'text'          => array(0, 0, 0),
						'grid'          => array(255, 40, 40)
					)
				);
				$this->sys['cfg']['captcha'] = create_captcha($cap);
				
				if ($this->session->flashdata('err_login'))
					$this->smarty->assign("err_login", $this->session->flashdata('err_login'));
				
				$this->smarty->assign('sys', $this->sys);
				$this->smarty->display("index/aaa_login.tpl");
				exit();
			}
		}
		else {
			$this->MAAA->get_acm($this->sys['usr']);
			$this->sys['event']['aaa_account_id'] = $this->sys['usr']['id'];
			$this->smarty->assign('sys', $this->sys);
			if ($this->sys['usr'] && $this->sys['usr']['sys_app_id'] && in_array($this->sys['cfg']['app']['id'], $this->sys['usr']['sys_app_id'])) {
				if($this->sys['usr']['aaa_fcpwd']) {
					$this->smarty->assign('sys', $this->sys);
					$this->smarty->display("index/aaa_cpwd.tpl");
					exit();
				}
			}
			else {
				if(is_xhr()) {
					$this->smarty->assign('sys', $this->sys);
					$this->smarty->display("{$this->sys['uix']['elm']}/misc/page_err_403.tpl");
				}
			}
		}
	}
	protected   function aaa_authz($act='init') {
		switch($act) {
			case 'init':
				
				break;
		}
	}
	
	private     function validate_http_protocol() {}
	private     function validate_origin() {}
	private     function validate_arg() {}
	
	protected   function dump() {
		if($this->sys['usr']['is_super'] && !empty($this->sys['usr']['is_debug'])) {
			foreach(func_get_args() as $arg) {
				switch($arg) {
					case 'sys':
						dump($this->sys);
						break;
					case 'cfg':
					case 'usr':
					case 'req':
					case 'rsp':
					case 'bpm':
					case 'prc':
					case 'rpc':
					case 'svc':
					case 'nav':
					case 'uix':
					case 'aaa':
					case 'ack':
					case 'err':
						dump($this->sys[$arg]);
						break;
					case 'app':
						dump($this->sys['cfg']['app']);
						break;
					case 'dat':
					case 'ref':
					case 'aux':
						dump($this->sys['rsp'][$arg]);
						break;
					case '#':
						die();
					default:
						dump($arg);
						break;
				}
			}
		}
	}
}
