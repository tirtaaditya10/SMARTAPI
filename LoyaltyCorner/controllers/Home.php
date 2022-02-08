<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public      function __construct() {
		parent::__construct();
		$this->load->model('Mvbe', 'model');
	}
	public      function index() {
		$this->load->view('index.html');
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
		header('location: https://sdp2test.azurewebsites.net/LoyaltyCorner/vbe#vbe/lst');
	}

	public      function user_guide() {
		$this->smarty->display("elm/bs3/misc/under_construction.tpl");
	}
}
