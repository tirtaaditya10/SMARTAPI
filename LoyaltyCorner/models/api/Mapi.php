<?php if (!defined ('BASEPATH')) die ();

class Mapi extends CI_Model {
	public		function __construct() {
		parent::__construct ();
		$this->ori 		= $this->load->database('svr_ori', true);
		// $this->prd 		= $this->load->database('svr_prd', true);
		$this->receipt_status   = array(
			'Pending for Review',
			'Valid Receipt',
			'Invalid Receipt - Bukan Struk Pembelian Susu',
			'Invalid Receipt - Struk Manual',
			'Invalid Receipt - Struk Tidak Terbaca',
			'Invalid Receipt - Struk Tidak Lengkap',
			'Invalid Receipt - Struk Double Upload',
			'Invalid Receipt - Struk dikirim >1 bulan dari tgl beli');
		$this->api_acc	        = 397;
		$this->api_err          = false;
	}
	public      function sync(&$arg) {
		$this->api_err =& $arg;
	}
	public 		function get_user($dat){
		$usr = $this->db->get_where('T_API_ACCOUNT', array('id_code' => $dat['cpid']))->row_array();
		if (password_verify($dat['cpassword'], $usr['credential'])) {
			return true;
		}
		else
			return false;
	}
	public      function set_user_key($key) {
		$dat['api_key'] = $key;
		$this->db->update($this->config->item('rest_keys_table'), $dat, array('aaa_account_id' => $this->rest->user_id));
	}
	public      function set_log_response($id, $dat) {
		$dat['response'] = json_encode($dat['response'], JSON_PRETTY_PRINT);
		$this->db->update('T_API_LOG', $dat, array('id' => $id));
	}
	
