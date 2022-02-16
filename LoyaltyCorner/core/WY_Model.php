<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

// ABBRV DICTIONARY
// tbm: table master,

class WY_Model extends CI_Model {
	// sys-process-type (Stand Alone, Extended)
	protected $prc_hide = array('str'=>'18,19', 'arr'=>array(18,19));
	protected $acm_idx  = array('ins','upd','del','bat','doc','exp');
	protected $alfabet  = array('a','b','c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
	protected $reg_dat  = '/(dat|rsp|sys_req_pst|rsp_rsp_dat|sys_(req|bpm|prc|usr|cfg)|sys_bpm_(aux|ext)__*/',
			  $reg_opr  = '/<|>|!|=|\(|\b(not|in|like|between)\b/';
	protected $counter  = 0;
	protected $sys;
	protected $sql;

	public      function __construct() {
		parent::__construct();
	}
	private     function aaa_authz($type='init') {
		switch($type) {
			case 'init':
				$sql = "select 	group_concat(a.id) sys_app_id
						from 	sys_app a
						join 	aaa_acm__sys_app b on a.id = b.sys_app_id
						and     a.is_active = 1
						and 	aaa_acm_id in ({$this->sys['usr']['aaa_acm_id']})";
				$this->sys['aaa']['app']['privilege'] = $this->util_db_sql($sql, 'cel');
				break;

		}
		if($type=='init') {

		}
	}
	private     function aaa_uta() {
		// uta: user target audience

		// audience = by-account
		$act = $this->sys['usr']['aaa_account'];
		$this->sys['aaa']['uta']['act'] = " and (audience_aaa_account_ixd is null or audience_aaa_account_ixd regexp '[[:<:]]{$act}[[:>:]]')";

		// audience = by-role
		$role   = $this->sys['usr']['aaa_acm_id'];
		$tmp    = array();
		if ($role) {
			if (is_array($role))
				foreach ($role as $k => $v)
					$tmp[] = "audience_aaa_acm_ixd regexp '[[:<:]]{$v}[[:>:]]'";
		} else
			$tmp[] = $role;
		if ($tmp) {
			$tmp = implode(' or ', $tmp);
			$this->sys['aaa']['uta']['role'] = " and (audience_aaa_acm_ixd is null or $tmp)";
		}

		// audience = by-organization
		$dir = isset($this->sys['usr']['hrm_orgz_directorat_id'])   ? $this->sys['usr']['hrm_orgz_directorat_id']   : null;
		$div = isset($this->sys['usr']['hrm_orgz_division_id'])     ? $this->sys['usr']['hrm_orgz_division_id']     : null;
		$org = isset($this->sys['usr']['hrm_orgz_id'])              ? $this->sys['usr']['hrm_orgz_id']              : null;

		$this->sys['aaa']['uta']['orgz'] = " and (audience_hrm_orgz_ixd is null or audience_hrm_orgz_ixd regexp '[[:<:]]{$this->sys['cfg']['base_orgz']}[[:>:]]'";
		if ($dir) $this->sys['aaa']['uta']['orgz'] .= " or audience_hrm_orgz_ixd regexp '[[:<:]]{$dir}[[:>:]]'";
		if ($div) $this->sys['aaa']['uta']['orgz'] .= " or audience_hrm_orgz_ixd regexp '[[:<:]]{$div}[[:>:]]'";
		if ($org) $this->sys['aaa']['uta']['orgz'] .= " or audience_hrm_orgz_ixd regexp '[[:<:]]{$org}[[:>:]]'";
		$this->sys['aaa']['uta']['orgz'] .= ")";

		if(isset($this->sys['usr']['crm_company_id']) && $this->sys['usr']['crm_company_id'] != $this->sys['cfg']['app']['base_corp']) {
			$this->sys['aaa']['uta']['comp'] = " crm_company_id = {$this->sys['usr']['crm_company_id']}";
		}
		
		// todo: audience = geography region
	}
	
	public      function sync(&$sys, $idx='in', $flx='pull') {
		switch($idx) {
			case 'in':
				$this->sys =& $sys;
				break;

			case 'out':
				$sys = $this->sys;
				break;
			
			case 'ctrl-in':
				$this->sys = array_merge($this->sys, $sys);
				$sys = $this->sys;
				break;
			
			case 'ctrl-out':
				$sys = array_merge($this->sys, $sys);
				$this->sys =& $sys;
				break;
			
			default:
				if(is_string($idx))
					$idx = array($idx);
				
				foreach($idx as $elm)
					if($flx == 'pull') {
						$sys[$elm] = $this->sys[$elm];
					}
					else
						$this->sys[$elm] = $sys[$elm];
				break;
		}
	}
	public      function proxy() {
		$arg = func_get_args();
		$fnc = $arg[0];

		if(isset($arg[8]))
			$out = $this->$fnc($arg[1], $arg[2], $arg[3], $arg[4], $arg[5], $arg[6], $arg[7], $arg[8]);
		elseif(isset($arg[7]))
			$out = $this->$fnc($arg[1], $arg[2], $arg[3], $arg[4], $arg[5], $arg[6], $arg[7]);
		elseif(isset($arg[6]))
			$out = $this->$fnc($arg[1], $arg[2], $arg[3], $arg[4], $arg[5], $arg[6]);
		elseif(isset($arg[5]))
			$out = $this->$fnc($arg[1], $arg[2], $arg[3], $arg[4], $arg[5]);
		elseif(isset($arg[4]))
			$out = $this->$fnc($arg[1], $arg[2], $arg[3], $arg[4]);
		elseif(isset($arg[3]))
			$out = $this->$fnc($arg[1], $arg[2], $arg[3]);
		elseif(isset($arg[2]))
			$out = $this->$fnc($arg[1], $arg[2]);
		elseif(isset($arg[1]))
			$out = $this->$fnc($arg[1]);
		else
			$out = $this->$fnc();

		return $out;
	}
	
	public      function sys_var($var, $arg_1 = 0, $arg_2 = null) {
		$out = true;
		switch($var) {
			case 'tbl_pky' :
				// $arg_1 : tbl
				// $arg_2 : dat
				if($arg_1 == $this->sys['prc']['sys_tbl']['id'])
					$pky = $this->sys['prc']['sys_tbl']['attr']['pkey'];
				else
					$pky = $this->db->get_where('v___sys_table_pkey', array('sys_table_id' => $arg_1))->row()->pkey;
				
				$out = array();
				$pkf = array_flip(explode(',', $pky));
				
				if($arg_2 && is_array($arg_2))
					$out = array_intersect_key($arg_2, $pkf);
				else
					foreach($pkf as $k=>$v)
						$out[$k] = null;
				break;
			case 'tbl_prop':
				$out = $this->db->get_where('sys_table', array('id' => $arg_1))->row_array();
				$out = array_merge($out, json_decode($out['tbl_jsd'], true));
				unset($out['tbl_jsd'], $out['event_id'], $out['is_active']);
				break;
			case 'col_type' :
				$dty = array('tinyint', 'smallint', 'int', 'bigint', 'float', 'double', 'numeric');
				$sql = "select 	data_type pky
						from	information_schema.columns
						where   table_schema like '{$this->sys['cfg']['app']['db_prefix']}_%'
						and     table_name  = '$arg_1'
						and     column_name = '$arg_2'
						order by ordinal_position";
				$tmp = $this->util_db_sql($sql, 'cel');
				$out = in_array($tmp, $dty) ? 1 : 0;
				break;
			
			case 'administrative_tree' :
				$out = array();
				$out['nodes'] = array();
				
				$whr = $arg_1 ? "pid = $arg_1" : "geo_tree_id = 12";
				$sql = "select * from geo_administrative where flag = 'BPS' and $whr order by geo_code";
				if($rst = $this->util_db_sql($sql)) {
					foreach($rst as $k => $v)
						$out['nodes'][] = array('id' => $v['id'], 'parent' => $v['pid'], 'name' => $v['geo_administrative'], 'level' => $v['geo_administrative_tree_id'] - 11, 'type' => 'folder');
				}
				break;
			
			case 'quote':
			case 'quote_random':
				$flt = $arg_1 ? "and (author like '%$arg_1%' or cms_quote_type_id = '$arg_1')" : '';
				$sql = "select * from cms_quote
						where   is_active = 1 $flt
						and     rand() < (select((1/count(*))*10) from cms_quote where 1=1 $flt)
						order by rand() limit 1";
				$out = $this->util_db_sql($sql, 'row');
				break;
			
			case 'hlp' : // help
				$sql = "select id, sys_process_id,   field_name from help where sys_process_id = $arg_1  and field_name is not null union
						select id, sys_process_id,   field_name from help where sys_process_id is null and field_name is not null
						and field_name not in(select field_name from help where sys_process_id = $arg_1  and field_name is not null)
						order by sys_process_id";
				$out = rst2ID($this->util_db_sql($sql), 'field_name');
				break;
			case 'helper' :
				$sql = "select help help_h, help_content help_b, help_pdf help_f, width from sys_help where id = $arg_1";
				$out = $this->util_db_sql($sql, 'row');
				break;
			
			case 'sys_response_code' :
				$sql = "select sys_response_code msg from sys_response_code where id = '$arg_1'";
				$tmp = $this->util_db_sql($sql, 'cel');
				$out = $tmp ? $tmp : "Unknown Error #$arg_1";
				break;
			
			case 'sys_module' :
				$sql = "select sys_module from sys_module where model = '$arg_1' and pid is null";
				$tmp = $this->util_db_sql($sql, 'cel');
				$out = $tmp ? $tmp : 'Control Panel';
				break;
				
			case 'svc_upl';
				// $svc = 'wcrm_acq_customer';
				$svc = isset($this->sys['req']['pst']['svc_code']) ? $this->sys['req']['pst']['svc_code'] : 'default';
				$sql = "select import_xls from sys_process__import where sys_process_id = {$this->sys['req']['rid']} and svc_code = '{$svc}'";
				if($rst = $this->util_db_sql($sql, 'cel'))
					$this->sys['svc']['upl']['cfg'] = json_decode($rst, true);
				break;
		}
		
		return $out;
	}
	public      function sys_cfg($cfg, $arg=null) {
		switch($cfg) {
			case 'sys' :
				$sql = "select  sys_app_id, id, case when value!='' then value else 0 end value, sys_data_type_id
						from    sys_config
						where   is_active = 1
						and     sys_app_id in (1, $arg)";
				$out = $this->util_db_sql($sql);
				break;
			
			default :
				// $sql = "select value from sys_config where id = '$cfg' and is_active = 1";
				// $out = $this->util_db_sql($sql, 'cel');
				break;
		}
		
		switch($cfg) {
			case 'sys':
				foreach($out as $k=>$v) {
					$p = explode('.', $v['id']);
					if(isset($p[1])) {
						if ($v['sys_app_id'] == 1)
							$this->sys['cfg'][$p[0]][$p[1]] = $v['value'];
						else
							$this->sys['cfg']['app'][$p[0]][$p[1]] = $v['value'];
					}
					else {
						if ($v['sys_app_id'] == 1)
							$this->sys['cfg'][$v['id']] = $v['value'];
						else
							$this->sys['cfg']['app'][$v['id']] = $v['value'];
					}
				}
				
				$this->sys['cfg']['xhr']    = $this->input->is_ajax_request();
				$this->sys['cfg']['online'] = 0;
				$this->sys['cfg']['fs']     = 0;
				$this->sys['cfg']['now']    = date('Y-m-d');
				$this->sys['cfg']['dts']    = date('Y-m-d H:i:s');
				$this->sys['cfg']['ts']     = time();
				$this->sys['cfg']['env']    = ENVIRONMENT;
				$this->sys_cfg('app', $arg);
				
				$out = null;
				break;
			
			case 'app' :
				$sql = "select  id, id app_id, id_code, sys_app, app_short,
								'' ctrl, '' cdir, 'pcp' menu, 'iop/MIOP' model,
								case when app_url then app_url else id_code end app_url, font_icon
						from    sys_app
						where   is_active   = 1
						and     id          = $arg";
				if($out = $this->util_db_sql($sql, 'row'))
					$this->sys['cfg']['app'] = $out;
				
				$cfg = $this->config->item('iop');
				$ctr = strtolower($this->uri->segment(1));
				
				if(isset($cfg[$arg][$ctr]))
					array_push($this->sys['cfg']['app'], $cfg[$arg][$ctr]);
				$this->sys['cfg']['app']['menu']    = isset($cfg[$arg][$ctr]['menu']) ? $cfg[$arg][$ctr]['menu'] : 'pcp';
				$out = null;
				break;
		}
		return $out;
	}
	public      function sys_load($item, $idx=null, $idy=null) {
		$out = null;
		switch($item) {
			case 'prc_loader':
				$app = $this->sys['cfg']['app']['id'];
				$rid = $this->sys['req']['rid'];
				$jsd = json_decode($this->db->select('rpc_jsd')->get_where('aaa_account', array('id' => $this->sys['usr']['id']))->row()->rpc_jsd, true);
				if(!$jsd || ENVIRONMENT != 'production' || $this->sys['cfg']['debug']) {
					// rebuild
					$this->sys_rsp_menu();
					$jsd = $this->sys['rpc'];
				}
				
				if (isset($jsd[$app]['rpc'][$this->sys['req']['rid']]))
					$out = $jsd[$app]['rpc'][$rid];
				else {
					// meaning $rid is string
					foreach ($jsd[$app]['rpc'] as $k => $j)
						if ($j['id_code'] == $rid) {
							$out = $jsd[$app][$k];
							break;
						}
				}
			
				$this->sys['req']['rid']                = $out['id'];
				$this->sys['event']['sys_process_id']   = $out['id'];
				$this->sys['event']['event']            = $out['sys_process'];
				$this->sys['event']['sys_sdlc_id']      = $out['sys_sdlc_id'];
				
				$this->sys['bpm']['tbl'] = $out['sys_table_id'];
				$this->sys['bpm']['qry'] = $out['qry_table_id'];
				$this->sys['bpm']['bpm'] = $out['qry_table_id'] ? $out['qry_table_id'] : $out['sys_table_id'];
				$this->sys['bpm']['prc'] = $out['id'] . '-' . $out['sys_table_id'];
				unset($out['id']);
				$this->sys['prc'] = $out;
				
				break;
				
			case 'rpc_loader':
				$app = $this->sys['cfg']['app']['id'];
				$rst = $this->db->select('rpc_jsd')->get_where('aaa_account', array('id' => $this->sys['usr']['id']))->row_array();
				if ($rst) {
					$rpc = json_decode($rst['rpc_jsd'], true);
					unset($rst);
				
					if ($rpc && isset($rpc[$app])) {
						$out = true;
						$this->sys['rpc'] = $rpc[$app]['rpc'];
						$this->sys['rsp']['menu'] = $rpc[$app]['menu'];
					}
				}
				else {
					$this->sys_rsp_menu();
				}
				break;

			case 'logs' :
				switch($idx) {
					case 'inquiry' :
						$sql = "select `out` from event where id = '$idy'";
						$out = $this->util_db_sql($sql, 'cel');
						break;
					case 'insert' :
					case 'update' :
					case 'delete' :
						$sql = "select * from qry_sys_event_logs a
								left join event_crud b on a.event_id = b.event_id
								where a.event_id = '$idy'";
						$out = $this->util_db_sql($sql);
						break;
				}
				break;
			case 'tbl':
				$this->sys_tbl();
				break;
		}
		return $out;
	}
	
	public      function sys_rsp_menu() {
		$app  = $this->sys['cfg']['app']['id'];
		switch($this->sys['cfg']['app']['menu']) {
			case 'pcp' : // control-panel-menu
				$this->sys_rsp_menu_pcp();
				break;
		}
		
		if($this->sys['req']['rid']) {
			// user target audience
			$this->aaa_uta();
			$this->sys_rsp_menu_pcp_bc();
		}
		else {
			$this->sys['rsp']['menu'] = $this->sys['rpc'][$app]['menu'];
		}
		$this->sys_rsp_uix();
	}
	private     function sys_rsp_menu_pcp() {
		$app  = $this->sys['cfg']['app']['id'];
		$menu = array(
			'rpc'   => null,
			'menu'  => array(
				'tree'  => null
			));
		$tree = array();
		$rpc  = array();
		
		if(ENVIRONMENT != 'production' || !$this->sys['cfg']['debug'])
			$this->sys['rpc'] = null;
		
		if(!isset($this->sys['rpc'][$app])) {
			$pcp = $this->sys_rsp_menu_pcp_list();
			if ($pcp) {
				foreach ($pcp as $k => $v) {
					if ($v['sys_jsd']) {
						$v = array_merge($v, json_decode($v['sys_jsd'], true));
					}
					unset($v['sys_jsd']);
					if ($v['sys_process_type_id']) {
						$v['sys_url'] = str_replace('#', $v['id'], empty($v['sys_url']) ? '' : $v['sys_url']);
						if ($v['tbl_jsd']) {
							$v['sys_tbl']['id'] = $v['tbl_id'];
							$v['sys_tbl']['pid'] = $v['tbl_pid'];
							$v['sys_tbl']['tbl_code'] = $v['tbl_code'];
							$v['sys_tbl']['schema_db'] = $v['schema_db'];
							$v['sys_tbl']['sys_table'] = $v['sys_table'];
							$v['sys_tbl']['sys_table_type_id'] = $v['sys_table_type_id'];
							$v['sys_tbl']['sys_table_pk_type_id'] = $v['sys_table_pk_type_id'];
							$v['sys_tbl']['is_tim'] = $v['is_tim'];
							
							$v['sys_tbl'] = array_merge($v['sys_tbl'], json_decode($v['tbl_jsd'], true));
							unset($v['tbl_jsd']);
						}
						if ($this->sys['cfg']['debug'] == 1 && $this->sys['usr']['is_super']) {
							$v['sys_aaa']['right'] = array('inq' => 1, 'ins' => 1, 'upd' => 1, 'del' => 1, 'bat' => 1, 'doc' => 1, 'exp' => 1);
						}
						else {
							if ($v['hid'] || $v['sys_process_type_id'] == 18) {
								$xid = $v['hid'] ? $v['hid'] : $v['pid'];
								if (isset($pcp[$xid])) {
									$v['sys_aaa']['right']['inq'] = $pcp[$xid]['inq'];
									$v['sys_aaa']['right']['ins'] = $pcp[$xid]['ins'];
									$v['sys_aaa']['right']['upd'] = $pcp[$xid]['upd'];
									$v['sys_aaa']['right']['del'] = $pcp[$xid]['del'];
									$v['sys_aaa']['right']['bat'] = $pcp[$xid]['bat'];
									$v['sys_aaa']['right']['doc'] = $pcp[$xid]['doc'];
									$v['sys_aaa']['right']['exp'] = $pcp[$xid]['exp'];
								}
							}
							else {
								$v['sys_aaa']['right']['inq'] = $pcp[$v['id']]['inq'];
								$v['sys_aaa']['right']['ins'] = $pcp[$v['id']]['ins'];
								$v['sys_aaa']['right']['upd'] = $pcp[$v['id']]['upd'];
								$v['sys_aaa']['right']['del'] = $pcp[$v['id']]['del'];
								$v['sys_aaa']['right']['bat'] = $pcp[$v['id']]['bat'];
								$v['sys_aaa']['right']['doc'] = $pcp[$v['id']]['doc'];
								$v['sys_aaa']['right']['exp'] = $pcp[$v['id']]['exp'];
							}
						}
						$v['sys_aaa']['acm'] = $v['sys_aaa']['acm'] ? $v['sys_aaa']['acm'] : 0;
						if ($this->sys['usr']['is_admin']) {
							$v['sys_aaa']['meta'] = array_combine($this->acm_idx, str_split(str_pad(decbin($v['sys_aaa']['acm']), 6, '0', STR_PAD_LEFT)));
						}
						
						isset($v['sys_tbl']['action']) && $v['sys_aaa']['action'] = $v['sys_tbl']['action'];
						isset($v['sys_tbl']['audit']) && $v['sys_aaa']['audit'] = $v['sys_tbl']['audit'];
						unset($v['sys_tbl']['action'], $v['sys_tbl']['audit']);
					}
					else {
						$v['sys_url'] = '#';
						$v['sys_aaa']['right']['inq'] = $pcp[$v['id']]['inq'];
					}
					$v['sys_prc']['header'] = $v['sys_prc']['header'] ? $v['sys_prc']['header'] : $v['sys_process'];
					// exclude: public standalone, public ext-process, admin ext-process
					if (!in_array($v['sys_process_type_id'], $this->prc_hide['arr']))
						$tree[$v['id']] = array(
							'id' => $v['id'],
							'pid' => $v['pid'],
							'sys_url' => $v['sys_url'],
							'sys_process' => $v['sys_process'],
							'sys_process_type_id' => $v['sys_process_type_id'],
							'sys_header' => $v['sys_prc']['header'] ? $v['sys_prc']['header'] : $v['sys_process'],
							'sys_header_sub' => $v['sys_prc']['header_sub'],
							'sys_font' => $v['sys_prc']['font'],
							'sys_icon' => $v['sys_prc']['icon'],
							'sys_class' => $v['sys_prc']['class'],
							'is_ajaxify' => $v['sys_prc']['ajax'],
							'right' => $v['sys_aaa']['right']
						);
					
					unset($v['inq'], $v['ins'], $v['upd'], $v['del'], $v['bat'], $v['doc'], $v['exp']);
					unset(
						$v['is_allow_inq'], $v['is_allow_ins'], $v['is_allow_upd'], $v['is_cascade_del'],
						$v['is_allow_del'], $v['is_allow_bat'], $v['is_allow_doc'], $v['is_allow_exp'],
						$v['sys_tbl']['action'], $v['sys_tbl']['audit']
					);
					unset(
						$v['schema_db'], $v['tbl_id'], $v['tbl_pid'], $v['tbl_code'], $v['sys_table'],
						$v['sys_table_type_id'], $v['sys_table_pk_type_id'],
						$v['sys_table_pk'], $v['has'], $v['attr'], $v['is_tim'],
						$v['sys_jsd'], $v['tbl_jsd']);
					
					$rpc[$v['id']] = $v;
				}
				
				$menu['rpc'] = $rpc;
				$keys = array_keys($rpc);
				
				$menu['menu']['tree'] = flat2tree($tree, $pcp[$keys[0]]['pid']);
				foreach ($menu['menu']['tree'] as $k => $v) {
					if ((!$v['sys_process_type_id'] && !$v['sub']) || !$v['right']['inq'])
						unset($menu['tree'][$k]);
				}
				
				$this->sys['rpc'][$app] = $menu;
				unset($pcp, $tree, $menu);
				
				$rpc = json_encode($this->sys['rpc'], JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);
				$this->db->update('aaa_account', array('rpc_jsd' => $rpc), array('id' => $this->sys['usr']['id']));
			}
			if ($this->sys['req']['rid'])
				$this->sys['prc'] = $this->sys['rpc'][$app]['rpc'][$this->sys['req']['rid']];
			
			if (ENVIRONMENT == 'production' && !$this->sys['cfg']['debug'])
				$this->sys['rpc'] = null;
		}
		else {
		
		}
	}
	private     function sys_rsp_menu_pcp_bc() {
		$bc  = array();
		$app = $this->sys['cfg']['app']['id'];
		$rid = $this->sys['req']['rid'];
		$tmp = $this->sys['rpc'][$app]['rpc'][$rid];
		$pid = $tmp['pid'];
		$max = $tmp['tree'] - 1;
		$bc[$tmp['tree']] = $tmp['sys_process'];
		for($i=$max; $i > 0; $i--) {
			if($pid) {
				$tmp = $this->sys['rpc'][$app]['rpc'][$pid];
				$pid = $tmp['pid'];
				$bc[$i] = $tmp['sys_process'];
			}
		}
		ksort($bc);
		
		$this->sys['rsp']['bc'] = $bc;
		unset($bc, $tmp);
	}
	private     function sys_rsp_menu_pcp_list() {
		/*
		 * Only Load Current App / Module Menu
		 */
		$rst = array();
		$uni = "";
		$whr = "a.sys_app_id = {$this->sys['cfg']['app']['id']}";

		if ($this->sys['usr']['is_admin'])
			$whr .= " or (sys_app_ixd = 'all' or sys_app_ixd like '%{$this->sys['cfg']['app']['id_code']}%')";

		if(isset($this->sys['usr']['aaa_acm_id'])) {
			$acm  = implode($this->sys['usr']['aaa_acm_id'], ',');
			$uni .= "select a.id sys_process_id,
							max(ifnull(b.is_allow_inq, 0)) inq,
							max(ifnull(b.is_allow_ins, 0)) ins,
							max(ifnull(b.is_allow_upd, 0)) upd,
							max(ifnull(b.is_allow_del, 0)) del,
							max(ifnull(b.is_allow_bat, 0)) bat,
							max(ifnull(b.is_allow_doc, 0)) doc,
							max(ifnull(b.is_allow_exp, 0)) exp
					from   sys_process a
					join   aaa_acm__sys_process b on a.id = b.sys_process_id and aaa_acm_id in ($acm)
					where   a.is_active     = 1
					and     is_allow_inq    = 1
					and     ##
					group by a.id";
		}
		if(isset($this->sys['usrx']['id'])) {
			if ($uni)
				$uni .= "\nunion\n";
			$uni
				.= "select  a.id sys_process_id,
						max(ifnull(b.is_allow_inq, 0)) inq,
						max(ifnull(b.is_allow_ins, 0)) ins,
						max(ifnull(b.is_allow_upd, 0)) upd,
						max(ifnull(b.is_allow_del, 0)) del,
						max(ifnull(b.is_allow_bat, 0)) bat,
						max(ifnull(b.is_allow_doc, 0)) doc,
						max(ifnull(b.is_allow_exp, 0)) exp
				from   sys_process a
				join   aaa_acm_ibac__sys_process b on a.id = b.sys_process_id and aaa_account_id = {$this->sys['usr']['id']}
				where   a.is_active     = 1
				and     is_allow_inq    = 1
				and     ##
				group by a.id";
		}

		if(isset($this->sys['usrx']['aaa_acm_obac_crm_id'])) {
			$acm = implode($this->sys['usr']['aaa_acm_obac_crm_id'], ',');
			if($uni)
				$uni .= "\nunion\n";
			$uni .= "select  a.id sys_process_id,
							max(ifnull(b.is_allow_inq, 0)) inq,
							max(ifnull(b.is_allow_ins, 0)) ins,
							max(ifnull(b.is_allow_upd, 0)) upd,
							max(ifnull(b.is_allow_del, 0)) del,
							max(ifnull(b.is_allow_bat, 0)) bat,
							max(ifnull(b.is_allow_doc, 0)) doc,
							max(ifnull(b.is_allow_exp, 0)) exp
					from   sys_process a
					join   aaa_acm_obac_crm__sys_process b on a.id = b.sys_process_id and aaa_acm_obac_crm_id in ($acm)
					where   a.is_active     = 1
					and     is_allow_inq    = 1
					and     ##
					group by a.id";
		}

		if(isset($this->sys['usrx']['aaa_acm_obac_hrm_id'])) {
			$acm = implode($this->sys['usr']['aaa_acm_obac_hrm_id'], ',');
			if($uni)
				$uni .= "\nunion\n";
			$uni .= "select  a.id sys_process_id,
							max(ifnull(b.is_allow_inq, 0)) inq,
							max(ifnull(b.is_allow_ins, 0)) ins,
							max(ifnull(b.is_allow_upd, 0)) upd,
							max(ifnull(b.is_allow_del, 0)) del,
							max(ifnull(b.is_allow_bat, 0)) bat,
							max(ifnull(b.is_allow_doc, 0)) doc,
							max(ifnull(b.is_allow_exp, 0)) exp
					from   sys_process a
					join   aaa_acm_obac_hrm__sys_process b on a.id = b.sys_process_id and aaa_acm_obac_hrm_id in ($acm)
					where   a.is_active     = 1
					and     is_allow_inq    = 1
					and     ##
					group by a.id";
		}

		if(isset($this->sys['usrx']['aaa_acm_obac_ppo_id'])) {
			$acm = implode($this->sys['usr']['aaa_acm_obac_ppo_id'], ',');
			if($uni)
				$uni .= "\nunion\n";
			$uni .= "select  a.id sys_process_id,
							max(ifnull(b.is_allow_inq, 0)) inq,
							max(ifnull(b.is_allow_ins, 0)) ins,
							max(ifnull(b.is_allow_upd, 0)) upd,
							max(ifnull(b.is_allow_del, 0)) del,
							max(ifnull(b.is_allow_bat, 0)) bat,
							max(ifnull(b.is_allow_doc, 0)) doc,
							max(ifnull(b.is_allow_exp, 0)) exp
					from   sys_process a
					join   aaa_acm_obac_ppo__sys_process b on a.id = b.sys_process_id and aaa_acm_obac_ppo_id in ($acm)
					where   a.is_active     = 1
					and     is_allow_inq    = 1
					and     ##
					group by a.id";
		}

		$uni = str_replace('##', $whr, $uni);
		if($uni) {
			$sql = "select  distinct x.*, y.*
					from    v___sys_process  x
					join    (   $uni )       y on x.id = y.sys_process_id
					where    x.sys_app_id   = {$this->sys['cfg']['app']['id']}
					order by x.id";
			$rst = rst2ID($this->util_db_sql($sql));
		}
		return $rst;
	}

	private     function sys_bpm() {
		if(method_exists($this, 'sys_bpm_pre'))
			$this->sys_bpm_pre();
		$this->sys['req']['pid'] ? $this->sys_bpm_frm() : $this->sys_bpm_lst();
		if(method_exists($this, 'sys_bpm_pre'))
			$this->sys_bpm_xtd();
	}
	private     function sys_bpm_frm() {
		/*
		 * Service yang jalan hanya ketika memproses data detail
		 */
		// sys-svc-mms
		if(isset($this->sys['prc']['sys_svc']['mms']))
			$this->sys['svc']['mms']['dms_catalog_id']     = $this->sys['prc']['sys_svc']['mms']['dms_catalog_id'];
		
		// sys-svc-wfs
		if(isset($this->sys['prc']['sys_svc']['wfs'])) {
			$this->sys['svc']['wfs']['wfs_jsn']     = $this->sys['prc']['sys_svc']['wfs']['wfs_jsn'];
			$this->sys['svc']['wfs']['wfs_catalog_id']   = $this->sys['prc']['sys_svc']['wfs']['wfs_catalog_id'];
			$this->sys['svc']['wfs']['wfs_task_id']      = 0;
		}
		// sys-svc-wfa
		if(isset($this->sys['prc']['svc_wfa'])) {
			$this->sys['svc']['wfa']['wfa_mode_jsn']    = $this->sys['prc']['sys_svc']['wfa']['wfa_mode_jsn'];
			$this->sys['svc']['wfa']['wfa_mode_id']     = $this->sys['prc']['sys_svc']['wfa']['wfs_catalog_id'];
			$this->sys['svc']['wfa']['wfa_approval_id'] = 0;
		}
		// sys-svc-ntf
		if(isset($this->sys['prc']['sys_svc']['ntf']))
			$this->sys['svc']['ntf']['ntf_catalog_id']     = $this->sys['prc']['sys_svc']['ntf']['ntf_catalog_id'];
		
		// sys-svc-exp/imp
		if(isset($this->sys['prc']['sys_svc']['exp']['doc']))
			$this->sys['svc']['exp']['doc'] = $this->sys['prc']['sys_svc']['exp']['doc'];
		if(isset($this->sys['prc']['sys_svc']['exp']['Batch']))
			$this->sys['svc']['exp']['Batch'] = $this->sys['prc']['sys_svc']['exp']['Batch'];
		if(isset($this->sys['prc']['sys_svc']['imp']))
			$this->sys['svc']['imp']['Batch'] = $this->sys['prc']['sys_svc']['imp']['Batch'];
		
		// sys-sys-live
		if(isset($this->sys['prc']['sys_prc']['live']['jsn']))
			$this->sys['bpm']['sys']['live']['jsn']    = $this->sys['prc']['sys_svc']['live']['jsn'];
		if(isset($this->sys['prc']['sys_prc']['live']['start']))
			$this->sys['bpm']['sys']['live']['start']  = $this->sys['prc']['sys_svc']['live']['start'];
		if(isset($this->sys['prc']['sys_prc']['live']['finish']))
			$this->sys['bpm']['sys']['live']['finish'] = $this->sys['prc']['sys_svc']['live']['finish'];
		
		// normalize qp_arr
		if($this->sys['req']['pid'] != 'new' && array_key_exists('pid', $this->sys['bpm']['sp_arr'])) {
			unset($this->sys['bpm']['qp_arr']['pid']);
			// $this->sys['bpm']['qp_arr']['id'] = $this->sys['req']['pid'];
		}
	}
	private     function sys_bpm_lst() {
		$prc = $this->sys['prc'];
		/*
		 * Service Ping
		 */
		if (isset($this->sys['prc']['sys_svc']['ping'])) {
			$ping = $this->sys['prc']['sys_svc']['ping'];
			if($this->sys['req']['pid'])
				if(isset($ping['frm']))
					$this->sys['cfg']['online'] = ping('fsockopen', $ping['frm']);
				else
					if(isset($ping['lst']))
						$this->sys['cfg']['online'] = ping('fsockopen', $ping['lst']);
		}
		/*
		 * sys-event
		 */
		
		
		/*
		 * Filter data
		 */
		if($this->sys['req']['n']) {
			// implement free-search
			
			if($this->sys['bpm']['tbl'] && isset($this->sys['req']['q'])) {
				$stm = 'std';
				if(isset($this->sys['prc']['sys_tbl']['search']['col']))
					$stm = 'spc';
				if(isset($this->sys['prc']['sys_tbl']['search']['stm']))
					$stm = $this->sys['prc']['sys_tbl']['search']['stm'];
				elseif(isset($this->sys['prc']['sys_tbl']['search']['col']) && empty($this->sys['prc']['sys_tbl']['search']['stm']))
					$stm = 'spc';
				$stf = $this->sys['req']['q'];
				switch ($stm) {
					case 'std':     // standard
					case 'spc':     // special column
						$s = array();
						// method 1
						if($stm == 'std') {
							$tbl = preg_match('/^inq/', $this->sys['bpm']['qry']) ? $this->sys['bpm']['tbl'] : $this->sys['bpm']['bpm'];
							$exc = array('event_id', 'sys_table_id', 'sys_table_pk');
							
							foreach ($this->db->field_data($tbl) as $f) {
								if((preg_match('/(id|pid|rid|nid|_id)$/', $f->name) && preg_match('/int/', $f->type)) ||
									preg_match('/(date|time)/', $f->type) ||
									preg_match('/(event_|jsd)/', $f->name))
										$exc[] = $f->name;
								
								if(!in_array($f->name, $exc)) {
									if (is_numeric($stf)) {
										if (preg_match('/(phone|mobile|msisdn|celular|selular|telepon|telp|tlp|fax|ext)/', $f->name)) {
											$s[] = "{$f->name} = $stf";
											$s[] = "{$f->name} = 62" . substr($stf, 1);
										}
									elseif (preg_match('/int/', $f->type))
										$s[] = "{$f->name} = $stf";
								}
									else {
										if (preg_match('/char/', $f->type))
											$s[] = "{$f->name} like '$stf%'";
									}
								}
							}
						}
						// method 2
						else {
							foreach (explode(',', $this->sys['prc']['sys_tbl']['search']['col']) as $k => $v)
								$s[] = "$v like '{$stf}%'";
						}
						
						$s = implode(' or ', $s);
						$this->sys['bpm']['qp_str'] .= " and ($s)";
						unset($this->sys['req']['q']);
						break;
						
					case 'fti':   // full-text-index
						break;
				}
			}
		}
		
		/*
		 * override paging limit and offset (treegrid)
		 */
		if($this->sys['uix']['uxt'] == 'treegrid')
			$prc['sys_bpm']['lim'] = 10000;
		
		/*
		 * override paging limit and offset
		 */
		isset($prc['sys_bpm']['lim']) && ($this->sys['req']['l'] = $prc['sys_bpm']['lim']);
		$awl = ($this->sys['req']['p'] - 1) * $this->sys['req']['l'];
		$awl = $awl < 0 ? 0 : $awl;
		$this->sys['bpm']['off'] = in_array($this->sys['req']['out'], array('Batch', 'doc', 'pdf', 'csv')) ? '' : "limit {$this->sys['req']['l']} offset $awl";
		
		/*
		 * override sorting order
		 */
		if($this->sys['req']['s'] && $this->sys['req']['f'])
			$this->sys['bpm']['ord'] = "order by {$this->sys['req']['f']} {$this->sys['req']['s']}";
		else
			isset($prc['sys_bpm']['ord']) && ($this->sys['bpm']['ord'] = $prc['sys_bpm']['ord']);
		
		if(preg_match('/pxd_order/', $this->sys['bpm']['ord']))
			$this->sys['bpm']['ord'] = str_replace('pxd_order', 'concat(lpad(ifnull(pid, id),8,"0"), lpad(id ,8,"0"))', $this->sys['bpm']['ord']);
		
		if (!preg_match('/order/', $this->sys['bpm']['ord']))
			$this->sys['bpm']['ord'] = $this->sys['bpm']['ord'] ? 'order by ' . $this->sys['bpm']['ord'] : 'order by id';
		
		/*
		 * init query parameter
		 */
		if($this->sys['prc']['sys_tbl']['has']['col_active'])
			$prc['sys_bpm']['arr']['is_active'] = 1;
		
		if (isset($prc['sys_bpm']['arr'])) {
			//$qp_arr = json_decode($prc['qry']['bpm'], true);
			$qp_arr = $prc['sys_bpm']['arr'];
			$this->sys['bpm']['qp_arr'] = is_array($this->sys['bpm']['qp_arr']) ? array_merge($this->sys['bpm']['qp_arr'], $qp_arr) : $qp_arr;
			
			$this->util_parser_var_sys($this->sys['bpm']['qp_arr'], false);
			
			if($this->sys['bpm']['qp_arr'])
				$this->sys['bpm']['qp_str'] .= parser_whr($this->sys['bpm']['qp_arr'], $this->sys['req']);
		}
		
		if (isset($prc['sys_bpm']['str'])) {
			$this->sys['bpm']['qp_str'] .= $prc['sys_bpm']['str'];
		}
	
		// normalize sp_arr
		if($this->sys['bpm']['sp_arr'])
			$this->sys['bpm']['qp_str'] .= parser_whr($this->sys['bpm']['sp_arr'], $this->sys['req']);
	}
	
	private     function sys_rsp_uix() {
		if($this->sys['req']['rid']) {
			if(is_string($this->sys['prc']['sys_uix']))
				$uix = json_decode($this->sys['prc']['sys_uix'], true);
			else
				$uix = $this->sys['prc']['sys_uix'];
			
			$this->sys['req']['pid'] ?
				$this->sys_rsp_uix_frm($uix) :
				$this->sys_rsp_uix_lst($uix);
				
			if(!$this->sys['prc']['pid'])
				$this->session->unset_userdata('uix_fwd');
			
			if(substr($this->sys['uix']['gui'], 0, 1) == '@')
				$this->sys['uix']['gui'] = str_replace('@', '', $this->sys['uix']['gui']);
			
			// if($this->input->post('act') && $this->input->post('act') == 'inq')
			//	$this->sys['uix']['hst'] = null;
			
			// if($this->sys['req']['n'])
			// 	$this->sys['uix']['hst'] = null;
		}
		else {
			$this->sys['uix']['hst'] = null;
			$this->sys['uix']['gui'] = "index/dashboard-00.tpl";
		}
	}
	private     function sys_rsp_uix_frm($uix) {
		//1. define default top + hst + gui + uxt + g2x + asd
		$this->sys['uix']['top'] = isset($uix['uid']['top']) ? $uix['uid']['top'] : true;
		$this->sys['uix']['hst'] = isset($uix['uid']['hst']) ? $uix['uid']['hst'] : 'frm';
		$this->sys['uix']['gui'] = isset($uix['uid']['gui']) ? $uix['uid']['gui'] : 'frm_uxt.tpl';
		$this->sys['uix']['uxt'] = isset($uix['uid']['uxt']) ? $uix['uid']['uxt'] : null;
		$this->sys['uix']['g2x'] = isset($uix['uid']['g2x']) ? $uix['uid']['g2x'] : 'g2l';
		$this->sys['uix']['asd'] = isset($uix['uid']['asd']) ? $uix['uid']['asd'] : array('pos' => null, 'gui' => null);
		
		//2. define target
		if(isset($uix['uid']['pcx'])) {
			// 2a. define target (random)
			if($uix['uid']['pcx'] == 'session' || $this->input->post())
				$pcx = $this->session->userdata('pcx');
			else {
				$rdm = txt_random();
				$pcx = array('pcm' => $rdm, 'pcd' => $rdm.'D', 'pct' => $rdm.'T');
				$this->session->set_userdata('pcx', $pcx);
			}
			$this->sys['uix']['pcm'] = $pcx['pcm'];
		}
		else {
			// 2b. define target (predefine)
			$this->sys['uix']['pcm'] = isset($uix['uid']['pcm']) ? $uix['uid']['pcm'] : $this->sys['uix']['pcm'];
		}
		
		// 3. define hst with tab
		if(isset($uix['tab'])) {
			$tab = $uix['tab'];
			switch ($tab) {
				case 'tabA':
					if(isset($uix['uid']['nav'])) {
						// uid -> has tab
						$this->sys['uix']['hst'] = 'frm_nav';
						$this->sys['uix']['nav'] = $uix['uid']['nav'];
					}
					elseif(isset($uix['uib']['nav'])) {
						$this->sys['uix']['hst'] = 'frm_nav';
					}
					if (!empty($uix['uid']['pcm']))
						$this->sys['uix']['pcm'] = $uix['uid']['pcm'];
					break;
				
				default:
					$this->sys['uix']['hst'] = 'frm_nav';
					$this->sys['uix']['pcm'] = isset($uix['uid']['pcm']) ? $uix['uid']['pcm'] : $tab;
					break;
			}
		}
		
		if(isset($uix['uid']['btnUpd']))
			$this->sys['uix']['btnUpd'] = $uix['uid']['btnUpd'];
		if(isset($uix['uid']['btnDel']))
			$this->sys['uix']['btnDel'] = $uix['uid']['btnDel'];
		if(isset($uix['uid']['btnCls']))
			$this->sys['uix']['btnCls'] = $uix['uid']['btnCls'];
		
		$this->sys['uix']['reload'] = isset($uix['reload']) ? $uix['reload'] : 0;
		if($this->sys['uix']['reload']) {
			if ($this->sys['uix']['reload'] == 'referer')
				$this->sys['uix']['reload'] = $this->session->userdata('referer');
			else {
				$this->sys['uix']['reload'] = $this->sys['req']['rid'];
				if ($this->sys['req']['pid'])
					$this->sys['uix']['reload'] .= '/0/' . $this->sys['uix']['pid'];
				foreach (array('fid', 'xid', 'yid', 'zid') as $k => $v)
					if ($this->sys['req'][$v])
						$this->sys['uix']['reload'] .= '/' . $this->sys['uix'][$v];
			}
		}
		$this->sys['uix']['callback']   = isset($uix['callback']) ? $uix['callback'] : 0;
	}
	private     function sys_rsp_uix_lst($uix) {
		//1. define default top + hst + gui + uxt + g2x + asd
		$this->sys['uix']['top'] = isset($uix['uib']['top']) ? $uix['uib']['top'] : true;
		$this->sys['uix']['hst'] = isset($uix['uib']['hst']) ? $uix['uib']['hst'] : 'lst';
		$this->sys['uix']['gui'] = isset($uix['uib']['gui']) ? $uix['uib']['gui'] : 'tbl_uxt.tpl';
		$this->sys['uix']['uxt'] = isset($uix['uib']['uxt']) ? $uix['uib']['uxt'] : 'foo';
		$this->sys['uix']['g2x'] = isset($uix['uib']['g2x']) ? $uix['uib']['g2x'] : 'g2l';
		$this->sys['uix']['asd'] = isset($uix['uib']['asd']) ? $uix['uib']['asd'] : array('pos' => null, 'gui' => null);
		
		// 2. define target
		if(isset($uix['uib']['pcx'])) {
			// 2a. define target (random)
			if($uix['uib']['pcx'] == 'session' || $this->input->post())
				$pcx = $this->session->userdata('pcx');
			else {
				$rdm = txt_random();
				$pcx = array('pcm' => $rdm, 'pcd' => $rdm.'D', 'pct' => $rdm.'T');
				$this->session->set_userdata('pcx', $pcx);
			}
			$this->sys['uix']['pcd'] = $pcx['pcd'];
			$this->sys['uix']['pct'] = $pcx['pct'];
		}
		else {
			// 2b. define target (predefine)
			$this->sys['uix']['pcd'] = isset($uix['uib']['pcd']) ? $uix['uib']['pcd'] : $this->sys['uix']['pcd'];
			$this->sys['uix']['pct'] = isset($uix['uib']['pct']) ? $uix['uib']['pct'] : $this->sys['uix']['pct'];
		}
		
		// 3. set search option
		$this->sys['uix']['fsHide']      = isset($uix['uib']['fsH']) ? $uix['uib']['fsH']: true; // fsHide
		$this->sys['uix']['fsRow']       = isset($uix['uib']['fsR']) ? $uix['uib']['fsR']: true; // fsRow
		$this->sys['uix']['fsDefault']   = isset($uix['uib']['fsD']) ? $uix['uib']['fsD']: true; // fsDefault
		
		// 4. define host with tab
		if(isset($uix['tab'])) {
			$tab = $uix['tab'];
			if(isset($uix['uib']['nav'])) {
				// uib -> all has tab
				$this->sys['uix']['hst'] = 'lst_nav';
				$this->sys['uix']['nav'] = $uix['uib']['nav'];
				
				$this->sys['uix']['pcd'] = $tab . 'D';
				$this->sys['uix']['pct'] = $tab . 'T';
				switch ($tab) {
					case 'tabA':
						$this->sys['uix']['pcd'] = isset($uix['uib']['pcd']) ? $uix['uib']['pcd'] : $tab . 'D';
						break;
				}
			}
			else {
				// -> means tab in frm
				switch ($tab) {
					case 'tabA':
						$this->sys['uix']['hst'] = 'lst';
						break;
					
					default:
						$this->sys['uix']['hst'] = 'lst_nav';
						$this->sys['uix']['pcd'] = $tab . 'D';
						$this->sys['uix']['pct'] = $tab . 'T';
						break;
				}
			}
		}
	}
	
	public      function sys_rsp_ref() {
		$plc = $this->sys['req']['pid'] ? "'frm','both'" : "'lst','lst_only','both'";
		$ref = null;
		if(method_exists($this, 'sys_rsp_ref_pre'))
			$ref = $this->sys_rsp_ref_pre('config');
		$whr = $ref ? " and sys_pick_ref_id in($ref)" : '';
		$sql = "select    *
				from      v___sys_process__ref
				where     sys_process_id = {$this->sys['req']['rid']}
				and       elm_placement in ($plc)
				$whr
				order by  seq";
		if($rst = $this->util_db_sql($sql)) {
			foreach($rst as $k => $v) {
				$ref                            = $v['sys_pick_ref_id'];
				$this->sys['rsp']['ref'][$ref]  = $v;
				$this->sys['cfg']['fs']         = 1;
				switch($v['init_flg']) {
					case 0:
						$this->sys['rsp']['ref'][$ref] = $v;
						break;
					
					case 1:
					case 2:
						/*
						 * 1: init
						 */
						$v['sp_arr'] = $v['sp_jsd'] ? json_decode($v['sp_jsd'], true) : null;
						if(isset($v['sp_arr']['exc'])) {
							$v['exc'] = $v['sp_arr']['exc'];
							unset($v['sp_arr']['exc']);
						}
						
						if ($v['elm_chain'])
							$v['elm_chain'] = json_decode($v['elm_chain'], true);
					
						$v['elm_placeholder'] = $v['elm_placeholder'] ? $v['elm_placeholder'] : $v['elm_title'] ? $v['elm_title'] : $v['elm_label'];
						$v['elm_title']       = $v['elm_title']       ? $v['elm_title']       : $v['elm_label'];
					
						/*
						 * 2: unset unneeded var
						 */
						unset($v['sys_process_id'], $v['sys_pick_ref_id'], $v['event_id']);
						// if(isset($this->sys['bpm']['sp_arr'][$v['col_fid']]))
						//	unset($this->sys['bpm']['sp_arr'][$v['col_fid']]);
					
						/*
						 * 3: forced consistency
						 */
						if (isset($v['elm_parent']) && $v['elm_parent'] && $v['elm_type'] == 'select')
							$v['elm_type'] = 'select-group';
						
						/*
						 * 4.1: normalise sp_arr
						 */
						if ($v['sp_arr']) {
							$parse_jsn = false;
							foreach ($v['sp_arr'] as $x => $y) {
								if($this->sys['req']['pid'] == 'new') {
									if(preg_match('/dat__/', $y))
										unset($v['sp_arr'][$x]);
									elseif (preg_match('/__/', $y))
										$parse_jsn = true;
								}
								else {
									// skip index rsp__dat__xxx -> will prep later after get data (exec from sys_rsp_ref_dat)
									if ($y && $v['init_flg'] == 1)
										switch ($y) {
											case '#first':
											case '#last':
												break;
											
											default:
												if (preg_match('/__/', $y))
													$parse_jsn = true;
												break;
										}
								}
							}
							if($parse_jsn)
								$this->util_parser_var_sys($v['sp_arr'], false);
							
							foreach ($v['sp_arr'] as $col => $val) {
								if ($val && $v['init_flg'] == 1)
									switch ($val) {
										case '#first':
										case '#last':
											// take first-row or last row
											$asc          = $val == '#first' ? 'asc' : 'desc';
											$sql          = "select $col from {$v['sys_table_id']} where is_active = 1 order by id $asc limit 1";
											$v['sp_arr'][$col] = $this->util_db_sql($sql, 'cel');
											break;
									}
							}
						}
						
						/*
						 * 4.2: normalise default-value
						 */
						if ($v['sp_def']) {
							switch ($def= $v['sp_def']) {
								case '#first':
								case '#last':
									$asc = $v['sp_def'] == '#first' ? 'asc' : 'desc';
									$sql = "select id from {$v['sys_table_id']} where is_active = 1 order by id $asc limit 1";
									$v['sp_def'] = $this->util_db_sql($sql, 'cel');
									break;
							}
						}
						
						/*
						 * 4.3: normalise sp_str
						 */
						
						if ($v['sp_str'] && preg_match('/req__(rid|pid|fid|xid|yid|zid)/', $v['sp_str'])) {
							$idx      = array('req__rid', 'req__pid', 'req__fid', 'req__xid', 'req__yid', 'req__zid');
							$val      = array($this->sys['req']['rid'], $this->sys['req']['pid'], $this->sys['req']['fid'], $this->sys['req']['xid'], $this->sys['req']['yid'], $this->sys['req']['zid']);
							$v['sp_str'] = str_replace($idx, $val, $v['sp_str']);
						}
						
						/*
						 * 5.1 set sp_def
						 */
						if ($v['sp_def']) {
							switch ($v['elm_type']) {
								case 'date':
								case 'date-occur':
									$v['sp_def'] = date_iso8601(date_of($v['sp_def']));
									$this->sys['bpm']['sp_arr'][$v['col_fid']] = date_between($v['sp_def']);
									break;
								case 'date-range':
									$range = explode(',', $v['sp_def']);
									$v['sp_def']['start'] = date_of($range[0]);
									$v['sp_def']['end']   = date_of($range[0]);
									$this->sys['bpm']['sp_arr'][$v['col_fid']] = array('sp_def' => array('start' => date_iso8601($range[0]), 'end' => date_iso8601($range[1])));
									break;
								case 'select-multiple':
									$v['sp_def'] = explode(',', $v['sp_def']);
									$this->sys['bpm']['sp_arr'][$v['col_fid']] = $v['sp_def'];
									break;
								case 'select-group-multi':
									$v['sp_def'] = explode(',', $v[$ref]);
									$this->sys['bpm']['sp_arr'][$v['col_fid']] = $v['sp_def'];
									break;
								case 'select-tree':
									$pid = str_replace('_id', '_pid', $v['col_fid']);
									$this->sys['bpm']['sp_arr'][$pid]           = $v['sp_def'];
									$this->sys['bpm']['sp_arr'][$v['col_fid']]  = $v['sp_def'];
									break;
								case 'hidden':
									$this->sys['bpm']['qp_arr'][$v['col_fid']] = $v['sp_def'];
									break;
								default:
									$def = json_decode($v['sp_def'], true);
									if (is_array($def)) {
										$this->sys['bpm']['sp_arr'][$v['col_fid']] = parser_whr($def);
										$v['sp_def'] = null;
									}
									else
										$this->sys['bpm']['sp_arr'][$v['col_fid']] = $v['sp_def'];
									break;
							}
						}
						
						// $this->sys['rsp']['ref'][$ref] = $v;
						
						/*
						 * 5.2: reset sp_def when value come from form
						 */
						/*
						if($this->sys['req']['rid'] && !$this->sys['req']['pid']) {
							if ($this->sys['bpm']['sp_arr']) {
								foreach ($this->sys['bpm']['sp_arr'] as $col => $val) {
									if ($val) {
										if (isset($this->sys['rsp']['ref'][$col]))
											$this->sys['rsp']['ref'][$col]['sp_def'] = $val;
										else {
											$col = str_replace('_id', '', $col);
											if (isset($this->sys['rsp']['ref'][$col]))
												$this->sys['rsp']['ref'][$col]['sp_def'] = $val;
										}
									}
								}
							}
						}
						*/
						
						/*
						 * 6.0 exec direct ref (init_flg: 0:no, 1:direct, 2:after_rsp_dat, 3:custom)
						 */
						if ($v['init_flg'] == 1 && !in_array($v['elm_type'], array('hidden', 'free-search', 'date', 'date-range'))) {
							switch($v['elm_type']) {
								case 'select-group-multi':
									if($opts = $this->sys_rsp_ref_option($ref, $v)) {
										foreach($opts as $g => $o)
											$opt[$o['pid']][$o['id']] = $o['nm'];
									}
									$v['option'] = $opt;
									break;
								default:
									$v['option'] = $this->sys_rsp_ref_option($ref, $v);
									break;
							}
						}
						
						$this->sys['rsp']['ref'][$ref] = $v;
						break;
				}
			}
			if(method_exists($this, 'sys_rsp_ref_xtd'))
				$this->sys_rsp_ref_xtd();
		}
		
		if ($this->sys['usr']['is_admin'])
			$this->sys['cfg']['fs'] = 1;
	}
	protected   function sys_rsp_ref_option($ref, $cfg) {
		$arg = null;
		$out = array();
		$dat = array();
		$sql = false;
		// $cfg = $this->sys['rsp']['ref'][$ref];
		
		$xtd_col = '';
		if($tmp = json_decode($cfg['elm_attr'], true)) {
			foreach($tmp as $k=>$v) {
				$xtd_col .= ", $v $k";
			}
		}

		if(isset($cfg['sys_table_id'])) {
			$tbl = $cfg['sys_table_id'];
			$col = str_replace(array('qry_'),'', $tbl);
			
			if(preg_match('/pxd_order/', $cfg['sp_ord']))
				$cfg['sp_ord'] = str_replace('pxd_order', 'concat(lpad(ifnull(pid, id),8,"0"), lpad(id ,8,"0"))', $cfg['sp_ord']);
			$ord = $cfg['sp_ord'] ? $cfg['sp_ord'] : 'id';
			
			$whr = '';
			if(!isset($cfg['sp_arr']['is_active'])) {
				switch($cfg['elm_type']) {
					case 'select-group':
					case 'select-tree':
						$whr = 'a.is_active = 1 ';
						break;

					default:
						$whr = 'is_active = 1 ';
						break;
				}
			}

			if($cfg['sp_arr'])
				$whr .= $this->util_parser_var_sys($cfg['sp_arr']);
			
			if($cfg['sp_str'] && $cfg['sp_str'] != '#all')
				$whr .= $cfg['sp_str'];
		}
		else {
			$tbl = $col = $ref;
			$ord = 'id';
			$whr = 'is_active = 1 ';
			$cfg['col_sid'] = $cfg['sp_arr'] = $cfg['sp_str'] = null;
			if(in_array($cfg['elm_type'], array('select-group', 'select-group-multi')))
				$cfg['elm_parent'] = isset($cfg['elm_parent']) ? $cfg['elm_parent'] : 'pid';
		}

		switch($ref) {
			case 'is_active' :
				$dat = array(
					array('id' => 1,'nm' => 'Active'),
					array('id' => 0,'nm' => 'Disabled'));
				break;
			case 'is_visible' :
			case 'is_mandatory' :
			case 'is_required' :
				$dat = array(
					array('id' => 1,'nm' => 'Yes'),
					array('id' => 0,'nm' => 'No'));
				break;
			case 'is_internal' :
				$dat = array(
					array('id' => 1,'nm' => 'Internal'),
					array('id' => 0,'nm' => 'External'));
				break;
			case 'sex' :
				$dat = array(
					array('id' => 1,'nm' => 'Male'),
					array('id' => 0,'nm' => 'Female'));
				break;
			case 'slider_vendor' :
				/*  $dat = array(
						array('id' => 'owl-carousel','nm' => 'OWL Carousel'),
						array('id' => 'layer-slider','nm' => 'Layer Slider'),
						array('id' => 'revolution-slider', 'nm' => 'Revolution Slider'),
						array('id' => 'nivo-slider','nm' => 'Nivo Slider'));
				*/
				$dat = array(array('id' => 'owl-carousel','nm' => 'OWL Carousel'));
				break;
			case 'elm_type' :
				$dat = array(
					array('id' => 'hidden',         'nm' => 'Hidden'),
					array('id' => 'list',           'nm' => 'List'),
					array('id' => 'checkbox',       'nm' => 'Checkbox'),
					array('id' => 'free-search',    'nm' => 'Free Search'),
					array('id' => 'date',           'nm' => 'Date'),
					array('id' => 'date-occur',     'nm' => 'Date Occurrence'),
					array('id' => 'date-range',     'nm' => 'Duration'),
					array('id' => 'select',         'nm' => 'Select'),
					array('id' => 'select-self',    'nm' => 'Select-Self'),
					array('id' => 'select-group',   'nm' => 'Select-Group'),
					array('id' => 'select-tree',    'nm' => 'Select-Tree'),
					array('id' => 'select-multiple','nm' => 'Select-Multiple')
				);
				break;
			case 'elm-placement' :
				$dat = array(
					array('id' => 'lst',    'nm' => 'List'),
					array('id' => 'frm',    'nm' => 'Form'),
					array('id' => 'both',   'nm' => 'All'));
				break;
			case 'init-flg' :
				$dat = array(
					array('id' => 0, 'nm' => 'No'),
					array('id' => 1, 'nm' => 'Direct'),
					array('id' => 2, 'nm' => 'After SYS.RSP.DAT'),
					array('id' => 3, 'nm' => 'Custom'));
				break;
			case 'link-type' :
				$dat = array(
					array('id' => 'Internal','nm' => 'Internal'),
					array('id' => 'External','nm' => 'Eksternal'));
				break;
			case 'menu-location':
				$dat = array(
					array('id' => 'main',   'nm' => 'Main'),
					array('id' => 'usr',    'nm' => 'User'));
				break;
			case 'menu-type' :
				$dat = array(
					array('id' => 'mega',       'nm' => 'Mega-Menu'),
					array('id' => 'dropdown',   'nm' => 'Dropdown-Menu'),
					array('id' => 'header',     'nm' => 'Group-Menu'),
					array('id' => 'link',       'nm' => 'Menu Item'));
				break;
			
			case 'year' :
				$a = $this->sys['cfg']['iop_app_year'];
				$z = date('Y') + 1;
				for($i = $a; $i <= $z; $i ++) {
					$out[] = array('id' => $i, 'nm' => $i);
				};
				break;
			case 'date-occur':
				$dat = array(
					array('cd' =>'td',      'id' => 'today',      'nm' => 'Today'),
					array('cd' =>'-1d',     'id' => '-1 day',     'nm' => 'Yesterday'),
					array('cd' =>'+1d',     'id' => '+1 day',     'nm' => 'Tomorrow'),
					array('cd' =>'tw',      'id' => 'this week',  'nm' => 'This Week'),
					array('cd' =>'tm',      'id' => 'this month', 'nm' => 'This Month'),
					array('cd' =>'ty',      'id' => 'this year',  'nm' => 'This Year'),
					array('cd' =>'-1w',     'id' => '-1 week',    'nm' => 'Last Week'),
					array('cd' =>'-30d',    'id' => '-30 day',    'nm' => 'Last 30 Days'),
					array('cd' =>'-1m',     'id' => '-1 month',   'nm' => 'Last Month'),
					array('cd' =>'-3m',     'id' => '-3 month',   'nm' => 'Last 3 Months'),
					array('cd' =>'-6m',     'id' => '-6 month',   'nm' => 'Last 6 Months'),
					array('cd' =>'-1y',     'id' => '-1 year',    'nm' => 'Last Year'),
					array('cd' =>'-2y',     'id' => '-2 year',    'nm' => 'Last 2 Years'),
					array('cd' =>'-3y',     'id' => '-3 year',    'nm' => 'Last 3 Years'),
					array('cd' =>'-5y',     'id' => '-5 year',    'nm' => 'Last 5 Years'),
					array('cd' =>'+1w',     'id' => '+1 week',    'nm' => 'Next Week'),
					array('cd' =>'+1m',     'id' => '+1 month',   'nm' => 'Next Month'),
					array('cd' =>'+1y',     'id' => '+1 year',    'nm' => 'Next Year')
				);
				break;
			
			case 'geo-origin' :
			case 'geo-year' :
				$sql = "select distinct $ref id, $ref nm from geo_land_bps where $whr order by id";
				break;

			case 'orgz-tree' :
				$sql = "select id, org nm, pid from hrm_orgz where $whr order by id";
				$tmp = flat2tree($this->util_db_sql($sql));
				$out = $tmp[$this->sys['cfg']['app']['base_orgz']]['sub'];
				break;
		}

		if(!$out) {
			if($dat) {
				switch($cfg['elm_type']) {
					// case 'select' :
					case 'select-group' :
					case 'select-multiple' :
					case 'select-multi-group' :
						$out = rst2ref($dat);
						break;
					default :
						$out = $dat;
						break;
				}
			}
			elseif($sql)
				$out = rst2ref($this->util_db_sql($sql));
			else {
				if($cfg['col_sid'])
					$col = $cfg['col_sid'];
				
				// if(in_array($this->sys['prc']['sys_tbl']['sys_table_type_id'], range(90, 93))) {
				/* if(preg_match('/^(vap|vws)/', $tbl))
					$sql = "select id, $col nm $xtd_col from {$tbl} where $whr order by $ord";
				elseif($cfg['is_magic_sql'])
					$qry = $this->util_db_sql_magic($tbl, array('sp_arr'=>$cfg['sp_arr'], 'sp_str'=>$cfg['sp_str'], 'mgc'=>$cfg['is_magic_sql']));
				*/
				switch($cfg['elm_type']) {
					case 'select':
						$id = $cfg['col_fid'] == $cfg['col_sid'] ? $cfg['col_fid'] : 'id';
						
						if($cfg['is_magic_sql']) {
							$qry = $this->util_db_sql_magic($tbl, array('sp_arr' => $cfg['sp_arr'], 'sp_str' => $cfg['sp_str'], 'mgc' => $cfg['is_magic_sql']));
							$sql = "select distinct $id id, $col nm $xtd_col from ($qry) xx order by $ord";
						}
						else {
							$sql = "select distinct $id id, $col nm $xtd_col from {$cfg['sys_table_id']} where $whr order by $ord";
						}
						$out = $this->util_db_sql($sql);
						break;

					case 'select-multiple':
						$idx = $cfg['col_rid'] ? $cfg['col_rid'] : 'id';
						$sql = "select $idx id, $col nm $xtd_col from {$tbl} where $whr order by $ord";
						break;

					case 'select-self':
						$col = $cfg['col_fid'];
						$sql = "select distinct $col id, $col nm $xtd_col from {$tbl} where $whr order by $ord";
						break;

					case 'select-limited':
						$col = $tbl . '_id';
						if(isset($this->sys['rsp']['dat'][$col])) {
							$idx = $this->util_db_qry($tbl, array('id' => $this->sys['rsp']['dat'][$col]), $cfg['col_sid']);
							$sql = "select id, $col nm $xtd_col from {$tbl}
									where  is_active = 1 $whr
									and id in ($idx)
									order by $ord";
						}
						break;

					case 'select-group':
					case 'select-group-multi':
						if ($cfg['elm_parent'] == 'pid') {
							$ord = $ord=='id' ? 'a.id' : $ord;
							$sql = "select      a.id, a.$col nm, b.$col pid $xtd_col
									 from       {$tbl} a
									 left join  {$tbl} b on b.id = a.pid and a.is_active = 1 and b.is_active = 1
									 where      $whr
									 order by   $ord";
						}
						else {
							$qry = $this->util_db_sql_magic($tbl, array('sp_arr'=>$cfg['sp_arr'], 'sp_str'=>$cfg['sp_str'], 'mgc'=>$cfg['is_magic_sql']));
							$sql = "select id, $col nm, $cfg[elm_parent] pid $xtd_col from ($qry) xy order by $ord";
						}
						break;

					case 'select-tree':
						if($cfg['elm_parent'] == 'parent-only') {
							$pid = "a.$col pid";
							$sql = "select      distinct a.id, a.$col nm, if(b.pid, 'bold', 'child') cls, concat('i', a.tree) ind, $pid $xtd_col
									from	    {$tbl} a
									left join   {$tbl} b on a.id = b.pid
									where       $whr
									and  (a.pid is null or a.id in (select distinct pid from {$tbl} where pid is not null))
									order by $ord";
						}
						else {
							$pid = $cfg['elm_parent'] ? $cfg['elm_parent'] : 'a.pid';
							$ord = $ord == 'id' ? 'a.id' : $ord;
							$sql = "select      distinct a.id, a.$col nm, if(b.pid, 'bold', 'child') cls, concat('i', a.tree) ind, $pid $xtd_col
									from	    {$tbl} a
									left join   {$tbl} b on a.id = b.pid
									where       $whr
									order by $ord";
						}
						break;
					
					case 'list':
						$qry = $this->util_db_sql_magic($tbl, array('sp_arr'=>$cfg['sp_arr'], 'sp_str'=>$cfg['sp_str'], 'mgc'=>$cfg['is_magic_sql']));
						$sql = "select id, $col nm $xtd_col from ($qry) xz order by $ord";
						break;
				}

				if(!$out && $sql && $tmp = $this->util_db_sql($sql)) {
					switch($cfg['elm_type']) {
						case 'select-group':
							foreach($tmp as $k => $v)
								$out[$v['pid']][] = $v;
							break;
						
						case 'list':
						case 'select':
						case 'select-self':
						case 'select-tree':
						case 'select-limited':
						case 'select-multiple':
						case 'select-group-multi':
							$out = $tmp;
							break;
					}
				}
			}
		}
		
		if ($cfg['sp_def']) {
			switch ($cfg['sp_def']) {
				case '#first':
					$this->sys['rsp']['ref'][$ref]['sp_def'] = $out[0]['id'];
					break;
				case '#last':
					$max = count($out);
					$this->sys['rsp']['ref'][$ref]['sp_def'] = $out[$max-1]['id'];
					break;
			}
		}
		return $out;
	}
	protected   function sys_rsp_ref_dat() {
		if($this->sys['rsp']['ref'])
			foreach($this->sys['rsp']['ref'] as $ref => $v) {
				// setup sp_def
				switch($v['elm_type']) {
					case 'select-multiple':
						if(!empty($this->sys['rsp']['dat'][$v['col_fid']]))
							$this->sys['rsp']['dat'][$v['col_fid']] = explode(',', $this->sys['rsp']['dat'][$v['col_fid']]);
						break;
					case 'select-group-multi':
						if($this->sys['rsp']['dat'][$v['col_fid']])
							foreach($this->sys['rsp']['dat'][$v['col_fid']] as $x=>$y)
						$v['sp_def'][$y] = $y;
						break;
					default:
						$v['sp_def'] = isset($this->sys['rsp']['dat'][$v['col_fid']]) ? $this->sys['rsp']['dat'][$v['col_fid']] : '';
						break;
				}

				// setup option
				// init option
				switch ($v['init_flg']) {
					case 2:     // after rsp_dat
						if($this->sys['req']['pid'] && $this->sys['req']['pid'] != 'new' && preg_match('/rsp__dat/', $v['sp_jsd'])) {
							$this->sys['cfg']['fs'] = 1;
							$this->util_parser_var_sys($this->sys['rsp']['ref'][$ref]['sp_arr'], false);
							$v['option'] = $this->sys_rsp_ref_option($ref, $v);
						}
						break;
					
					case 3: // custom-1
						$this->sys['cfg']['fs'] = 1;
						$v['sp_arr'] = $this->util_parser_var_dat($v['sp_arr']);
						$v['option'] = $this->sys_rsp_ref_option($ref, $v);
						break;
				
					case 4: //custom-2
						$this->sys['cfg']['fs'] = 1;
						$this->sys_rsp_ref_xtd($ref);
						$v['option'] = $this->sys_rsp_ref_option($ref, $v);
						break;
				}
				
				// xtd init option
				$elm_xtd = json_decode($v['elm_xtd'], true);
				if(is_string($elm_xtd)) {
					switch($elm_xtd) {
						case 'unset_prev':
							if(!empty($this->sys['rsp']['dat'][$v['col_fid']])) {
								$val = $this->sys['rsp']['dat'][$v['col_fid']];
								foreach($v['option'] as $r => $i)
									if($i['id'] < $val)
										unset($v['option'][$r]);
							}
							break;
					}
				}
				else {
					if(isset($elm_xtd['unset_prev'])) {
						$cond = $elm_xtd['unset_prev']['cond'];
						$keys = array_keys($cond);
						$valc = $cond[$keys[0]];
					}
				}
				
				// omit item by criteria
				if(isset($v['omit'])) {
					switch ($v['elm_type']) {
						case 'list':
						case 'select':
						case 'select-self':
						case 'select-tree':
						case 'select-limited':
						case 'select-multiple':
						case 'select-group-multi':
							foreach($v['option'] as $i=>$o) {
								if(in_array($v['id'], $v['omit']))
									unset($v['option'][$i]);
							}
							break;
					}
				}
				
				unset(
					$v['seq'],              $v['col_sid'],  $v['sys_table_id'], $v['elm_xtd'],  $v['elm_parent'],
					$v['elm_placement'],    $v['sp_jsd'],   $v['sp_str'],   $v['sp_ord'],       $v['live_jsd'],
					$v['is_magic_sql'],     $v['is_public'],$v['sp_arr']);
				
				$this->sys['rsp']['ref'][$ref] = $v;
			}
	}
	protected   function sys_rsp_ref_man($ref, $cfg) {
		$ref = array_merge($this->util_db_qry('sys_process__ref', array('sys_pick_ref_id' => $ref)), $cfg);
	}
	
	public      function sys_cmd_inq() {
		// $this->output->enable_profiler(true);
		if(is_numeric($this->sys['req']['rid']) && $this->sys['req']['rid']) {
			if(!$this->sys['req']['n'])
				$this->sys_rsp_ref();
			$this->sys_bpm();
		}
		
		$tbl = $this->sys['bpm']['qry'] ? $this->sys['bpm']['qry'] : $this->sys['bpm']['tbl'];
		$bpm = $this->sys['bpm']['bpm'];
		switch ($this->sys['prc']['sys_tbl']['sys_table_type_id']) {
			case 80:
				// store procedure
				$this->model->bpm_store_procedure();
				break;
			
			default:
				if($bpm && ($this->sys['req']['pid'] || $this->sys['req']['fid']) && $this->sys['req']['pid'] != 'new' && $this->sys['req']['fid'] != 'new' && method_exists($this, $bpm)) {
					$this->$bpm();
					$this->util_wfs_task('inq_task');
					$this->sys_rsp_ref_dat();
				}
				else
					$this->sys['req']['pid'] ? $this->sys_cmd_inq_frm($tbl) : $this->sys_cmd_inq_lst($tbl);
				break;
		}
	}
	private     function sys_cmd_inq_frm($tbl) {
		$pre = $this->sys['bpm']['sfn']['pre'];
		$xtd = $this->sys['bpm']['sfn']['xtd'];
		if($this->sys['req']['pid'] == 'new') {
			if(preg_match('/^inq/', $tbl))
				$tbl = $this->sys['bpm']['tbl'];
			
			if(in_array($this->sys['prc']['sys_tbl']['sys_table_type_id'], range(90, 93)))
				$sql = "select * from {$tbl} where 1 = 2";
			else
				$sql = $this->util_db_sql_magic($tbl) . ' and 1 = 2';
				$sql = $this->util_db_sql_magic($tbl) . ' and 1 = 2';
			
			$this->sys['rsp']['dat'] = $this->util_db_sql($sql, 'row', 'void');
			foreach($this->sys['rsp']['dat'] as $k=>$f) {
				if(isset($this->sys['bpm']['qp_arr'][$k]))
					$this->sys['rsp']['dat'][$k] = $this->sys['bpm']['qp_arr'][$k];
			}
			
			if(isset($this->sys['rsp']['dat']['is_active']))
				$this->sys['rsp']['dat']['is_active'] = 1;
			
			// get cfg ready for mms- upload
			if(isset($this->sys['svc']['mms']['dms_catalog_id'])) {
				$cat = false;
				if(isset($this->sys['rsp']['dat']['dms_catalog_id']) && $this->sys['rsp']['dat']['dms_catalog_id'] != $this->sys['svc']['mms']['dms_catalog_id'])
					$cat = $this->sys['rsp']['dat']['dms_catalog_id'];
				else
					$cat = $this->sys['svc']['mms']['dms_catalog_id'];
				if($cat)
					$this->sys['svc']['mms']['util_img'] = json_decode($this->MA_IOP->util_db_qry('dms_catalog', $cat), true);
			}
			
			// get ready for wfs-task
			$this->util_wfs_task('inq_task');
			
			$this->sys_cmd_inq_frm_xtd();
			$this->sys_rsp_ref_dat();
		}
		else {
			if(method_exists($this, $pre))
				$this->$pre();
			else
				$this->sys_cmd_inq_frm_pre();
			
			if($this->sys['bpm']['cfg']['tbm'] && !isset($this->sys['rsp']['dat'])) {
				if(preg_match('/^inq/', $tbl)) {
					$this->$tbl();
					$this->sys_rsp_ref_dat();
				}
				else {
					if(in_array($this->sys['prc']['sys_tbl']['sys_table_type_id'], range(90, 93))) {
						$whr = parser_whr($this->util_tbl_pky($tbl));
						$sql = "select * from {$tbl} where 1=1 $whr";
					}
					else
						$sql = $this->util_db_sql_magic($tbl, array('frm' => 1, 'is_active' => 1), $join = true);
					
					$this->sys['rsp']['dat'] = $this->util_db_sql($sql, 'row', 'void');
				}
			}
			$this->util_wfs_task('inq_task');
			
			if(method_exists($this, $xtd))
				$this->$xtd();
			else
				$this->sys_cmd_inq_frm_xtd();
			
			$this->sys_rsp_ref_dat();
		}
	}
	private     function sys_cmd_inq_lst($tbl) {
		$pre = $this->sys['bpm']['sfn']['pre'];
		$xtd = $this->sys['bpm']['sfn']['xtd'];
		$prc = $this->sys['prc'];
		if(method_exists($this, $pre))
			$this->$pre();
		else
			$this->sys_cmd_inq_lst_pre();
		
		if($this->sys['bpm']['cfg']['tbm'] && !isset($this->sys['rsp']['dat'])) {
			if(preg_match('/^inq/', $tbl)) {
				$this->$tbl();
			}
			elseif (isset($this->sys['rsp']['qry'])) {
				$qrc = $this->sys['rsp']['qrc'] ? $this->sys['rsp']['qrc'] : null;
				$this->sys['rsp']['dat'] = $this->util_db_sql($this->sys['rsp']['qry']);
				$this->sys['rsp']['tot'] = $qrc ? $this->util_db_sql($qrc, 'cel') : count($this->sys['rsp']['dat']);
				unset($this->sys['rsp']['qry'], $this->sys['rsp']['qrc']);
			}
			else {
				if(in_array($prc['sys_tbl']['sys_table_type_id'], range(90, 93)) || !$prc['sys_prc']['is_magic']) {
					$sql = "select count(id) total from $tbl where 1=1 {$this->sys['bpm']['qp_str']}";
					$this->sys['rsp']['tot'] = $this->util_db_sql($sql, 'cel') | 0;
					
					$sql = "select * from $tbl where 1=1 {$this->sys['bpm']['qp_str']} {$this->sys['bpm']['ord']} {$this->sys['bpm']['off']}";
					$this->sys['rsp']['dat'] = $this->util_db_sql($sql);
				}
				else {
					$cfg['tot'] = 1;
					$cfg['qp_arr'] = 1;
					
					if(isset($this->sys['bpm']['sp_arr']['is_active']))
						$cfg['is_active'] = $this->sys['bpm']['sp_arr']['is_active'];
					
					if($prc['sys_prc']['is_magic']) {
						$sql = $this->util_db_sql_magic($tbl, $cfg, $join = true);
						
						$this->sys['rsp']['tot'] = $this->util_db_sql($sql[0], 'cel') | 0;
						$this->sys['rsp']['dat'] = $this->util_db_sql($sql[1]);
					}
				}
			}
		}
		if(method_exists($this, $xtd))
			$this->$xtd();
		else
			$this->sys_cmd_inq_lst_xtd();
		
		if(isset($this->sys['rsp']['xtd']) && $this->sys['rsp']['xtd']) {
			$this->sys['rsp']['dat'] =	array_merge($this->sys['rsp']['xtd'], $this->sys['rsp']['dat']);
			unset($this->sys['rsp']['xtd']);
		}
		
		isset($this->sys['rsp']['tot']) && $this->sys_cmd_inq_lst_nav();
		
	}
	protected   function sys_cmd_inq_lst_nav() {
		//FixMe: jika pgC = 2 dan total = 10, pgC seharusnya bernilai 1;
		
		$nav = array('pgC' => 1, 'pgP' => 0, 'pgN' => 0, 'pgL' => 1, 'pgT' => 1, 'pgS' => array());
		$nav['row'] = array_unique (array($this->sys['req']['l'], 10, 25, 50, 100, 200));
		ksort($nav['row']);
		$tot = $this->sys['rsp']['tot'];
		if($tot) {
			$l = $this->sys['req']['l'];
			$c = $this->sys['req']['p'];
			// $c = 11;
			// $tot=200;
			if($tot > $l) {
				$t = ceil($tot / $l);
				$nav['pgT'] = $t ? $t : 1;
				$nav['pgC'] = $c > $t ? $t : $c;
				$nav['pgP'] = $c == 1 ? 0  : $c - 1;
				$nav['pgN'] = $c + 1 <= $t ? $c + 1 : 0;
				$nav['pgL'] = $c == $t ? 0 : $t;
				$d = 5;
				$a = $c - $d < 0 ? 1 : $c - $d;
				$z = $c + $d > $t ? $t : $c + $d;
				for($i = $a; $i <= $z; $i ++)
					$nav['pgS'][$i] = $i;
				$x = 0;
				// $z = 10000;
				while($z > 1000) {
					if(floor($t / $z) > 1 && ceil($t / $z) <= 8) {
						$x = $z;
						break;
					}
					$z -= 1000;
				}
				if(! $x)
					while($z > 100) {
						if(floor($t / $z) > 2 && ceil($t / $z) <= 8) {
							$x = $z;
							break;
						}
						$z = floor($z / 2);
					}
				if(! $x) {
					$z = 100;
					while($z > 10) {
						if(floor($t / $z) > 2 && ceil($t / $z) <= 8) {
							$x = $z;
							break;
						}
						$z = floor($z / 2);
					}
				}
				if(! $x && ceil($t / 10) <= 8)
					$x = 10;
				if($x) {
					$i = 0;
					while($i < $t) {
						$nav['pgS'][$i] = $i;
						$i += $x;
					}
					unset($nav['pgS'][0]);
				}
				ksort($nav['pgS']);
			}
			elseif(empty($tot)) {
				// $nav = array('pgC' => 1, 'pgP' => 0, 'pgN' => 0, 'pgL' => 0, 'pgT' => 1, 'pgS' => array());
			}
		}
		
		$this->sys['nav'] = $nav;
	}
	
	public      function sys_cmd_unq() {
		// url: rid/<column>/<value>
		$whr = '';
		$tbl = $this->sys['bpm']['tbl'];
		$fmd = rst2ID(object2array($this->db->field_data($tbl)), 'name');
		$fmd = $fmd[$this->sys['req']['pid']];
		$col = $this->sys['req']['pid'];
		
		if(preg_match('/(char|date)/', $fmd['type']))
			$this->sys['req']['fid'] = $this->util_escape($this->sys['req']['fid']);
		
		$val = $this->sys['req']['fid'];
		$rst = $this->bpm_unq();
		if(!$rst) {
		switch ($this->sys['req']['rid']) {
			case 'dms_doc' :
				if (isset($this->sys['req']['xid']) && $this->sys['req']['xid'])
					$whr = " and doc_index_id = {$this->sys['req']['fid']}";
				break;
		}
		// $sql = "select $col 'col' from $tbl where $col = $val $whr";
		$sql = "select ? 'col' from $tbl where ? = ? ?";
		$rst = $this->util_db_sql($sql, array($col, $col, $val, $whr), 'cel');
		}
		return $rst ? 'n' : 'y';
	}
	public      function sys_cmd_inf() {
		if(method_exists($this, 'bpm_inf'))
			$this->bpm_inf();
		
		if(!$this->sys['ack']['err'] && empty($this->sys['rsp']['dat'])) {
			$sql = null;
			switch($this->sys['req']['rid']) {
				case 'audiences':
					parse_str($_SERVER['QUERY_STRING'], $_GET);
					$a1  = $this->input->get('term');
					$out = json_encode($this->sys_var($this->sys), JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);
					break;
				
				case 'logs':
					$rsp['dat'] = '';
					$rst        = $this->sys_var($this->sys);
					switch($this->sys['req']['pid']) {
						case 'inquiry':
							$tmp = json_decode($rst, true);
							if(is_array($tmp))
								foreach($tmp['dat'] as $k => $v) {
									if(is_array($k))
										foreach($k as $x => $y)
											if($x != 'event_id')
												$rsp['dat'] .= "<tr><th>$x</th><td>$y</td></tr>";
											else
												$rsp['dat'] .= "<tr><th>$k</th><td>$v</td></tr>";
								}
							else {
								
							}
							break;
						case 'insert':
						case 'delete':
						case 'update':
							if(isset($rst[0]['dat']) && $rst[0]['dat']) {
								foreach($rst as $k => $v) {
									$rsp['dat'] .= "<table><thead>
							<tr><th>TABLE</th><td>$v[tbl]</td></tr>";
									if($v['pky']) {
										$pky = json_decode($v['pky'], true);
										$rsp['dat'] .= "<tr><th>PKEY</th><td>";
										if(is_array($pky))
											foreach($pky as $px => $py)
												$rsp['dat'] .= "$px : $py<br />";
										else
											$rsp['dat'] .= $pky;
										$rsp['dat'] .= "</td></tr>";
									}
									$rsp['dat'] .= "</thead></table>";
									$rsp['dat'] .= array2Html(json_decode($v['dat'], true));
								}
							}
							// elseif(isset($rst['dat']))
							//	$rsp['dat'] .= array2Html(json_decode($rst['dat'], true));
							// else
							//	$rsp['dat'] .= array2Html($rst);
							
							$rsp['dat'] = str_replace('<table>', '<table class="table">', $rsp['dat']);
							break;
					}
					break;
				
				default:
					$rsp = $this->model->proxy('bpm_inf', $this->sys['req']);
					break;
			}
		}
	}
	public      function sys_cmd_opt() {
		if(method_exists($this, 'bpm_opt'))
			$this->bpm_opt();
		
		if(!$this->sys['ack']['err'] && empty($this->sys['rsp']['dat'])) {
			$this->sys['req']['out'] = 'echo';
			$sql = null;
			if(!$this->sys['rsp']['dat']) {
				$sql = null;
				$col = $this->sys['req']['fid'];
				$val = $this->util_escape($this->sys['req']['xid']);
				switch($tbl = $this->sys['req']['pid']) {
					case 'nik' :
						$sql = "select  id, hrm_employee, path, hrm_orgz_short
								from    qry_hrm_employee
								where   id like '%$val%' or hrm_employee like '%$val%' limit 10";
						break;
					
					case 'wfs_team':
						$sql                     = "select * from $tbl where id = $val";
						$tmp                     = $this->util_db_sql($sql, 'row');
						if(isset($tmp['cfg_rule'])) {
							$sql = "select 	a.id, aaa_account nm, icon
									from 	aaa_account a
									join	aaa_acm__aaa_account    b on a.id = b.aaa_account_id and b.aaa_acm_id in ({$tmp['cfg_pic']})
									join	aaa_acm                 c on c.id = b.aaa_acm_id
									join	aaa_acm_clearance       d on d.id = c.aaa_acm_clearance_id
									where   a.id > 99";
						}
						break;
						
					case 'aaa_acm_by_sys_app':
						$sql = "select  id, aaa_acm nm
								from    aaa_acm
								where   is_active = 1
								and     (sys_app_id is null or sys_app_id = $val)
								limit 10";
						break;
					
					default:
						$tbl = str_replace('qry_', '', $tbl);
						$whr = " and $col = $val";
						$sql = "select  id, $tbl nm
								from    $tbl
								where   is_active = 1 $whr";
						break;
				}
			}

			if($sql)
				$this->sys['rsp']['dat'] = $this->util_db_sql($sql);
		}
	}
	public      function sys_cmd_acs() {
		if(method_exists($this, 'bpm_acs'))
			$this->bpm_acs();
		
		if(!$this->sys['ack']['err'] && empty($this->sys['rsp']['dat'])) {
			$obj = $this->sys['req']['obj'];
			$q   = $this->sys['req']['q'];
			$hst = $this->sys['cfg']['host'];
			$sql = '';
			
			switch($obj) {
				case 'hrm_superior' :
				case 'hrm_supervisor' :
					$sql = "select  id, hrm_employee nm, id_code, email, concat('$hst', media_avatar) img, hrm_orgz_position hrm_position, hrm_orgz_short hrm_orgz
							from    qry_hrm_employee
							where   is_active = 1
							and     hrm_employee like '%$q%'
							limit 10";
					break;
				
				case 'hrm_employee' :
					$sql = "select  id, hrm_employee nm, id_code, email, concat('$hst', media_avatar) img, hrm_orgz_position hrm_position, hrm_orgz_division hrm_orgz
							from    qry_hrm_employee
							where   is_active = 1
							and     (hrm_employee like '%$q%' or hrm_orgz_division LIKE '%$q%')
							limit 10";
					break;
				
				case 'geo_administrative' :
					$sql = "select  id, geo_administrative nm, concat(location_xtd, ' (', data_origin, ':', data_year, ')') xtd
							from    geo_administrative
							where   is_active = 1
							and      (geo_administrative like '%$q%' or location_xtd like '%$q%')
							order by id
							limit 10 ";
					break;
				
				case 'postal_code' :
					$sql = "select geo_postal_code id, concat(geo_county, ', ', geo_district, ', ', geo_regency, ', ', geo_province) nm
							from    geo_postal_code
							where is_active = 1 and (geo_county like '%$q%' or geo_district like '%$q%' or geo_regency like '%$q%' or geo_province like '%$q%')
							limit 10";
					break;
				
				case 'ldap_users' :
					if($rst = $this->ldap_users($q))
						$rsp = array('ack' => true, 'msg' => '', 'dat' => $rst);
					break;
				
				case 'sys_search' :
					$sql = "select id, cms_content nm from cms_content where cms_content like '%$q%' limit 10";
					break;
				
				default :
					$col = str_replace('qry_', '', $obj);
					$sql = "select id, $col nm from {$obj} where $col like '%$q%'";
					break;
			}
			if($sql && !$this->sys['rsp']['dat']) {
				if($rst = $this->util_db_sql($sql)) {
					$this->sys['rsp']['dat'] = $rst;
				}
				else
					$this->sys['ack']['err'] = true;
			}
		}
	}
	
	public      function sys_cmd_aud() {
		$cmd = $this->sys['req']['aud'];
		if($this->sys['prc']['sys_aaa']['right'][$cmd]) {
			if (!isset($this->sys['req']['pst']['event_id']))
				$this->sys['req']['pst']['event_id'] = $this->sys['event']['id'];
			
			$tbl = $this->sys['bpm']['tbl'];
			
			if ($this->sys['ack']['err'] || in_array($this->sys['req']['cmd'], array('inq', 'login', 'logout', 'lockin', 'lockout'))) {
				$this->sys_cmd_aud_exec('event');
			}
			else {
				$this->db->trans_begin();
				
				if (!empty($this->sys['svc']['wfs']['wfs_catalog_id']))
					$this->util_wfs_task('inq_task');
				
				$cmd = 'sys_cmd_aud' . $this->sys['req']['aud'];
				$this->$cmd();
				if ($this->sys['ack']['err'] || $this->db->trans_status() === false) {
					$this->db->trans_rollback();
					if ($cmd == 'del') {
						$lnk = is_array($this->sys['ack']['msg']) ? implode(', ', $this->sys['ack']['msg']) : $this->sys['ack']['msg'];
						$this->sys['ack']['msg'] = "<br />This data already been used in the following table(s): <b>$lnk</b><br /><br />Please Manually delete the data in table(s), and try again";
					}
				}
				else {
					$this->db->trans_commit();
					
					if ($tbl['is_tim'])
						$this->sys_tbl($tbl);
				}
				if (!$this->sys['ack']['err']) {
					// check if this process should update task_stage
					if (!empty($this->sys['svc']['wfs_task_id'])) {
						$this->util_wfs_task('upd_task_stage_prog');
					}
					
					// check this process should send notification
					if (!empty($this->sys['svc']['ntf_catalog_id'])) {
						$ntf = $this->sys['svc']['ntf_catalog_id'] == 1 ? 'sys' : $this->sys['svc']['ntf_catalog_id'];
						$this->util_ntf_init($ntf);
					}
				}
			}
		}
		else {
			switch ($this->sys['req']['aud']) {
				case 'add':
					$this->sys['ack']['err'] = 'AAA_101';
					$this->sys['ack']['msg'] = 'Insufficient Privilege to Insert New Data';
					break;
				case 'upd':
					$this->sys['ack']['err'] = 'AAA_102';
					$this->sys['ack']['msg'] = 'Insufficient Privilege to Modify Data';
					break;
				case 'del':
					$this->sys['ack']['err'] = 'AAA_103';
					$this->sys['ack']['msg'] = 'Insufficient Privilege to Delete Data';
					break;
			}
		}
	}
	protected   function sys_cmd_aud_exec($aud = 'event', $tbl = null, $dat = null, $key = null) {
		$dbg        = 0;
		$log        = 0;
		$cud        = false;
		$prc        = $this->sys['prc'];
		$err_no     = null;
		$err_msg    = null;
		$err_cls    = 'Database Error';
		
		if(empty($this->sys['event']['aaa_audit_trail_id']) && in_array($aud, array('insert', 'update', 'delete')))
			$this->sys['event']['aaa_audit_trail_id'] = $aud;
		
		if(!$this->sys['event']['is_log'] && $this->sys['event']['aaa_audit_trail_id'] && $aud != 'event') {
			$this->sys_cmd_aud_exec('event');
		}
		
		switch($aud) {
			case 'event':
				$sql = "select 	is_aud, is_active
						from 	aaa_audit_trail
						where 	id = '{$this->sys['event']['aaa_audit_trail_id']}'";
				$row = $this->util_db_sql($sql, 'row', 'void');
				
				if($row['is_aud'] || $row['is_active']) {
					$dtx                            = $this->util_parser_add('event', $this->sys['event']);
					$dtx['sys_table_id']            = $this->sys['bpm']['tbl'];
					$this->sys['event']['is_log']   = 1;
						$this->db->insert('event', $dtx);
					
					$dtx                    = $this->util_parser_add('event_ext', $this->sys['event']);
					$dtx['event_id']        = $this->sys['event']['id'];
					$dtx['event_ts_out']    = time();
					$this->db->insert('event_ext', $dtx);
				}
				break;

			case 'insert' :
			case 'insert_batch' :
				$dbg = 0;
				$log = $prc['sys_aaa']['audit']['ins'];
				$cud = array('aud' => $aud, 'sys_table_id' => $tbl,
					'dat'   => json_encode($dat, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT),
					'rows'  => 0, 'event_id' => $this->sys['event']['id']);
				if(isset($dat[0]) || $aud == 'insert_batch') {
					$this->sys['ack']['err'] = !$this->db->insert_batch($tbl, $dat);
					$cud['rows'] = $this->db->affected_rows();
				}
				else {
					if(!isset($dat['event_id']))
						$dat['event_id'] = $this->sys['event']['id'];
					
					$aci = 0;
					switch($prc['sys_tbl']['sys_table_pk_type_id']) {
						case 1: // auto_increment
							$aci = 1;
							unset($dat['id']);
							break;
						
						case  2: case 3: case 4: case 5: case 6: case 7: case 8: case 9:
						case 10:case 11:case 12:case 13:case 14:case 15:case 16: // semi_increment
							$aci = $prc['sys_tbl']['sys_table_pk_type_id'];
							$inc = 1;
							$whr = '';
							if(!empty($dat['pid']))
								$whr = "where pid = {$dat['pid']}";
							else
								$inc = str_replace('Semi Serial Inc ', '', $prc['sys_tbl']['sys_table_pk_type']) + 0;
							
							$sql = "select max(id) + $inc new_id from {$tbl} $whr";
							$dat['id'] = rst2Array($sql, 'cel');
							break;
					}
					
					$this->sys['ack']['err'] = !$this->db->insert($tbl, $dat);
					
					if(!$this->sys['ack']['err'] && $aci) {
						if($aci == 1) {
							$dat['id'] = $this->db->insert_id();
						}
						$cud['pky'] = json_encode(array('id' => $dat['id']), JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);

						$col = $tbl . '_id';
						
						$this->sys['req']['pst']['id'] = $dat['id'];
						$this->sys['req']['pst'][$col] = $dat['id'];
						$this->sys['bpm']['aux'][$col] = $dat['id'];
						
						switch ($tbl) {
							case 'dms_doc':
								$this->sys['bpm']['aux']['lcs_doc_id'] = $dat['id'];
								break;
								
							case 'wfs_task':
								$this->sys['svc']['wfs']['wfs_task_id'] = $dat['id'];
								break;
						}
					}
					
					if($this->sys['bpm']['cfg']['tree'])
						$this->util_db_upd_tree($tbl, $dat['id'], $dat['pid']);
					
					$cud['rows'] = 1;
				}
				break;

			case 'update' :
				$dbg = 0;
				$log = $prc['sys_aaa']['audit']['upd'];
				$tmp = array();
				$arc = array();
				$pev = null;
				$old = $this->db->get_where($tbl, $key)->result_array();
				if(isset($old[0]))
					$tmp = array_diff_assoc($dat, $old[0]);

				if($tmp) {
					$pev = $old[0]['event_id'];
					foreach($tmp as $k => $v)
						$arc[$k] = array('old' => $old[0][$k], 'new' => $v);
				}

				if(!isset($dat['event_id']))
					$dat['event_id'] = $this->sys['event']['id'];

				$cud = array('event_id' => $dat['event_id'], 'event_pid' => $pev, 'aud' => $aud, 'sys_table_id' => $tbl,
					'pky' => json_encode($key, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT),
					'dat' => json_encode($arc, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT), 'rows' => 0);
				$this->sys['ack']['err'] = !$this->db->update($tbl, $dat, $key);

				if($this->sys['bpm']['cfg']['tree'])
					$this->util_db_upd_tree($tbl, $dat['id'], $dat['pid']);
				
				$cud['rows'] = $this->db->affected_rows();
				break;
			case 'update_matrix':
				$dbg = 0;
				$prv = $this->db->get_where($tbl, $key);

				$ttt = array_keys($key);
				$pky = $ttt[0];
				$ttt = array_values(array_diff($prv->list_fields(), array($pky, 'event_id')));
				$clx = $ttt[0];
				if($prv->num_rows()) {
					foreach($prv->result_array() as $k => $v) {
						unset($v[$pky], $v['event_id']);
						$old[] = $v[$clx];
					}
					if($del = array_diff($old, $dat)) {
						foreach ($del as $k => $v) {
							$ttt = array_values($key);
							$this->sys_cmd_aud_exec('delete', $tbl, array($pky => $ttt[0], $clx => $v));
						}
					}
					
					if($ins = array_diff($dat, $old)) {
						foreach ($ins as $k => $v) {
							$ttt = array_values($key);
							$this->sys_cmd_aud_exec('insert', $tbl, array($pky => $ttt[0], $clx => $v));
						}
					}
				}
				else {
					foreach($dat as $k => $v) {
						$ttt = array_values($key);
						$dat[$k] = array($pky => $ttt[0], $clx => $v, 'event_id' => $this->sys['event']['id']);
					}
					
					$this->sys_cmd_aud_exec('insert_batch', $tbl, $dat);
				}
				break;

			case 'replace' :
				$dbg = 0;
				$old = $this->db->get_where($tbl, $key);
				$cud = array('aud' => $aud, 'sys_table_id' => $tbl,
					'pky' => json_encode($key, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT),
					'dat' => json_encode($old, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT), 'rows' => 0, 'event_id' => $this->sys['event']['id']);
				$this->sys['ack']['err'] = !$this->db->replace($tbl, $dat);
				/*
				if($old->num_rows() > 0 )
					$this->sys_cmd_aud_exec('update', $tbl, $dat, $key);
				else
					$this->sys_cmd_aud_exec('insert', $tbl, array_merge($dat, $key));
				*/
				
				break;

			case 'delete' :
				$dbg = 0;
				$log = $prc['sys_aaa']['audit']['del'];
				$key = $dat;
				$idx = array_keys($key);
				if(count($key) == 2 && is_array($key[$idx[1]])) {
					$this->db->where($idx[0], $key[$idx[0]]);
					$this->db->where_in($idx[1], $key[$idx[1]]);
					$rst = $this->db->get($tbl);
				}
				else
					$rst = $this->db->get_where($tbl, $key);

				if($rst->num_rows()) {
					try {
						$dtx = $rst->result_array();
						$cud = array('aud' => $aud, 'sys_table_id' => $tbl,
							'pky' => json_encode($key, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT),
							'dat' => json_encode($dtx, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT), 'rows' => 0, 'event_id' => $this->sys['event']['id']);
						if(count($key) == 2 && is_array($key[$idx[1]])) {
							$this->db->where($idx[0], $key[$idx[0]]);
							$this->db->where_in($idx[1], $key[$idx[1]]);
							$this->sys['ack']['err'] = !$this->db->delete($tbl);
						}
						else
							$this->sys['ack']['err'] = !$this->db->delete($tbl, $key);
						$cud['rows'] = $this->db->affected_rows();

						foreach($dtx as $k=>$v)
							if(isset($v['path']) && !preg_match('/^http/', $v['path']))
								@unlink($v['path']);

					}
					catch(Exception $e) {
						$err_no  = $this->db->_error_number();
						$err_msg = $this->db->_error_message();
					}
				}
				break;

			case 'error' :
				$sql = "select is_active from aaa_audit_trail where id = 'error'";
				$log = $this->util_db_sql($sql, 'cel') ? 1 : 0;
				$dtx = array('sys_response_code_id' => $tbl);
				if($log)
					$this->sys['ack']['err'] = !$this->db->update('event', $dtx, array('id'=>$this->sys['event']['id']));
				break;
		}
		if($dbg)
			echo $this->db->last_query() . '<br /><br />';

		if($this->sys['ack']['err']) {
			if(!$this->sys['event']['is_log'])
				$this->sys_cmd_aud_exec('event');
			else {
				$this->db->update('event', array('sys_response_code_id' => $this->sys['event']['sys_response_code_id']), array('id' => $this->sys['event']['id']));
				if ($err_no)
					$err_cls = 'HTTP Error';
				$this->db->insert('event_error', array('error_class' => $err_cls, 'error_no' => $err_no, 'message' => $err_msg, 'event_id' => $this->sys['event']['id']));
			}
		}
		else {
			if($log && $cud && in_array($aud, array('insert','insert_batch','update','delete'))) {
				$this->db->insert('event_crud', $cud);
			}
		}
	}
	protected   function sys_cmd_aud_replace($tbl, $dat) {
		$pky = $this->sys_var('tbl_pky', $tbl);

		$pid = $this->util_escape($this->sys['req']['pid']);
		$dat = is_array($dat) ? $dat : array($dat);
		$rlx = implode(',', $dat);
		$tbf = $tbl;
		$sql = "select $pky[1] from $tbf where $pky[0] = $pid and $pky[1] not in ($rlx)";
		
		if($del = $this->util_db_sql($sql)) {
			foreach ($del as $k => $v) {
				foreach ($dat as $x => $y)
					if ($y == $v[$pky[1]])
						unset($dat[$x]);
				if (!$this->sys['ack']['err'])
					$this->sys_cmd_aud_exec('delete', $tbl, array($pky[0] => $this->sys['req']['pid'], $pky[1] => $v[$pky[1]]));
			}
		}
		
		if(!$this->sys['ack']['err'] && $dat) {
			$rlx = implode(',', $dat);
			$sql = "select $pky[1] from $tbf where $pky[0] = $pid and $pky[1] in ($rlx)";
			if($old = $this->util_db_sql($sql))
				foreach($old as $k => $v) {
					foreach($dat as $x => $y)
						if($y == $v[$pky[1]])
							unset($dat[$x]);
				}
		}
		if(!$this->sys['ack']['err'] && $dat)
			foreach($dat as $k => $v)
				$this->sys_cmd_aud_exec('insert', $tbl, array($pky[0] => $pid, $pky[1] => $v));
	}
	private     function sys_cmd_aud_add() {
		$pre = $this->sys['bpm']['sfn']['pre'];
		$xtd = $this->sys['bpm']['sfn']['xtd'];
		
		foreach($this->sys['req']['pst'] as $k=>$v)
			if($v=='')
				unset($this->sys['req']['pst'][$k]);

		// check if file is uploaded
		if(isset($this->sys['req']['pst']['dms_catalog_id']))
			if((isset($this->sys['req']['pst']['path']) && $this->sys['req']['pst']['path']) || (isset($this->sys['req']['pst']['img_eom']) && $this->sys['req']['pst']['img_eom']))
				$this->util_upl_eom();
			else
				unset($this->sys['req']['pst']['path']);
		
		if(method_exists($this, $pre))
			$this->$pre();
		else
			$this->sys_cmd_add_pre();
		
		$tbl = $this->sys['bpm']['tbl'];
		if(!$this->sys['ack']['err'] && $this->sys['bpm']['cfg']['tbm']) {
			$dta = $this->util_parser_add($tbl);
			$this->sys_cmd_aud_exec('insert', $tbl, $dta);
		}

		if(!$this->sys['ack']['err']) {
			$this->sys_cmd_add_xtd();
			if(method_exists($this, $xtd))
				$this->$xtd();
			else
				$this->sys_cmd_add_xtd();

			// check if this process should create task
			if(isset($this->sys['req']['pst']['new_task']) && !isset($this->sys['req']['pst']['wfs_task_id']))
				$this->util_wfs_task('new_task');
		}
	}
	private     function sys_cmd_aud_upd() {
		$pre = $this->sys['bpm']['sfn']['pre'];
		$xtd = $this->sys['bpm']['sfn']['xtd'];
		
		// check if file is uploaded
		if(isset($this->sys['req']['pst']['dms_catalog_id'])) {
			if (isset($this->sys['req']['pst']['path']) && $this->sys['req']['pst']['path'])
				$this->util_upl_eom();
			else
				unset($this->sys['req']['pst']['path']);
		}
		
		
		if(method_exists($this, $pre))
			$this->$pre();
		else
			$this->sys_cmd_upd_pre();
		
		$tbl = $this->sys['bpm']['tbl'];
		if(!$this->sys['ack']['err'] && $this->sys['bpm']['cfg']['tbm']) {
			$key = $this->sys_var('tbl_pky', $tbl, $this->sys['req']['pst']);
			$xyz = $this->util_parser_upd($tbl);

			foreach($key as $k => $v)
				unset($xyz[$k]);

			if($xyz)
				$this->sys_cmd_aud_exec('update', $tbl, $xyz, $key);
		}
		
		if(!$this->sys['ack']['err'])
			if(method_exists($this, $xtd))
				$this->$xtd();
			else
				$this->sys_cmd_upd_xtd();
	}
	private     function sys_cmd_aud_del() {
		$pre = $this->sys['bpm']['sfn']['pre'];
		$xtd = $this->sys['bpm']['sfn']['xtd'];
		
		$tbl = $this->sys['bpm']['tbl'];
		$this->sys['bpm']['cfg']['ccd'] = $this->util_db_qry('sys_table', $tbl, 'is_cascade_del');
		
		if(method_exists($this, $pre))
			$this->$pre();
		else
			$this->sys_cmd_del_pre();
		
		if(!$this->sys['ack']['err'] && $this->sys['bpm']['cfg']['tbm']) {
			// if($lnk = $this->util_db_check_dependency($tbl, $this->sys['req']['pid'])) {
			if($lnk = $this->util_db_check_delete($tbl, $this->sys['req']['pid'])) {
				// cascade delete
				if($this->sys['bpm']['cfg']['ccd']) {
					foreach($lnk as $k => $v) {
						try {
							$this->sys['ack']['err'] = $this->sys_cmd_aud_exec('delete', $v['tbl'], array($v['col'] => $this->sys['req']['pst']['id']));
						}
						catch(Exception $e) {
							$this->sys['ack']['err'] = false;
							$this->sys['ack']['msg'] = implode(', ', array_column($lnk, 'tbl'));
						}
					}
				}
				if(!$this->sys['ack']['err'] || !$this->sys['bpm']['cfg']['ccd']) {
					// exception if linked tables only matrix-table
					$ida = implode("','", array_column($lnk, 'tbl'));
					$sql = "select group_concat(sys_table separator ', ') tbl from sys_table where id in ('$ida') and sys_table_type_id not between 20 and 29";
					$rst = rst2Array($sql, 'cel');
					if($rst) {
						$this->sys['ack']['err'] = false;
						$this->sys['ack']['msg'] = $rst;
					}
					else {
						foreach($lnk as $k => $t)
							$this->sys['ack']['err'] = $this->sys_cmd_aud_exec('delete', $t['tbl'], $this->sys_var('tbl_pky', $t['tbl'], $this->sys['req']['pst']));
					}
					$lnk = null;
				}
				else
					$lnk = null;
			}

			if(!$this->sys['ack']['err'] && !$lnk)
				$this->sys['ack']['err'] = $this->sys_cmd_aud_exec('delete', $tbl, $this->sys_var('tbl_pky', $tbl, $this->sys['req']['pst']));
		}
		if(!$this->sys['ack']['err'])
			if(method_exists($this, $xtd))
				$this->$xtd();
			else
				$this->sys_cmd_del_xtd();
	}
	
	public      function sys_cmd_upl() {
		if(method_exists($this, 'bpm_upl'))
			$this->bpm_upl();
		
		$this->util_wfs_task('inq_task');

		if(!$this->sys['ack']['err']) {
			switch($this->sys['bpm']['aux']['cmd']) {
				case 'tpl':
					$row = 0;
					$sql = '';
					$tbl = $this->sys['bpm']['aux']['tbl'];
					
					switch($tbl) {
						case 'dms_doc_path':
							if($this->sys['req']['pid'] == $this->sys['req']['fid']) {
								$row = 1;
								$whr = "a.id = {$this->sys['req']['pid']}";
							}
							else
								$whr = "dms_doc_id = {$this->sys['req']['pid']}";
							
							$this->sys['rsp']['map'] = array();
							$dat                     = $this->util_db_qry($this->sys['bpm']['tbl'], $this->sys['req']['pid']);
							
							$sql = "select distinct dir_map_ixd ixd from sys_dir_map";
							foreach(rst2Array($sql) as $k => $v) {
								foreach(explode(',', $v['ixd']) as $x => $y) {
									$map[$y] = null;
								}
							}
							foreach($map as $x => $y) {
								if(isset($dat[$x]))
									$this->sys['rsp']['map'][$x] = $dat[$x];
							}
							
							$sql = "select  a.*, dms_doc, '' filename, icon
									from    {$tbl} a
									join    dms_media_type    b on b.id = a.dms_media_type_id and b.is_active = 1
									join    dms_doc          c on c.id = a.dms_doc_id and c.is_active = 1
									where   $whr";
							break;
					}
					
					if($this->sys['rsp']['dat'] = $this->util_db_sql($sql))
						foreach($this->sys['rsp']['dat'] as $k => $v) {
							$tmp                                     = pathinfo($v['path']);
							$this->sys['rsp']['dat'][$k]['filename'] = str_replace(array('_', '.'), ' ', $tmp['filename']);
						}
					
					// special treatment
					if($row)
						$this->sys['rsp']['dat'] = $this->sys['rsp']['dat'][0];
					break;
				
				case 'path':
					$sql = "select  dms_doc, a.path
							from    {$this->sys['bpm']['aux']['tbl']} a
							 join   dms_doc b on b.id = a.dms_doc_id
							where   a.id = {$this->sys['req']['pid']}";
					$rst = $this->util_db_sql($sql, 'row');
					$this->sys['bpm']['aux']['dms_doc']   = $rst['dms_doc'];
					$this->sys['bpm']['aux']['path']       = $rst['path'];
					$this->sys['bpm']['aux']['viewer_id']  = $this->util_upl_inf('dms_media_viewer', strtolower(pathinfo($this->sys['bpm']['aux']['path'], PATHINFO_EXTENSION)));
					$this->sys['bpm']['aux']['portlet']    = true;
					break;
				
				case 'del_paths':
				case 'del_path':
					$tbl  = $this->sys['bpm']['aux']['tbl'];
					$file = $this->util_db_qry($tbl, $this->sys['req']['pid'], 'path');
					
					if($this->sys['bpm']['aux']['cmd'] == 'del_paths')
						$this->sys_cmd_aud_exec('delete', $tbl, array('id' => $this->sys['req']['pid']));
					else
						$this->sys_cmd_aud_exec('update', $tbl, array('path' => null), array('id' => $this->sys['req']['pid']));
					
					$this->sys['rsp']['dat'] = $this->db->affected_rows() ? $file : 'error';
					break;
				
				case 'upd_paths':
				case 'upd_path':
					$tbl = $this->sys['req']['pst']['tbl'];
					if($tbl == 'dms_doc_path') {
						$dat                           = array('dms_doc_id' => $this->sys['req']['pid'], 'path' => $this->sys['rsp']['dat']['path'], 'dms_media_type_id' => $this->sys['rsp']['dat']['dms_media_type_id']);
						$this->sys['rsp']['dat']['id'] = $this->sys_cmd_aud_exec('insert', $tbl, $dat);
					}
					else {
						$this->sys['ack']['err'] = $this->sys_cmd_aud_exec('update', $tbl, array('path' => $this->sys['rsp']['dat']['path']), array('id' => $this->sys['req']['pid']));
					}
					break;
			}
		}

		// check if this process should update task_stage
		if(!empty($this->sys['svc']['wfs_task_id']))
			$this->util_wfs_task('upd_task_stage_prog');

		// check this process should send notification
		if(!empty($this->sys['svc']['ntf_catalog_id']))  {
			$ntf = $this->sys['svc']['ntf_catalog_id'] == 1 ? 'sys' : $this->sys['svc']['ntf_catalog_id'];
			$this->util_ntf_init($ntf);
		}
	}
	
	protected   function util_escape($v, $escape = true) {
		if($escape) {
			return is_numeric($v) ? $v : $this->db->escape($v);
		}
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
 
	protected   function util_tbl_pky($tbl, $dat=null) {
		$jsd = $this->sys_var('tbl_prop', $tbl);
		$pky = explode(',', trim($jsd['sys_table_pk']));
		$pkf = array_flip($pky);
		$out = array();
		
		// first, find in supplied data
		if($dat && is_array($dat)) {
			$out = array_intersect_key($dat, $pkf);
			if($out)
				return $out;
		}
		
		// second, find in rsp-dat
		if ($this->sys['rsp']['dat']) {
			$out = array_intersect_key($this->sys['rsp']['dat'], $pkf);
			if($out)
				return $out;
		}
		
		// third. find in qp_arr
		if ($this->sys['bpm']['qp_arr'] && is_array($this->sys['bpm']['qp_arr'])) {
			$out = array_intersect_key($this->sys['bpm']['qp_arr'], $pkf);
			if($out)
				return $out;
		}
		
		// last, via url-string
		switch (count($pky)) {
			case 1:
				$out = array($this->sys['req']['pid']);
				break;
			case 2:
				$out = array($this->sys['req']['pid'], $this->sys['req']['fid']);
				break;
			case 3:
				$out = array($this->sys['req']['pid'], $this->sys['req']['fid'], $this->sys['req']['xid']);
				break;
			case 4:
				$out = array($this->sys['req']['pid'], $this->sys['req']['fid'], $this->sys['req']['xid'], $this->sys['req']['yid']);
				break;
			case 5:
				$out = array($this->sys['req']['pid'], $this->sys['req']['fid'], $this->sys['req']['xid'], $this->sys['req']['yid'], $this->sys['req']['zid']);
				break;
		}
		foreach($pky as $k=>$v)
			$pkf[$v] = $out[$k];
		return array_filter($pkf);
	}
	protected   function util_tbl_col2id($tbl, $col, $val=null) {
		$tbl = is_numeric($tbl) ? $this->sys['bpm']['tbl'] : $tbl;
		if(is_array($col))
			$whr = $this->util_parser_var_sys($col);
		else {
			if($col && !$val) {
				$val = $col;
				$col = $tbl;
			}
			$whr = "and $col = $val";
		}
		$sql = "select id from {$tbl} where 1=1 $whr";
		return $this->util_db_sql($sql, 'cel');
	}
	private     function util_tbl_idx2name($tbl, $col, $fxc=null) {
		switch($tbl) {
			case 'aaa_acm':
			case 'aaa_account':
				$fxc = $fxc ? $fxc : $tbl;
				$sql = "select  group_concat($fxc) $tbl
						from    {$tbl}
						where   id in ($col)";
				break;
		}
		return $this->util_db_sql($sql, 'cel');
	}
	
	protected   function util_db_qry($tbl, $pid=null, $col='*', $def=false) {
		$whr = '';
		if($pid)
			if(is_array($pid))
				$whr = $this->util_parser_var_sys($pid);
			else {
				$pid = $this->util_escape($pid);
				$whr = "and id = $pid";
			}

		$sql = "select $col from {$tbl} where is_active = 1 $whr";

		if(!$pid || $col == '*' || preg_match('/,/', $col))
			$scp = 'all';
		else
			$scp = 'cel';

		$rst = $this->util_db_sql($sql, $scp, $def);
		return isset($rst[1]) ? $rst : $rst[0];
	}
	protected   function util_db_sql($sql) {
		$out = null;
		$whr = null;
		$scp = 'all';
		$opt = 'none';
		$prm = func_get_args();
		
		if(!empty($prm[1]) && is_array($prm[1]))
			$whr = $prm[1];
		
		if(!empty($prm[1])) {
			if(is_string($prm[1]))
				$scp = $prm[1];
			elseif(isset($prm[2]))
				$scp = $prm[2];
		}
		if(!empty($prm[2])) {
			if(is_string($prm[1]))
				$opt = $prm[2];
			elseif (isset($prm[3]))
				$opt = $prm[3];
		}
		if(preg_match('/req__(pid|fid|xid|yid|zid)/', $sql))
			dump($sql, '#');
		else {
			$rst = $whr ? $this->db->query($sql, $whr) : $this->db->query($sql);
			$err = $this->db->error();
			if (isset($err['code']) && $err['code']) {
				if (ENVIRONMENT != 'production')
					dump($sql, $err, 'trace');
			}
			else {
				if($rst) {
					$tot = $rst->num_rows();
					$dat = $rst->result_array();
					$rst->free_result();
					if ($tot > 0) {
						switch ($scp) {
							case "cel":
								$key = array_keys($dat[0]);
								$out = $dat[0][$key[0]];
								break;
							case "row":
								$out = $dat[0];
								break;
							case "all":
								$out = $dat;
								break;
						}
						unset($dat);
					}
					switch ($opt) {
						case "all":
							foreach ($this->db->query($sql)->list_fields() as $f)
								$fields[$f] = null;
							foreach ($this->db->query($sql)->field_data() as $m)
								$meta[$m] = null;
							$out = array('dat' => $out, 'tot' => $tot, 'fields' => $fields, 'meta' => $meta);
							break;
						case 'sql':
							$out = $sql;
							break;
						case "#":
							dump($out);
							break;
						
						case 'null':
						case 'void':
						case is_numeric($opt):
							if (!$tot)
								foreach ($this->db->query($sql)->list_fields() as $f) {
									if ($opt == 'void' || $opt == 'null')
										$out[$f] = $opt == 'null' ? null : '';
									elseif (is_numeric($opt))
										$out[$f] = $opt;
								}
							break;
						
					}
				}
			}
		}
		return $out;
	}
	protected   function util_db_sql_orderby($p=null) {
		// $p : prefix
		$order = $p ? "concat(lpad(ifnull($p.pid, $p.id), 10, '0'), lpad($p.id, 10, '0'))" : "concat(lpad(ifnull($p.pid, $p.id), 10, '0'), lpad($p.id, 10, '0'))";
		return $order;
	}
	protected   function util_db_sql_magic($tbl, $cfg = null, $join = false) {
		$all = 0; // include active & disabled
		$A   = array(
				'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
				'cc', 'cd', 'ce', 'cf', 'cg', 'ch', 'ci', 'cj', 'ck', 'cl', 'cm', 'cn', 'co', 'cp', 'cq', 'cr', 'cs', 'ct', 'cu', 'cv', 'cw', 'cx', 'cy', 'cz',
			);
		$i   = 0;
		$J   = '';
		$F   = '';
		$W   = '';
		$C   = array();
		$L   = array();
		$G   = array('qp_str' => '', 'ord' => '', 'off' => '');

		$cfg['is_active']   = isset($cfg['is_active']) ? $cfg['is_active'] : 1;
		$cfg['mgc']         = isset($cfg['mgc']) ? $cfg['mgc'] : 0;
		
		if(!empty($cfg['frm'])) {
			if($this->sys['req']['pid'])
				$F = parser_whr($this->util_tbl_pky($tbl));
		}
		elseif(isset($cfg['esa'])) {
			$F = parser_whr($cfg['esa']);
		}
		else {
			$W = 'where 1=1';
			
			if (isset($cfg['qp_arr'])) {
				if ($cfg['qp_arr'] == 1) {
					// from: sys_cmd_inq_std (lst)
					$G['qp_str'] = $this->sys['bpm']['qp_str'];
					$G['ord'] = $this->sys['bpm']['ord'];
					$G['off'] = $this->sys['bpm']['off'];
					
					if ($this->sys['req']['pid'] != 'new') {
						$Z = $this->util_escape($this->sys['req']['pid']);
						$t = $this->util_tbl_pky($tbl);
						$F = $this->sys['req']['pid'] ? "and id = $Z" : '';
					}
				}
				else {
					$G['qp_str'] = $this->util_parser_var_sys($cfg['qp_arr']);
					if (isset($cfg['ord']))
						$G['ord'] = $cfg['ord'];
					if (isset($cfg['off']))
						$G['off'] = $cfg['off'];
				}
			}
			
			if (isset($cfg['sp_arr']) || isset($cfg['sp_str'])) {
				if (!empty($cfg['sp_arr'])) {
					$G['qp_str'] .= $this->util_parser_var_sys($cfg['sp_arr']);
				}
				
				if (isset($cfg['sp_str']) && $cfg['sp_str']) {
					if ($cfg['sp_str'] == '#all') {
						$cfg['sp_str'] = '';
						$all = 1;
					}
					$G['qp_str'] .= $cfg['sp_str'];
				}
				
				if (isset($cfg['ord']))
					$G['ord'] = $cfg['ord'];
				
				if (isset($cfg['off']))
					$G['off'] = $cfg['off'];
			}
		}

		if(!$G['ord'] && isset($cfg['ord']))
			$G['ord'] = $cfg['ord'];

		if($G['ord'] == 'order by id')
			$G['ord'] = 'order by 1';
		
		if($G['ord'] && !preg_match('/order/', $G['ord']))
			$G['ord'] = "order by {$G['ord']}";
		
		//if($tbl['is_tim'] || $cfg['mgc'])
			$join = true;

		$tbx = $tbl;
		$tbl = $tbl;
		$col = '';
		$K   = $this->db->list_fields($tbl);

		if(in_array('id', $K)) {
			if(in_array($this->sys['prc']['sys_tbl']['sys_table_type_id'], range(90, 93))) {
			// if(preg_match('/^(vap|vws)/', $tbx)) {
				$col = substr($tbx, 4);
				$K[] = $col.'_id';
			}
			else {
				$col = $tbx;
				$K[] = $col.'_id';
			}
		}

		foreach($K as $fo) {
			if($fo != $col.'_id' && $fo != 'event_id' && substr($fo, -3) == '_id' && preg_match('/(_id$)/', $fo)) {
				$al = $A[$i++];
				$tn = $cn = substr($fo, 0, strlen($fo) - 3);
				$ts = $tn;
				$bi = false;
				if($join) {
					foreach($this->db->list_fields($ts) as $fx) {
						if($fx == 'is_active')
							$bi = true;

						if($fx == 'pid') {
							$C[] = "$al.pid {$tn}_pid";
							$C[] = "$al.{$tn} {$tn}_parent";
						}
						elseif($fx == 'id_code')
							$C[] = "$al.id_code {$tn}_code";
						elseif(!in_array($fx, array('id', $tbx.'_id', 'is_active', 'event_id')) && !in_array($fx, $K) && !in_array($fx, $L)) {
							$L[] = $fx;
							$C[] = "$al.$fx";
						}
					}
				}
				else {
					$C[] = $cn;
				}

				$J .= " left join $ts $al on $al.id = a.$fo";
				if($bi)
					$J .= " and $al.is_active > 0";
			}
		}

		// note: clause 2=2 can be used as backdoor in post sql builder
		if($J) {
			$C = implode(', ', $C);
			if(!$all && isset($K['is_active']))
				$W .= " and a.is_active = {$cfg['is_active']}";

			if(isset($cfg['tot'])) {
				$sql[0] = "select count(*) from ( select a.*, $C from $tbl a $J $W) xz where 1=1 $F {$G['qp_str']} and 2=2";
				$sql[1] = "select * from ( select a.*, $C from $tbl a $J $W) xz where 1=1 $F {$G['qp_str']} and 2=2 {$G['ord']} {$G['off']}";
			}
			else
				$sql = "select * from ( select a.*, $C from $tbl a $J $W) xw where 1=1 $F {$G['qp_str']} and 2=2 {$G['ord']} {$G['off']}";
		}
		else {
			if($all)
				$W = 'where 1=1';
			else
				$W = $cfg['is_active'] ? 'where is_active > 0' : 'where 1=1';
			if(isset($cfg['tot'])) {
				$sql[0] = "select count(*) from $tbl $W $F {$G['qp_str']} and 2=2";
				$sql[1] = "select * from $tbl $W $F {$G['qp_str']} and 2=2 {$G['ord']} {$G['off']}";
			}
			else
				$sql = "select * from $tbl $W $F {$G['qp_str']} and 2=2 {$G['ord']} {$G['off']}";
		}

		return $sql;
	}
	
	private     function util_db_upd_tree($tbl, $id, $pid) {
		if($pid) {
			$tbl  = $tbl;
			$rid  = null;
			$tree = 1;
			$sql  = "select id, pid, rid, tree + 1 tree from $tbl where id = $pid and is_active = 1";
			if($rst = $this->util_db_sql($sql, 'row')) {
				$tree = $rst['tree'];
				$rid  = $rst['rid'] ? $rst['rid'] : $pid;
			}
			
			$this->db->update($tbl, array('rid' => $rid, 'tree' => $tree), array('id' => $id));
		}
	}
	protected   function util_db_matrix_flatted($tbl, $col, $idc, $idv) {
		$out = array();
		$idv = $this->util_escape($idv);
		$sql = "select $col from {$tbl} where $idc = $idv";

		if($tmp = $this->util_db_sql($sql)) {
			foreach ($tmp as $k => $v)
				$out[$k] = $v[$col];
		}
		return $out;
	}
	
	private     function util_db_check_dependency($tbl, $idx=0) {
		$out = array();
		$idx = $idx ? $idx : $this->sys['req']['pid'];
		if(is_string($idx))
			$idx = addslashes($idx);
		$sdb = 'wyeth_db';
		
		$this->db->simple_query('set session group_concat_max_len=10000');
		
		$sql = "select  group_concat(concat('select \"', b.table_name, '\" tbl, \"', a.for_col_name, '\" col from ', b.constraint_schema, '.', b.table_name, ' where ', a.for_col_name, ' = $idx') separator ' union ') str
				from 	information_schema.innodb_sys_foreign_cols a,
						information_schema.referential_constraints b
				where	b.referenced_table_name     = '$tbl'
				and     b.unique_constraint_schema  = '$sdb'
				and     a.id = concat(constraint_schema, '/', b.constraint_name)";

		if($sql  = $this->util_db_sql($sql, 'cel'))
			$out = $this->util_db_sql($sql);
		
		return $out;
	}
	private     function util_db_check_delete($tbl, $idx=0) {
		$out = array();
		$idx = $this->util_escape($idx);
		$sql = "select  concat(sys_table_for_sc, '.', sys_table_for_id) tbf, sys_table_for_id tbl, sys_table_for_pk pky
				from    sys_table__foreign
				where   sys_table_par_id = '$tbl'";
		if($rst = $this->util_db_sql($sql)) {
			foreach($rst as $k=>$v)
				$str[] = "select '{$v['tbl']}' tbl, '{$v['pky']}' col from {$v['tbf']} where {$v['pky']} = $idx";

			$out = $this->util_db_sql(implode(' union ', $str));
		}
		return $out;
	}
	
	protected   function util_wfs_task ($act) {
		if(isset($this->sys['svc']['wfs_catalog_id'])) {
			if(!isset($this->wfs)) {
				$this->load->model('MM_SVC_WFS', 'wfs');
				$this->wfs->sync($this->sys);
			}
			return $this->wfs->bpm_wfs_task($act);
		}
	}
	
	protected   function util_parser_add($tbl, $dat = null) {
		$xyz = array();
		$pst = $dat ? $dat : $this->sys['req']['pst'];
		$prf = rst2ID(object2array($this->db->field_data($tbl)), 'name');
		
		foreach($this->db->list_fields($tbl) as $f) {
			$is_num  = preg_match('/int$/',  $prf[$f]['type']) ? 1 : 0;
			if(isset($pst[$f])) {
				if (in_array($f, array('sex')) || preg_match('/^(is_|has_)/', $f))
					$pst[$f] = $pst[$f] ? 1 : 0;
				elseif (preg_match('/date$/', $prf[$f]['type']))
					$pst[$f] = $pst[$f] ? date_iso8601($pst[$f]) : null;
				
					switch($f) {
						case 'tree':
							$this->sys['bpm']['cfg']['tree'] = 1;
							break;
					}
			
			
				// $xyz[$f] = is_array($pst[$f]) ? implode(',', $pst[$f]) : $pst[$f];
				if(is_array($pst[$f])) {
					foreach($pst[$f] as $k => $v)
						$pst[$f][$k] = $is_num ? var_cast($v) : strtoupper($v);
					$xyz[$f] = implode(',', $pst[$f]);
				}
				else {
					$xyz[$f] = $pst[$f] === '' || is_null($pst[$f]) ? null : ($is_num ? var_cast($pst[$f]) : strtoupper($pst[$f]));
				}
			}
		}
		
		return $xyz;
	}
	protected   function util_parser_upd($tbl, $dat=null) {
		$xyz = array();
		$pst = $dat ? $dat : $this->sys['req']['pst'];
		$prf = rst2ID(object2array($this->db->field_data($tbl)), 'name');
		
		foreach($this->db->list_fields($tbl) as $f) {
			$is_num = preg_match('/int$/', $prf[$f]['type']) ? 1 : 0;
			if(in_array($f, array('sex')) || preg_match('/^(is_|has_)/', $f))
				$pst[$f] = isset($pst[$f]) && $pst[$f] ? 1 : 0;
			elseif (preg_match('/date$/', $prf[$f]['type']))
				$pst[$f] = isset($pst[$f]) && $pst[$f] ? date_iso8601($pst[$f]) : null;
			switch($f) {
				case 'tree':
					$this->sys['bpm']['cfg']['tree'] = 1;
					break;
			}
			
			if(isset($pst[$f])) {
				if(is_array($pst[$f])) {
					foreach($pst[$f] as $k => $v)
						$pst[$f][$k] = $is_num ? var_cast($v) : strtoupper($v);
					$xyz[$f] = implode(',', $pst[$f]);
				}
				else {
					$xyz[$f] = $pst[$f] === '' || is_null($pst[$f]) ? null : ($is_num ? var_cast($pst[$f]) : strtoupper($pst[$f]));
				}
			}
		}
		
		return $xyz;
	}
	
	protected   function util_parser_var_sys(&$arg, $whr = true) {
		$__mapper = function ($v) {
			$s = preg_split('/ /', $v);
			foreach($s as $i=>$j) {
				if(preg_match('/__/', $j)) {
					$p = explode('__', $j);
					if ($j != $p[0]) {
						$r = '';
						switch (count($p)) {
							case 2:
								if (isset($this->sys[$p[0]][$p[1]]))
									$r = $this->sys[$p[0]][$p[1]];
								break;
							
							case 3:
								if (isset($this->sys[$p[0]][$p[1]][$p[2]]))
									$r = $this->sys[$p[0]][$p[1]][$p[2]];
								break;
							
							case 4:
								if (isset($this->sys[$p[0]][$p[1]][$p[2]][$p[3]]))
									$r = $this->sys[$p[0]][$p[1]][$p[2]][$p[3]];
								break;
							
							case 5:
								if (isset($this->sys[$p[0]][$p[1]][$p[2]][$p[3]][$p[4]]))
									$r = $this->sys[$p[0]][$p[1]][$p[2]][$p[3]][$p[4]];
								break;
						}
						$v = str_replace($j, $r, $v);
					}
				}
			}
			return $v;
		};
		
		if(is_string($arg))
			$arg = json_decode($arg, true);
		
		if(is_array($arg)) {
			foreach ($arg as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $x => $y) {
						if(preg_match('/__/', $y))
							$arg[$k][$x] = $__mapper($y);
					}
				}
				else {
					if(preg_match('/__/', $v)) {
						$arg[$k] = $__mapper($v);
					}
				}
			}
			
			if ($whr)
				return parser_whr($arg);
		}
	}
	protected   function util_parser_var_dat($cfg, &$dat=null) {
		// json string or assosiate array
		if(is_string($cfg))
			$cfg = json_decode($cfg, true);
 
		if($cfg && is_array($cfg)) {
			foreach($cfg as $k=>$v) {
				if(is_array($v)) {
					foreach($v as $x => $y) {
						if(isset($dat[$x]) && $dat[$x])
							$cfg[$k][$x] = $dat[$x];
						elseif(preg_match($this->reg_dat, $y, $m)) {
							$var = null;
							$opr = '';
							$idx = trim(str_replace($m[0], '', $y));

							$this->util_parser_map_dat($m[1], $var, $dat);
							if(preg_match($this->reg_opr, $idx)) {
								$opr = explode(' ', $idx);
								$idx = end($opr);
								$opr = implode(' ', array_pop($opr));
							}

							$val = $this->util_parser_map_val($idx, $var);
							$cfg[$k][$x] = "$opr $val";
							unset($var);
						}
						elseif (preg_match($this->reg_opr, $y)) {
							$opr = explode(' ', trim($y));
							$idx = end($opr);
							$opr = implode(' ', array_pop($opr));
							$val = $this->util_parser_map_val($idx);
							$cfg[$k][$x] = "$opr $val";
						}
						else {
							$val = $this->util_parser_map_val($y);
							$cfg[$k][$x] = $val;
						}
					}
				}
				else {
					if(!is_numeric($v) && !is_bool($v)) {
						if(isset($dat[$k]) && $dat[$k] != $v)
							$cfg[$k] = $dat[$k];
						elseif(preg_match($this->reg_dat, $v, $m)) {
							$var = null;
							$opr = '';
							$idx = trim(str_replace($m[0], '', $v));

							$this->util_parser_map_dat($m[1], $var, $dat);
							if(preg_match($this->reg_opr, $idx)) {
								$opr = explode(' ', $idx);
								$idx = end($opr);
								$opr = implode(' ', array_pop($opr));
							}

							$val     = $this->util_parser_map_val($idx, $var);
							$cfg[$k] = "$opr $val";
							unset($var);
						}
						elseif(preg_match($this->reg_opr, $v)) {
							$opr     = explode(' ', trim($v));
							$idx     = end($opr);
							$opr     = implode(' ', array_pop($opr));
							$val     = $this->util_parser_map_val($idx);
							$cfg[$k] = "$opr $val";
						}
						else {
							$val     = $this->util_parser_map_val($k);
							$cfg[$k] = $k == $val ? $v : $val;
						}
					}
				}
			}
		}

		return $cfg;
	}
	protected   function util_parser_cfg_key_str($cfg, &$dat=null) {
		// comma delimeter string or assosiate array
		if(is_string($cfg))
			$cfg = array_fill_keys(explode(',', trim($cfg)), null);
		return $this->util_parser_var_dat($cfg, $dat);
	}
	protected   function util_parser_cfg_key_whr($arg, &$dat=null) {
		// json string or assosiate array
		if(is_string($arg))
			$arg = json_decode($arg, true);

		$whr = '';
		if($arg && is_array($arg)) {
			foreach($arg as $k=>$v) {
				if(is_array($v)) {
					foreach($v as $x => $y) {
						$p = strlen($x) > 3 ? preg_replace('/_id$/', '_pid', $x) : $x;
						if (isset($dat[$k]) && isset($dat[$p]))
							$arg[$k][$x] = "($x = $y or $p = $y)";
					}
				}
				else {
					$p = strlen($k) > 3 ? preg_replace('/_id$/', '_pid', $k) : $k;
					if (isset($dat[$k]) && isset($dat[$p]))
						$arg[$p] = $v;
				}
			}
			
			$arg = $this->util_parser_var_dat($arg, $dat);
			
			if($arg)
				foreach($arg as $k=>$v) {
					if(is_array($v))
						foreach($v as $f=>$x)
							$whr .= parser_whr_xtd($f, $x);
					else
						$whr .= parser_whr_xtd($k, $v);
				}
		}
		return $whr;
	}
	
	protected   function util_parser_map_val($val, &$dat=null) {
		if($val && !is_numeric($val) && !is_bool($val)) {
			if(isset($dat[$val]) && $dat[$val])
				$val = $dat[$val];
			elseif(isset($this->sys['rsp']['dat'][$val]) && $this->sys['rsp']['dat'][$val])
				$val = $this->sys['rsp']['dat'][$val];
			else {
				foreach($this->sys as $sub => $var)
					if(isset($var[$val])) {
						$val = $var[$val];
						break;
					}
			}
		}
		return $val;
	}
	private     function util_parser_map_dat($map, &$var, &$dat) {
		if($map == 'dat')
			$var = $dat;
		elseif(substr($map, 0, 3) == 'ref') {
			$ref = str_replace('ref_', '', $map);
			$var = $this->sys['rsp']['ref'][$ref];
		}
		elseif($map == 'rsp' || $map=='rsp__dat')
			$var = $this->sys['rsp']['dat'];
		else {
			$map = str_replace('sys_', '', $map);
			$var = $this->sys[$map];
		}
	}
	
	protected   function dump() {
		if($this->sys['usr']['is_super'] && $this->sys['usr']['is_debug']) {
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
