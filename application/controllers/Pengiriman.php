<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengiriman extends CI_Controller {
public function __construct(){
        parent::__construct();
        // if($_SESSION['level_id'] != 1)
        if(!$_SESSION['level_id'])
        {
            $this->session->set_flashdata('error',"Halaman tidak dapat diakses.");
            redirect('Login');
        }
        $this->load->model('M_pengiriman');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->database();
    }
    public function index()
    {
        $get = array(
            'd_faktur' => $this->M_pengiriman->dd_faktur()
        );

        $admin = $this->session->userdata('id_user');

        $this->form_validation->set_rules('no_faktur','No Faktur', 'trim|is_unique[pengiriman.no_faktur_k]');
        $this->form_validation->set_rules('nama_penerima','Nama Penerima', 'trim');
        $this->form_validation->set_rules('alamat_penerima','Alamat Penerima', 'trim');
        $this->form_validation->set_rules('telp_penerima','Telepon Penerima', 'trim');

        $this->form_validation->set_message('is_unique', 'Maaf, %s sudah diproses');

        if ($this->form_validation->run() == FALSE) {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pengiriman/add_pengiriman', $get);
        }else{
        $data = array(
            'no_faktur_k'           => $this->input->post('no_faktur'),
            'nama_penerima'         => $this->input->post('nama_penerima'),
            'telp_penerima'         => $this->input->post('telp_penerima'),
            'alamat_penerima'       => $this->input->post('alamat_penerima'),
            'keterangan_pengiriman' => $this->input->post('keterangan_pengiriman'),
            'tgl_input_pengiriman'  => date("Y-m-d  H:i:s"),
            'id_user_kirim'         => $admin
        );
        $this->M_pengiriman->insert_pengiriman($data);

        $q = $this->db->get('pemesanan');
        if ($q->num_rows() > 0 ) 
        {  
        foreach($q->result_array() as $row) {
        $id     = $row['no_faktur'];
        if($id==$this->input->post('no_faktur')){
        $up = array(
        'status_kirim'              => 'sudah'
        );
        var_dump($up);
        var_dump($id);
        $this->db->where('no_faktur', $id);
        $this->db->update('pemesanan', $up);
                }
            }
        }

        $this->session->set_flashdata('success','Data Berhasil ditambah');
        
        redirect('Pengiriman');
        }
    }

    public function cari(){
 
        $term = $this->input->get('term');
 
        $this->db->like('no_faktur', $term);
 
        $data = $this->db->get("pemesanan")->result();
 
        echo json_encode( $data);
    }

    function search(){
        
        $id = $this->input->post('no_faktur');
        $row = $this->M_pengiriman->get_data($id);
        
        if( ! empty($row)){ 
            $callback = array(
                'status' => 'success', 
                'nama_pemesan' => $row->nama_pemesan, 
                'telp_pemesan' => $row->telp_pemesan,
                'alamat_pemesan' => $row->alamat_pemesan,
                'tgl_pemesanan' => date('d-M-Y H:i:s', strtotime($row->tgl_pemesanan)),
            );
        }else{
            $callback = array('status' => 'failed'); 
        }

        echo json_encode($callback); 

    }

    public function check_id_avalibility()  
      {   
        $id = $this->input->post('no_faktur');
        $this->load->model('M_pengiriman');  
        if($this->M_pengiriman->is_id_available($id))  
        {  
             echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> No Faktur Sudah Diproses</label>';  
        }  
        else  
        {  
             echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> No Faktur Belum Diproses</label>';  
        }   
      } 

    public function view_table(){
        $data['Pengiriman'] = $this->M_pengiriman->view_pengiriman()->result();
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pengiriman/v_pengiriman', $data);
    }

    public function detail_table($id){
        $getfaktur = $this->M_pengiriman->get_faktur($id);

        $data['Kirim'] = $this->M_pengiriman->dtl_pengiriman($id);
        $data['Pesan_dtl'] = $this->M_pengiriman->dtl_pemesanan($id);
        $data['Dtl'] = $this->M_pengiriman->view_dtl_pemesanan($id);
        $data['no_faktur'] = $getfaktur->no_faktur_k;

        // echo json_encode($this->M_pengiriman->getLokasi($id));
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pengiriman/detail_pengiriman', $data);
    }

    public function delete_pengiriman($pengiriman){
        $where_delete = array('no_faktur_k' => $pengiriman);
        $where_update = array('no_faktur' => $pengiriman);

        $data = array(
            'status_kirim' => 'belum'
        );

        $this->M_pengiriman->update_data_pengiriman($where_update,$data,'pemesanan');

        $this->M_pengiriman->hapus_pengiriman($where_delete,'pengiriman');
        $this->session->set_flashdata('success','Data Berhasil dihapus');
        redirect('Pengiriman/view_table');
    }

    public function cetak_pengiriman($id){
        $x['data']=$this->M_pengiriman->cetak_faktur_2($id);
        $x['data2']=$this->M_pengiriman->cetak_faktur_3($id);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pengiriman/v_faktur_pengiriman',$x);
        //$this->session->unset_userdata('nofak');
    }

}