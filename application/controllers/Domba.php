<?php 

class Domba extends CI_Controller{

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
            
        $this->load->model('M_domba');   
        // $this->load->library('form_validation');
    }

    public function index(){
        $data['Domba'] = $this->M_domba->view_domba()->result();
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/domba/v_domba', $data);
    }

    public function insert_domba()
    {
        $this->form_validation->set_rules('domba_kelas','Kelas Domba', 'trim');
        
        if ($this->form_validation->run() == FALSE) {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/domba/add_domba');
        // $this->session->set_flashdata('error','Mohon lengkapi form');
        }else{
        $data = array(
            'domba_kelas'      => $this->input->post('domba_kelas'),
            'domba_deskripsi'  => $this->input->post('domba_deskripsi'),
            'domba_status'     => $this->input->post('domba_status')
        );
        $this->M_domba->insert_domba($data);
        $this->session->set_flashdata('success','Data Berhasil ditambah');
        
        redirect('Domba');
    }
    }

    public function update_domba($ID){

        $where = array('domba_id' => $ID);
        
        $data['domba'] = $this->M_domba->edit_data_domba($where,'domba')->result();

        $this->form_validation->set_rules('domba_kelas','Kelas Domba', 'trim');
        
        if ($this->form_validation->run() == FALSE) {

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/domba/edit_domba', $data);
        }else{
        $data = array(
            'domba_kelas'      => $this->input->post('domba_kelas'),
            'domba_deskripsi'  => $this->input->post('domba_deskripsi'),
            'domba_status'     => $this->input->post('domba_status')
        );

    $this->M_domba->update_data_domba($where,$data,'domba');
    $this->session->set_flashdata('success','Data Berhasil diubah');
    redirect('Domba');
    }
    }

    public function delete_domba($domba){
        $where = array('domba_id' => $domba);

        $this->M_domba->hapus_domba($where,'domba');
        $this->session->set_flashdata('success','Data Berhasil dihapus');
        redirect('Domba');
    }
}