	public		function member_status($dat) {
		$sql = "select OID customer_id, MemberID member_id from T_ACCOUNT where OID = ? and GCRecord is null";
		$oid = (int)$dat['customer_id'];
		return $this->ori->query($sql, array($oid))->row_array();
	}
	public	function member_register($pst) {

		//iCity =  dbo.getCityID(City)
		$IsNew=0;
		$dat['CustName']		= isset($pst['customer_name'])  ? $pst['customer_name'] : null;
		$dat['PhoneNumber1']	= isset($pst['customer_telp'])  ? $pst['customer_telp'] : null;
		$dat['PhoneNumber3']	= isset($pst['customer_telp'])  ? $pst['customer_telp'] : null;
		$dat['Email']			= isset($pst['customer_email']) ? $pst['customer_email'] : null;
		$dat['address']			= isset($pst['address_web'])    ? $pst['address_web'] : null;
		$dat['City']			= isset($pst['address_city'])   ? $pst['address_city'] : null;
		$dat['iCity']			= isset($pst['address_city'])   ? $pst['address_city'] : null;
		$dat['CreatedOn']		= date('Y-m-d H:i:s');
		$dat['CreatedBy']		= $this->api_acc;
		//$dat['iCity'] =  dbo.getCityID(City);

		$ext['CustomerDOB'] 	= isset($pst['customer_dob']) ? $pst['customer_dob'] : null;
		$ext['Province']		= isset($pst['address_province']) ? $pst['address_province'] : null;

		unset($dat['customer_dob']);

		$sql = "select * from T_ACCOUNT where gcRecord is null and PhoneNumber1 = ?";
		$rst = $this->ori->query($sql, array($dat['PhoneNumber1']))->row_array();
		if(!$rst) {
			// not found in T_ACCOUNT -> check T_LOYALTY_MEMBER
			$sql = "select * from T_LOYALTY_MEMBER where gcRecord is null and  PhoneNumber1 = ?";
			$rst = $this->ori->query($sql, array($dat['PhoneNumber1']))->row_array();
			if(!$rst) {
				if ($dat['City'])
					$dat['City'] = $this->get_city_name($dat['City']);
					$this->ori->insert('T_ACCOUNT', $dat);
					$dat['oid'] = $this->ori->insert_id();
					$mom_id     = $dat['oid'];
			}
			else {
				// found in T_LOYALTY_MEMBER
				//$dat['oid'] = $rst['Oid'];
				$dat['oid'] = $rst['FK_ACC_ID'];
				$mom_id     = $rst['FK_ACC_ID'];
			}
			
		}
		else {
			$dat['oid'] = $rst['OID'];
			$mom_id     = $dat['oid'];
		}

		$sql = "select * from T_ACCOUNT_EXT where FK_ACC_ID = ?";
		$xxx = $this->ori->query($sql, array($mom_id))->row_array();
		if(!$xxx) {
			// todo: screening child
			$ext['FK_ACC_ID'] 	= $mom_id;
			if(empty($ext['CustomerDOB']))
				unset($ext['CustomerDOB']);
			if($ext) {
				$ext['FK_ACC_ID'] = $mom_id;
				$this->ori->insert('T_ACCOUNT_EXT', $ext);
			}
		}

		$acc_id = $dat['oid'];

		unset($dat['province']);
		unset($dat['oid']);
		unset($dat['iCity']);


		$dat['FK_ACC_ID'] 		= $acc_id;
		$dat['AcqDate']			= date('Y-m-d H:i:s');
		$dat['ChildName'] 		= isset($pst['child_name']) ? $pst['child_name'] : null;
		$dat['ChildBirthDate']	= isset($pst['child_dob'])  ? $pst['child_dob']  : null;
		$dat['IntAttrib3']      = 1;
		$dat['DataType']      = 2058;

		$dob                    = "{$dat['ChildBirthDate']} 00:00:00.000";
		
		$sql = "select * from T_CONTACT where FK_ACC_ID = $acc_id and ChildBirthDate = ?";
		$rst = $this->ori->query($sql, array($dob))->row_array();
		if(!$rst) {
			$this->ori->insert('T_CONTACT', $dat);
			$dat['cid'] = $this->ori->insert_id();
		}
		else {
			$flag = array('IntAttrib3' => 1);
			$this->ori->update('T_CONTACT', $flag, array('FK_ACC_ID' => $mom_id));
			$dat['chd_id'] = $rst['OID'];
		}
		// unset($dat['FK_ACC_ID'], $dat['AcqDate']);
		$dat['customer_id'] 	= $acc_id;
		$dat['mom_id']		= $mom_id;

                //Penambahan Mapping Data 
		$sql = "select * from T_LOYALTY_CORNER_USER_MAP where FK_ACC_ID = $acc_id";
		$rst = $this->ori->query($sql)->row_array();
		if(!$rst) {
			$ndat['FK_ACC_ID']=$dat['FK_ACC_ID'];
		        $ndat['Email']=$dat['Email'];
                	$ndat['PhoneNumber1']=$dat['PhoneNumber1'];
			$ndat['ChildName']=$dat['ChildName'];
			$ndat['ChildBirthDate']=$dat['ChildBirthDate'];
			$ndat['CustName']=$dat['CustName'];
			$this->ori->insert('T_LOYALTY_CORNER_USER_MAP', $ndat);
		}
		
		return $dat;
	}


