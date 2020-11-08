<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelunasan extends CI_Controller {
public function __construct(){
        parent::__construct();
        // if($_SESSION['level_id'] != 1)
        if(!$_SESSION['level_id'])
        {
            $this->session->set_flashdata('error',"Halaman tidak dapat diakses.");
            redirect('Login');
        }
        $this->load->model('M_pelunasan');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->database();
    }
    public function index()
    {
        $get = array(
            'd_faktur' => $this->M_pelunasan->dd_faktur()
        );

        $admin = $this->session->userdata('id_user');

        $this->form_validation->set_rules('dibayar','Pembayaran', 'trim');

        if ($this->form_validation->run() == FALSE) {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pelunasan/add_pelunasan', $get);
        }else{
        $data = array(
            'no_faktur'   			=> $this->input->post('no_faktur'),
            'dibayar'     			=> $this->input->post('dibayar2'),
            'tgl_pembayaran'     	=> date("Y-m-d  H:i:s"),
            'id_user_bayar'         => $admin
        );
        $this->M_pelunasan->insert_pelunasan($data);
        // var_dump($data);


        $q = $this->db->get('pemesanan');
        if ($q->num_rows() > 0 ) 
        {  
        foreach($q->result_array() as $row) {
        $id     = $row['no_faktur'];
        if($id==$this->input->post('no_faktur')){
        $up = array(
        'no_faktur'                 => $row['no_faktur'],
        'total'                     => $row['total'],
        'jml_bayar'                 => $row['jml_bayar']+$this->input->post('dibayar2'),
        'sisa'                      => $row['total']-($row['jml_bayar']+$this->input->post('dibayar2'))
        );
        // var_dump($up);
        // var_dump($id);
        $this->db->where('no_faktur', $id);
        $this->db->update('pemesanan', $up);
                }
            }
        }

        $this->session->set_flashdata('success','Data Berhasil ditambah');
        
        redirect('Pelunasan');
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
        $row = $this->M_pelunasan->get_data($id);
        
        if( ! empty($row)){ 
            $callback = array(
                'status' => 'success', 
                'nama_pemesan' => $row->nama_pemesan, 
                'telp_pemesan' => $row->telp_pemesan,
                'alamat_pemesan' => $row->alamat_pemesan,
                'tgl_pemesanan' => date('d-M-Y H:i:s', strtotime($row->tgl_pemesanan)),
                'total' => 'Rp'.' '.number_format($row->total,0,',','.'),
                'jml_bayar' => 'Rp'.' '.number_format($row->jml_bayar,0,',','.'),
                'sisa' => 'Rp'.' '.number_format($row->sisa,0,',','.'),
            );
        }else{
            $callback = array('status' => 'failed'); 
        }

        echo json_encode($callback); 

    }

    public function check_id_avalibility()  
      {   
        $id = $this->input->post('no_faktur');
        $this->load->model('M_pelunasan');  
        if($this->M_pelunasan->is_id_available($id))  
        {  
             echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Faktur Sudah Lunas</label>';  
        }  
        else
        {  
             echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Faktur Belum Lunas</label>';  
        }   
      } 

    public function view_table(){
        $data['Pengiriman'] = $this->M_pelunasan->view_pengiriman()->result();
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pengiriman/v_pengiriman', $data);
    }

    public function detail_table($id){
        $getfaktur = $this->M_pelunasan->get_faktur($id);

        $data['Pengiriman'] = $this->M_pelunasan->dtl_pemesanan($id);
        $data['Dtl'] = $this->M_pelunasan->view_dtl_pemesanan($id);
        $data['no_faktur'] = $getfaktur->no_faktur_k;

        // echo json_encode($this->M_pelunasan->getLokasi($id));
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pengiriman/detail_pengiriman', $data);
    }

}