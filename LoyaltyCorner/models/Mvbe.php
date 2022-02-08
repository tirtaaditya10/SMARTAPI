<?php if (!defined ('BASEPATH')) die ();

class Mvbe extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->svr 		= $this->load->database('svr_ori', true);
	}
	
	public function lst($oid) {
		if($oid) {
			$rst = $this->svr->get_where('t_account_receipt', array('oid' =>$oid))->row_array();
		}
		else {
			$sta = array(
				'Pending for Review',
				'Valid Receipt',
				'Invalid Receipt - Bukan Struk Pembelian Susu',
				'Invalid Receipt - Struk Manual',
				'Invalid Receipt - Struk Tidak Terbaca',
				'Invalid Receipt - Struk Tidak Lengkap',
				'Invalid Receipt - Struk Double Upload',
				'Invalid Receipt - Struk dikirim, >1 bulan dari tgl beli',
				'Invalid Receipt - Struk produk dibawah 1 tahun',
				'Invalid Receipt - Struk ECommerce tidak sesuai',
				'Invalid Receipt - Struk Sudah Invalid 1 Bulan',
				'Invalid Receipt – Struk Copy/Reprint/Cetak Ulang',
				'Invalid Receipt – Struk Product Specialist',
				'Invalid Receipt - Usia si Kecil Belum Genap 1 Tahun',
				'Invalid Receipt - Nama Toko Belum Terdaftar');
			$sql = "select 	a.oid, a.fk_acc_id, custName, b.phoneNumber1, a.receipt_path, a.receipt_status_id receipt_status, a.FK_RCV_ID, 
							a.createdOn, a.createdBy, c.userName creator, 
							a.validatedOn, a.validatedBy, d.userName validator
					from 	t_account_receipt		a
					join	t_account				b on b.oid = a.fk_acc_id
					join 	v_xuser					c on c.oid = a.createdBy
					left join v_xuser				d on d.oid = a.validatedBy
					where a.receipt_status_id=0
					order by a.createdOn desc";
			$rst = $this->svr->query($sql)->result_array();
			if ($rst) {
				foreach ($rst as $k => $v) {
					$rst[$k]['receipt_path']   = 'http://103.73.125.17/' . $v['receipt_path'];
					$rst[$k]['receipt_status'] = $sta[$v['receipt_status']];
				}
			}
		}
		return $rst;
	}

	public function frm($pst) {
		$oid = $pst['oid'];
		unset($pst['oid']);
		$pst['validatedOn'] = date('Y-m-d H:i:s', time());
		$this->svr->update('t_account_receipt', $pst, array('oid' =>$oid));
	}
}