	public		function member_info($dat) {
		//modified by teo tobing
		$randNum = rand(1, 7);
		
		/*$sql = "select 		a.OID customer_id, a.FK_MEMBER_ID fk_member_id, b.MemberID member_id, null member_segment, a.CustName customer_name,
							isnull(b.PhoneNumber1, a.PhoneNumber1) customer_telp,
							case when b.Email is null or b.Email = '' then a.Email end customer_email,
							isnull(b.address, a.address) address_home,
							case when b.address2 is null or b.address2 = '' then a.address2 end county,
							case when b.address3 is null or b.address3 = '' then a.address3 end district,
							isnull(b.city, a.city) city,
							b.province,
							isnull(a.ZipCode, b.ZipCode) zip_code,
							format(a.CreatedOn, 'yyyy-MM-dd') registered_as_customer,
							case when b.CreatedOn is not null then format(b.CreatedOn, 'yyyy-MM-dd') else null end registered_as_member,
							0 point_balance, 0 spoon_balance
				from 		T_ACCOUNT 			a
				left join	T_LOYALTY_MEMBER	b on a.FK_MEMBER_ID = b.OID
				where 		a.OID = ?";*/
			

		$sql = "select 		a.OID customer_id, a.FK_MEMBER_ID fk_member_id, b.MemberID member_id, dbo.Funct_GetCampaignToLoyalty(a.FK_MEMBER_ID) member_segment, a.CustName customer_name,
							isnull(b.PhoneNumber1, a.PhoneNumber1) customer_telp,
							case when b.Email is null or b.Email = '' then a.Email end customer_email,
							isnull(b.address, a.address) address_home,
							case when b.address2 is null or b.address2 = '' then a.address2 end county,
							case when b.address3 is null or b.address3 = '' then a.address3 end district,
							isnull(b.city, a.city) city,
							b.province,
							isnull(a.ZipCode, b.ZipCode) zip_code,
							format(a.CreatedOn, 'yyyy-MM-dd') registered_as_customer,
							case when b.CreatedOn is not null then format(b.CreatedOn, 'yyyy-MM-dd') else null end registered_as_member,
							0 point_balance, 0 spoon_balance,B.PointAkanHangus
				from 		T_ACCOUNT 			a
				left join	T_LOYALTY_MEMBER	b on a.FK_MEMBER_ID = b.OID
				left join T_A_MEMBER_CAMPAIGN C ON B.OID=C.FK_MEMBER_ID
				left join m_a_campaign d on c.fk_a_campaign_id = d.oid and d.Status=2
				where a.OID = ?";
		$oid = (int)$dat['customer_id'];
		$rst = $this->ori->query($sql, array($oid))->row_array();
		if($rst) {
			$rst['province']        = $this->get_province_name($rst['city']);
			$rst['address'] 		= array();
			
			if($rst['fk_member_id']) {
				// $addr = $this->address_shipping_info($rst);
				$rst['address']         = $this->address_shipping_info($rst);
				
				$point 					= $this->member_point($rst);
				$rst['point_balance'] 	= isset($point['point_balance'])  ? $point['point_balance'] : 0;
				$rst['point_ultima'] 	= isset($point['point_ultima'])  ? $point['point_ultima'] : 0;
				$rst['spoon_balance'] 	= isset($point['spoon_balance'])  ? $point['spoon_balance'] : 0;
			}

			unset($rst['address']['member_id'], $rst['fk_member_id']);

			$sql = "select 	ChildName child_name, format(ChildBirthDate, 'yyyy-MM-dd') child_dob, format(CreatedOn, 'yyyy-MM-dd') child_register_date
					from 	T_CONTACT
					where 	FK_ACC_ID 	= ?";
					//and		IntAttrib3 	= 1";
			$rst['children'] = $this->ori->query($sql, array($oid))->result_array();
		}
		unset($rst['member_oid']);
		return $rst;
	}
	public		function member_point($dat) {
		$oid = (int)$dat['customer_id'];
		$sql = "select fk_acc_id customer_id, oid member_oid, MemberID member_id from t_loyalty_member where fk_acc_id = ?";
		$rst = $this->ori->query($sql, array($oid))->row_array();
		
		$sql = "select 		isnull(sum(isnull(TotalPointEarning,0)) - sum(isnull(TotalRedeem, 0)), 0) point_balance,
						(select  ISNULL(SUM(TotalPoint), 0) from VL_POINT_TRANS_DETAIL where ProductName='S-26 PROCAL ULTIMA' and MemberID=a.MemberId) as point_ultima,
							0 spoon_balance, 0 point_expire_this_month, 0 point_expire_next_month
				from 		vl_member_point a
				where 		periodName = 'REGULAR PROGRAM'
				and         MemberID = ?
				group by	MemberID";
		
		$tmp = $this->ori->query($sql, array($rst['member_id']))->row_array();
		if($tmp)
			$rst = array_merge($rst,  $tmp);
		
		$sql = "select 	x.fk_member_id, spoon_deposit - isnull(spoon_expense, 0) spoon_balance
				from 	(
					select	fk_member_id, sum(numberofspoon) spoon_deposit
					from	t_loyalty_member_period_req 		b
					join 	t_loyalty_member_period_req_detail	c on b.oid = c.reqheader and b.fk_period_id = 7
					where 	fk_member_id = ?
					group by fk_member_id
				) x
				left join (
					select 	a.fk_member_id, sum(a.qty * b.spoonreq) spoon_expense
					from 	t_loyalty_point_redeem		a
					join	m_reward_item				b on b.oid = a.rewardid and a.fk_period_id = 7
					group by a.fk_member_id
				) y on x.fk_member_id = y.fk_member_id";
		$tmp = $this->ori->query($sql, array($rst['member_oid']))->row_array();
		unset($rst['member_oid']);
		isset($tmp['spoon_balance']) && $rst['spoon_balance'] = $tmp['spoon_balance'];
		return $rst;
	}
	public		function member_point_history($dat) {
		$out = array();
		$sql = "select MemberID member_id from t_loyalty_member where fk_acc_id = ?";
		$oid = (int)$dat['customer_id'];
		$mid = $this->ori->query($sql, array($oid))->row()->member_id;
		if($mid) {
			$sql = "select 	a.TransID point_id, format(isnull(b.createdOn, ReceivedDate), 'yyyy-MM-dd') received_date, format(a.TransDate, 'yyyy-MM-dd') purchase_date, a.MemberID member_id,
							a.Source purchase_store, a.SubSource purchase_subStore, a.ProductName product_name, a.Grammage product_grammage,
							iif(a.TotalPoint <0,0,a.Qty) product_qty, a.TotalPoint point_total
					from	VL_POINT_TRANS_DETAIL   a
					left join T_ACCOUNT_RECEIPT     b on a.TransID = b.FK_RCV_ID
					where	a.MemberID 	= '$mid'
					and 	a.PeriodName 	= 'REGULAR PROGRAM'
					order by a.transDate desc";
			if ($rst = $this->ori->query($sql)->result_array()) {
				$out['customer_id'] 			= $dat['customer_id'];
				$out['member_id'] 				= $rst[0]['member_id'];
				$out['point_expire_this_month'] = 0;
				$out['point_expire_next_month'] = 0;
				$out['history'] = array();
				foreach ($rst as $k => $v) {
					unset($v['member_id']);
					$out['history'][] = $v;
				}
			}
		}
		else
			$this->api_err = 111;
		return $out;
	}

