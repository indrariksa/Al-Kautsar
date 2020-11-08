<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
public function __construct(){
		parent::__construct();
		if(!$_SESSION['level_id'])
        {
            $this->session->set_flashdata('error',"Halaman tidak dapat diakses.");
            redirect('Error');
        }
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_home');
	}
	public function index()
	{
		$data['jml_hewan']    	= $this->M_home->hitungHewan();
        $data['jml_pesanan']  	= $this->M_home->hitungPesanan();
        $data['jml_kiriman']    = $this->M_home->hitungKiriman();
        $data['jml_bayar']    	= $this->M_home->hitungTransaksi();
		
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pages/Dashboard', $data);
	}

}
