<?php 

class Hewan extends CI_Controller{

    public function __construct(){
        parent::__construct();
        if(!$_SESSION['level_id'])
        {
            $this->session->set_flashdata('error',"Halaman tidak dapat diakses.");
            redirect('Error');
        }elseif (!$this->session->userdata('level_id')) {
            $this->session->set_flashdata('msg', ' ');
            redirect('Error');
        }
            
        $this->load->model('M_hewan');   
        // $this->load->library('form_validation');
    }

    public function index(){
        $data['Hewan'] = $this->M_hewan->view_hewan()->result();
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/hewan/v_hewan', $data);
    }

    public function insert_hewan()
    {
        $get = array(
            'jenis_hewan' => $this->M_hewan->get_jenis_hewan()
        );

        $this->form_validation->set_rules('hewan_id','Kode Hewan', 'trim|is_unique[hewan.hewan_id]');

        $this->form_validation->set_message('is_unique', '%s sudah ada, silahkan ganti');
        
        if ($this->form_validation->run() == FALSE) {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/hewan/add_hewan');
        // $this->session->set_flashdata('error','Mohon lengkapi form');
        }else{
        $data = array(
            'hewan_id'         => $this->input->post('hewan_id'),
            'hewan_kelas'      => $this->input->post('hewan_kelas'),
            'hewan_deskripsi'  => $this->input->post('hewan_deskripsi'),
            'hewan_jenis'      => $this->input->post('hewan_jenis'),
            'hewan_status'     => $this->input->post('hewan_status')
        );
        $this->M_hewan->insert_hewan($data);
        $this->session->set_flashdata('success','Data Berhasil ditambah');
        
        redirect('Hewan');
    }
    }

    public function update_hewan($ID){

        $where = array('hewan_id' => $ID);
        
        $data['hewan'] = $this->M_hewan->edit_data_hewan($where,'hewan')->result();

        $this->form_validation->set_rules('hewan_id','Kode hewan', 'trim');
        
        if ($this->form_validation->run() == FALSE) {

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/hewan/edit_hewan', $data);
        }else{
        $data = array(
            'hewan_id'         => $this->input->post('hewan_id'),
            'hewan_kelas'      => $this->input->post('hewan_kelas'),
            'hewan_deskripsi'  => $this->input->post('hewan_deskripsi'),
            'hewan_jenis'      => $this->input->post('hewan_jenis'),
            'hewan_status'     => $this->input->post('hewan_status')
        );

    $this->M_hewan->update_data_hewan($where,$data,'hewan');
    $this->session->set_flashdata('success','Data Berhasil diubah');
    redirect('Hewan');
    }
    }

    public function delete_hewan($hewan){
        $where = array('hewan_id' => $hewan);

        $this->M_hewan->hapus_hewan($where,'hewan');
        $this->session->set_flashdata('success','Data Berhasil dihapus');
        redirect('Hewan');
    }
}