	public		function receipt_status($dat) {
		$sql = "select max(oid) oid from t_account_receipt where fk_acc_id = ?";
		$oid = (int)$dat['customer_id'];
		$oid = $this->ori->query($sql, array($oid))->row()->oid;
		if($oid) {
			$sql = "select 	format(createdOn, 'yyyy-MM-dd HH:mm') receipt_date, receipt_status receipt_status_id, receipt_reason
					from	t_account_receipt
					where	oid			= $oid";
			$rst = $this->ori->query($sql)->row_array();
			if ($rst) {
				$rst['receipt_status'] = $this->receipt_status[$rst['receipt_status_id']];
				if ($rst['receipt_status_id'] <= 1)
					unset($rst['receipt_reason']);
			}
		}
		return $rst;
	}
	public function receipt_upload($dat, $file_name) {
		$sql = "select oid customer_id from T_ACCOUNT where oid = ?";
		$oid = (int)$dat['customer_id'];
		$rst = $this->ori->query($sql, array($oid))->row_array();
		if($rst) {

			$dat['FK_ACC_ID'] 		= $dat['customer_id'];
			$dat['receipt_path']		= substr($file_name,29);
			$dat['receipt_status_id']	= 0;
			$dat['createdOn']		= date('Y-m-d H:i:s', time());
			$dat['createdBy']		= 396; 	// api_ogilvy
			$dat['RCV_RFF']         = $dat['receipt_ref'];
			unset($dat['customer_id'], $dat['receipt_ref']);
			$this->ori->insert('T_ACCOUNT_RECEIPT', $dat);
		}
		return $rst;
	}
	public		function receipt_history($dat) {
		$sql = "select 	RCV_RFF receipt_ref, format(createdOn, 'yyyy-MM-dd HH:mm') receipt_date, null receipt_process, receipt_status_id receipt_status_id
				from	t_account_receipt
				where	fk_acc_id			= ?";
		$oid = (int)$dat['customer_id'];
		
		$rst = $this->ori->query($sql, array($oid))->result_array();
		if($rst) {
			foreach($rst as $k=>$v) {
				$rst[$k]['receipt_process'] = $v['receipt_status_id'] ? 'Done' : 'Pending';
				//$rst[$k]['receipt_status_id']  = $this->receipt_status[$v['receipt_status_id']];
				//if($v['receipt_status_id'] <= 1)
				//unset($rst[$k]['receipt_reason']);
			}
		}
		return $rst;
	}

