<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
	
public function __construct(){
		parent::__construct();
        $this->load->library('form_validation');
	}
	public function index()
	{
		// $data['dashboard'] = $this->M_mahasiswa->view_mahasiswa()->result();
		
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pages/Form_v');
	}
}
