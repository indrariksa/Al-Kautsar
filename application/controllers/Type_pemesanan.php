<?php 

class Type_pemesanan extends CI_Controller{

    public function __construct(){
        parent::__construct();
        if($_SESSION['level_id'] != 1)
        {
            $this->session->set_flashdata('error',"Halaman tidak dapat diakses.");
            redirect('Error');
        }elseif (!$this->session->userdata('level_id')) {
            $this->session->set_flashdata('msg', ' ');
            redirect('Error');
        }
            
        $this->load->model('M_type_pemesanan');   
    }

    public function index(){
        $data['Type'] = $this->M_type_pemesanan->view_type_pemesanan()->result();
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/type_pemesanan/v_type_pemesanan', $data);
    }

    public function insert_type_pemesanan()
    {
        $this->form_validation->set_rules('nama_type','Tipe', 'trim');
        $this->form_validation->set_rules('deskripsi','Deskripsi', 'min_length[5]');

        $this->form_validation->set_message('min_length', '%s minimal 5 karakter');
        
        if ($this->form_validation->run() == FALSE) {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/type_pemesanan/add_type_pemesanan');
        }else{
        $data = array(
            'nama_type'   => $this->input->post('nama_type'),
            'deskripsi'   => $this->input->post('deskripsi')
        );
        $this->M_type_pemesanan->insert_type_pemesanan($data);
        $this->session->set_flashdata('success','Data Berhasil ditambah');
        
        redirect('Type_pemesanan');
    }
    }

    public function update_type_pemesanan($ID){

        $where = array('id_type_pemesanan' => $ID);
        
        $data['Type'] = $this->M_type_pemesanan->edit_data_type_pemesanan($where,'type_pemesanan')->result();

        $this->form_validation->set_rules('nama_type','Tipe', 'trim');
        $this->form_validation->set_rules('deskripsi','Deskripsi', 'min_length[5]');

        $this->form_validation->set_message('min_length', '%s minimal 5 karakter');
        
        if ($this->form_validation->run() == FALSE) {

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/type_pemesanan/edit_type_pemesanan', $data);
        }else{
        $data = array(
            'nama_type'   => $this->input->post('nama_type'),
            'deskripsi'   => $this->input->post('deskripsi')
        );

    $this->M_type_pemesanan->update_data_type_pemesanan($where,$data,'type_pemesanan');
    $this->session->set_flashdata('success','Data Berhasil diubah');
    redirect('Type_pemesanan');
    }
    }

    public function delete_type_pemesanan($type_pemesanan){
        $where = array('id_type_pemesanan' => $type_pemesanan);

        $this->M_type_pemesanan->hapus_type_pemesanan($where,'type_pemesanan');
        $this->session->set_flashdata('success','Data Berhasil dihapus');
        redirect('Type_pemesanan');
    }
}