	public      function address_shipping_info($dat) {
		$moid  = isset($dat['fk_member_id']) ? $dat['fk_member_id'] : $this->get_member_oid($dat);
		$sql = "select 	a.oid address_id, a.addr_type address_type, e.DisplayValue address_name, a.ADDRESS1 address, address2 county, address3 district,
						a.city city_id, b.CityName city_name, a.province province_id, ProvinceName province_name, a.ZIP_CODE zip_code
				from	T_ADDRESS 	a
				left join	City			b on b.OID = a.City
				left join	Province		c on c.OID = a.Province
				left join	PLAddressType	d on d.OID = a.addr_type
				join		PLBase			e on e.OID = d.OID
				where FK_MEMBER_ID 			= ?";
		$rst = $this->ori->query($sql, array($moid))->result_array();
		$rst['member_id'] = $moid;
		return $rst;
	}
	public      function address_shipping($pst) {
		$dat['fk_member_id']    = $this->get_member_oid($pst);
		$dat['addr_type']       = isset($pst['address_type'])   ? $pst['address_type'] : 2206;
		$dat['address1']        = $pst['address'];
		$dat['address2']        = isset($pst['county'])   ? $pst['county'] : null;
		$dat['address3']        = isset($pst['district'])   ? $pst['district'] : null;
		$dat['city']            = $pst['city_id'];
		$dat['province']        = $pst['province_id'];
		$dat['zip_code']        = isset($pst['zip_code'])   ? $pst['zip_code'] : null;
		$dat['createdOn']       = date('Y-m-d H:i:s', time());
		$dat['createdBy']       = $this->api_acc;
		$dat['UpdatedOn']       = date('Y-m-d H:i:s', time());
		$dat['UpdatedBy']       = $this->api_acc;
		
		$this->ori->insert('T_ADDRESS', $dat);
		$rsp['address_id']      = $this->ori->insert_id();
		return $rsp;
	}
	
	public      function reward_info($oid=null) {
		$whr = $oid ? " and a.oid = ?" : '';
		$sql = "select  a.oid reward_id, a.rewardName reward_name,
						a.point reward_point, a.SpoonReq reward_spoon, (b.qty_available - isnull(alert_level, 0)) reward_stock,
						cast(isnull(a.attrib1, 3) as int) reward_max, isnull(a.attrib2, '2018-12-31') reward_expire,
						null reward_segment
				from    m_reward_item 	a
				join	t_inv_balance	b on a.oid = b.fk_item_id
				where 	a.status 		= 0  and a.ToWeb = 1 
				$whr order by a.point asc ";
		return $oid ? $this->ori->query($sql, array($oid))->row_array() : $this->ori->query($sql)->result_array();
	}
	
