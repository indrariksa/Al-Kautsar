<?php
class Kirim extends CI_Controller {
  
    public function __construct()
    {
        parent::__construct();
        // $this->load->helper('url_helper');
        // $this->load->helper('form');
        $this->load->database();
    }
 
    public function autocomplete(){
     $this->load->view('pages/pengiriman/kirim');
    }
 
    public function cari(){
 
        $term = $this->input->get('term');
 
        $this->db->like('no_faktur', $term);
 
        $data = $this->db->get("pemesanan")->result();
 
        echo json_encode( $data);
    }
     
}