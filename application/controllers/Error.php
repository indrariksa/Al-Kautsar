<?php 

class Error extends CI_Controller{

	public function __construct(){
		parent::__construct();	
	}

	public function index(){
		$data['heading'] = 'awee';
		$data['message'] = 'aw';
		$this->load->view('error', $data);
	}

}