	public      function redeem($pst) {
		$rst                    = array();
		$now                    = date('Y-m-d H:i:s', time());
		$m_oid                  = $this->get_member_oid($pst);
		$pst['member_oid']      = $m_oid;
		$reward                 = $this->reward_info($pst['reward_id']);
		$reward_max             = $this->reward_max($pst);
		$balance                = $this->member_point($pst);
		
		if( $m_oid &&
		   ($balance['point_balance'] >= $pst['reward_qty'] * $reward['reward_point']) &&
		   ($balance['spoon_balance'] >= $pst['reward_qty'] * $reward['reward_spoon']) &&
		   ($reward['reward_stock']   >= $pst['reward_qty']) &&
		   ($reward['reward_max'])    >= $reward_max
		) {
			$dat['fk_member_id']    = $m_oid;
			$dat['fk_period_id']    = 7;
			$dat['fk_addr_id']      = $pst['address_id'];
			$dat['ChannelID']       = 1;
			$dat['SubChannelId']    = 5;
			$dat['RedeemDate']      = $now;
			$dat['RewardID']        = $pst['reward_id'];
			$dat['Qty']             = $pst['reward_qty'];
			$dat['TotalPoint']      = $pst['reward_qty'] * $reward['reward_point'];
			$dat['Status']          = 2;
			$dat['CreatedOn']       = $now;
			$dat['CreatedBy']       = $this->api_acc;
			$dat['UpdatedOn']       = $now;
			$dat['UpdatedBy']       = $this->api_acc;
			$this->ori->insert('T_LOYALTY_POINT_REDEEM', $dat);
			
			$rst['redeem_id']       = $this->ori->insert_id();
			$rst['member_id']       = $dat['fk_member_id'];
		}
		else {
			$rst['member_id']    = $m_oid;
			$rst['msg']          = 170;
			if($reward['reward_stock'] < $pst['reward_qty'])
				$rst['msg'] = 171;
			elseif(($balance['point_balance'] < $pst['reward_qty'] * $reward['reward_point']) &&
			       ($balance['spoon_balance'] < $pst['reward_qty'] * $reward['reward_spoon']))
				$rst['msg'] = 172;
			elseif($balance['point_balance'] < $pst['reward_qty'] * $reward['reward_point'])
				$rst['msg'] = 173;
			elseif($balance['spoon_balance'] < $pst['reward_qty'] * $reward['reward_spoon'])
				$rst['msg'] = 174;
			elseif($reward['reward_max']     < $reward_max)
				$rst['msg'] = 175;
		}
		return $rst;
	}
	public      function redeem_history($dat) {
		$oid = $this->get_member_oid($dat);
		if($oid) {
			$sql = "select  a.oid redeem_id, a.rewardid reward_id, b.rewardname reward_name, format(redeemdate, 'yyyy-MM-dd HH:mm:ss') redeem_date, a.qty redeem_qty,
						a.qty * b.point redeem_point, a.qty*spoonreq redeem_spoon, x.statusname redeem_status,
						shipmentid shipment_id, c.status shipment_status_id, e.displayvalue shipment_status,
						format(date_sent, 'yyyy-MM-dd')    shipment_sent,
						format(date_received, 'yyyy-MM-dd') shipment_received,C.receiver_name
				from    t_loyalty_point_redeem 		a
				join	m_reward_item 				b on b.oid = a.rewardid
				join    m_pl_loyalty_redeem_status  x on x.oid = a.status
				left join	t_shipment_list				c on c.oid = a.shipmentid
				left join	plbase						e on e.oid = c.status
				where 	a.fk_member_id = ?";
			return $this->ori->query($sql, array($oid))->result_array();
		}
	}
	
	public		function sms_send($pst) {



		$sql = "update T_STAGING_UPDLOAD_SMS set Reference = {$pst['sms_ref']} where OID = {$pst['oid']}";
		$this->ori->simple_query($sql);
	}
	
	/*
	public 		function sms_prep() {
		$dat = array('FK_ACC_ID' => time());
		$this->ori->insert('T_SMS_BLACKLIST', $dat);
	}
	*/
	
