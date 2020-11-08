<?php 

class User_level extends CI_Controller{

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
            
        $this->load->model('M_user_level');   
    }

    public function index(){
        $data['User_level'] = $this->M_user_level->view_user_level()->result();
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/user_level/v_user_level', $data);
    }

    public function insert_user_level()
    {
        $this->form_validation->set_rules('nama_level','Level', 'is_unique[user_level.nama_level]');
        $this->form_validation->set_rules('deskripsi_level','Deskripsi', 'min_length[5]');

        $this->form_validation->set_message('min_length', '%s minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '%s sudah ada, silahkan ganti');
        
        if ($this->form_validation->run() == FALSE) {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/user_level/add_user_level');
        }else{
        $data = array(
            'nama_level'        => $this->input->post('nama_level'),
            'deskripsi_level'   => $this->input->post('deskripsi_level')
        );
        $imp = implode(',',$data);

        $enc  = encrypt_url($imp);
        // echo "\n\n Hasil Enkrip:\n" .($enc) . "\n";

        $dec = decrypt_url($enc);
        $hasil = array();
        list($hasil['deskripsi_level'],$hasil['nama_level']) = explode(',',$dec);
        // var_dump($hasil);
        // echo "\n\n Hasil Dekrip:\n". ($dec)."\n";
        
        $this->M_user_level->insert_user_level($hasil);
        $this->session->set_flashdata('success','Data Berhasil ditambah');
        
        redirect('User_level');
    }
    }

    public function update_user_level($ID){

        $where = array('level_id' => $ID);
        
        $data['user_level'] = $this->M_user_level->edit_data_user_level($where,'user_level')->result();

        $this->form_validation->set_rules('deskripsi_level','Deskripsi', 'min_length[5]');

        $this->form_validation->set_message('min_length', '%s minimal 5 karakter');
        
        if ($this->form_validation->run() == FALSE) {

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/user_level/edit_user_level', $data);
        }else{
        $data = array(
            'nama_level'        => $this->input->post('nama_level'),
            'deskripsi_level'   => $this->input->post('deskripsi_level')
        );

    $this->M_user_level->update_data_user_level($where,$data,'user_level');
    $this->session->set_flashdata('success','Data Berhasil diubah');
    redirect('User_level');
    }
    }

    public function delete_user_level($user_level){
        $where = array('level_id' => $user_level);

        $this->M_user_level->hapus_user_level($where,'user_level');
        $this->session->set_flashdata('success','Data Berhasil dihapus');
        redirect('User_level');
    }
}