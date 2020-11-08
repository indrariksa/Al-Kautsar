<?php 

class Sapi extends CI_Controller{

    public function __construct(){
        parent::__construct();
        if($_SESSION['level_id'] != 1)
        {
            $this->session->set_flashdata('error',"Halaman tidak dapat diakses.");
            redirect('Login');
        }elseif (!$this->session->userdata('level_id')) {
            $this->session->set_flashdata('msg', ' ');
            redirect('Login');
        }
            
        $this->load->model('M_sapi');   
    }

    public function index(){
        $data['Sapi'] = $this->M_sapi->view_sapi()->result();
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/sapi/v_sapi', $data);
    }

    public function insert_sapi()
    {
        $this->form_validation->set_rules('sapi_kelas','Kelas Sapi', 'trim');
        
        if ($this->form_validation->run() == FALSE) {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/sapi/add_sapi');
        }else{
        $data = array(
            'sapi_kelas'      => $this->input->post('sapi_kelas'),
            'sapi_deskripsi'  => $this->input->post('sapi_deskripsi'),
            'sapi_status'     => $this->input->post('sapi_status')
        );
        $this->M_sapi->insert_sapi($data);
        $this->session->set_flashdata('success','Data Berhasil ditambah');
        
        redirect('Sapi');
    }
    }

    public function update_sapi($ID){

        $where = array('sapi_id' => $ID);
        
        $data['sapi'] = $this->M_sapi->edit_data_sapi($where,'sapi')->result();

        $this->form_validation->set_rules('sapi_kelas','Kelas Sapi', 'trim');
        
        if ($this->form_validation->run() == FALSE) {

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/sapi/edit_sapi', $data);
        }else{
        $data = array(
            'sapi_kelas'      => $this->input->post('sapi_kelas'),
            'sapi_deskripsi'  => $this->input->post('sapi_deskripsi'),
            'sapi_status'     => $this->input->post('sapi_status')
        );

    $this->M_sapi->update_data_sapi($where,$data,'sapi');
    $this->session->set_flashdata('success','Data Berhasil diubah');
    redirect('Sapi');
    }
    }

    public function delete_sapi($sapi){
        $where = array('sapi_id' => $sapi);

        $this->M_sapi->hapus_sapi($where,'sapi');
        $this->session->set_flashdata('success','Data Berhasil dihapus');
        redirect('Sapi');
    }
}