	private     function get_member_oid($dat) {
		$sql = "select OID member_oid from T_LOYALTY_MEMBER where FK_ACC_ID = ?";
		$oid = (int)$dat['customer_id'];
		$rst = $this->ori->query($sql, array($oid))->row();
		if($rst)
			return $rst->member_oid;
		else {
			$this->api_err = 111;
			return 0;
		}
	}
	private 	function get_city_name($id) {
		$id = (int)$id;
		return $this->ori->get_where('City', array('oid' => $id))->row()->CityName;
	}
	private 	function get_province_name($name) {
		if($name) {
			$sql = "select  ProvinceName
					from    Province        a
					join    City            b on a.oid = b.province
					where   CityName        = ?";
			return $this->ori->query($sql, array($name))->row()->ProvinceName;
		}
		else return '';
	}
	private     function reward_max($dat) {
		$sql = "select  sum(a.qty) reward_qty
				from    t_loyalty_point_redeem	a
				where 	a.fk_period_id			= 7
				and		a.fk_member_id			= ?
				and		a.rewardID				= ?";
		$qty =  $this->ori->query($sql, array($dat['member_oid'], $dat['reward_id']))->row()->reward_qty;
		return $qty + $dat['reward_qty'];
	}
	public function send_otp_wa($dat){
			$ndat['WA_ID']=$dat['WA_ID'];
		        $ndat['Param1']=$dat['Param1'];
			$ndat['Param2']=$dat['Param2'];
			$ndat['Param3']=$dat['Param3'];
			$ndat['TemplateID']=73;
			$ndat['Channel']=2;
			$ndat['ProcessStat']=0;
			$ndat['CreatedOn']=date('Y-m-d H:i:s', time());
			$ndat['CreatedBy']=16;
                	$this->ori->insert('T_WA_TO_SEND', $ndat);



	}
        
        public function storelist($dat){
		$sqlwhere="";
                if($dat['CityID']!=""){
			$sqlwhere=" and D.OID= '{$dat['CityID']}'";
                 }
                if(($sqlwhere!="")&&($dat['OUTLETNAME']!=""))
		{
			$sqlwhere=" and A.GroupName like  '%{$dat['OUTLETNAME']}%'". $sqlwhere;

		}else if($sqlwhere==""){
			$sqlwhere=" and A.GroupName like  '%{$dat['OUTLETNAME']}%'". $sqlwhere;
                 }
		$sqlwhereonline="";
                if(($dat['OUTLETNAME']!="")&&$dat['CityID']=="0")
		{
			$sqlwhereonline=" and A.GroupName like  '%{$dat['OUTLETNAME']}%'";
		}
	
		$sql=" SELECT distinct 0 [OID],''[TRADECHANNEL],A.GroupName [OUTLETNAME],F.Urls [OUTLETLOCATION],'ONLINE' [City], G.TglExpired [VALIDUNTIL], 1 IsOnline,
			0 [CityID],0 [ProvinceID] 
			FROM OutletGroup A 
			JOIN OUTLET B ON B.OutletGroup=A.OID
			JOIN T_OUTLET_URL F ON F.OutletGroupID=A.OID
			join __T_Store_List G ON G.Oid=B.OID
			where A.Active=0 ". $sqlwhereonline ."
			UNION
			SELECT B.OID,C.DisplayValue[TRADECHANNEL],A.GroupName [OUTLETNAME],B.Location [OUTLETLOCATION],D.CityName [City], F.TglExpired [VALIDUNTIL],
			0 IsOnline,D.OID [CityID],E.OID [ProvinceID] 
			FROM OutletGroup A 
			JOIN OUTLET B ON B.OutletGroup=A.OID
			JOIN PLBase C ON C.OID=A.GroupType
			JOIN City D ON D.OID=B.City
            		JOIN Province E ON E.OID=D.Province
                        join __T_Store_List F ON F.Oid=B.OID
			where B.Active=0 and E.OID = '{$dat['ProvinceID']}'". $sqlwhere;
			return $this->ori->query($sql)->result_array();
			#return $sql;

	}

	public		function tiering_level($dat) {
		$oid = (int)$dat['customer_id'];

		$sql = "select top 1 LEVEL_ID_APPL CurrentLevel, P3M_TOTAL TotalTabungPoin, Month_TabungPoin BulanKeaktifanTabungPoin, Month_PostAdvocacy
			from T_MEMBER_LEVEL a
			join T_LOYALTY_MEMBER b on a.FK_MEMBER_ID=b.Oid	where b.FK_ACC_ID = ".$oid." order by a.oid desc";

		$rst = $this->ori->query($sql, array($oid))->row_array();
		if($rst) {
			$sql = "EXEC SP_API_REDEEM_BENEFIT ".$oid;
			$rst['RedeemBenefit'] = $this->ori->query($sql, array($oid))->result_array();
		}
		return $rst;
	}



}
