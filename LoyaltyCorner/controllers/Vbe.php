<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vbe extends CI_Controller {
	public      function __construct() {
		parent::__construct();
		$this->load->model('Mvbe', 'model');
	}
	public      function index() {
		$this->load->view('vbe/vbe-home.php');
	}
	
	public      function splash() {
		$this->load->view('index/splash');
	}

	public function lst($oid=null) {
		$this->smarty->assign('dat', $this->model->lst($oid));
		if($oid)
			$this->smarty->display("vbe/vbe-frm.tpl");
		else
			$this->smarty->display("vbe/vbe-lst.tpl");
	}

	public function frm() {
		$post = $this->input->post();
		$this->model->frm($post);
		header('location: https://nidn-dv-loyaidb2c-solution-asse-08-app.azurewebsites.net/LoyaltyCorner/vbe#vbe/lst');
	}

	public      function user_guide() {
		$this->smarty->display("elm/bs3/misc/under_construction.tpl");
	}
}
