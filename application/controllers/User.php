<?php 

class User extends CI_Controller{

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
            
        $this->load->model('M_user');   
    }

    public function index(){
        $data['User'] = $this->M_user->view_user()->result();
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/user/v_user', $data);
    }

    public function insert_user()
    {

        $get = array(
            'data_user_lvl' => $this->M_user->get_user_lvl()
        );
        $this->form_validation->set_rules('username','Username', 'min_length[5]|is_unique[user.username]');
        $this->form_validation->set_rules('password','Password', 'min_length[5]');
        $this->form_validation->set_rules('passconf','Konfirmasi Password', 'matches[password]',
            array('matches' => '%s tidak sama dengan password'));
        $this->form_validation->set_rules('email_user', 'Email', 'valid_email|is_unique[user.email_user]');

        $this->form_validation->set_message('min_length', '%s minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '%s telah terpakai, silahkan ganti');
        $this->form_validation->set_message('valid_email', '%s tidak sesuai dengan format');
        
        if ($this->form_validation->run() == FALSE) {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/user/add_user', $get);
        }else{
        $data = array(
            'username'      => $this->input->post('username'),
            'password'      => md5($this->input->post('password')),
            'nama_user'     => $this->input->post('nama_user'),
            'email_user'    => $this->input->post('email_user'),
            'telp_user'     => $this->input->post('telp_user'),
            'level_id'      => $this->input->post('level_id'),
            'status_user'   => $this->input->post('status_user')
        );
        $this->M_user->insert_user($data);
        $this->session->set_flashdata('success','Data Berhasil ditambah');
        
        redirect('User');
    }
    }

    public function update_user($ID){

        $where = array('id_user' => $ID);
        
        $data['data_user_lvl'] = $this->M_user->get_user_lvl();
        $data['user'] = $this->M_user->edit_data_user($where,'user')->result();

        $this->form_validation->set_rules('username','Username', 'min_length[5]');
        $this->form_validation->set_rules('email_user', 'Email', 'valid_email');

        $this->form_validation->set_message('min_length', '%s minimal 5 karakter');
        
        if ($this->form_validation->run() == FALSE) {

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/user/edit_user', $data);
        }else{
        $data = array(
            'username'      => $this->input->post('username'),
            'nama_user'     => $this->input->post('nama_user'),
            'email_user'    => $this->input->post('email_user'),
            'telp_user'     => $this->input->post('telp_user'),
            'level_id'      => $this->input->post('level_id'),
            'status_user'   => $this->input->post('status_user')
        );

    $this->M_user->update_data_user($where,$data,'user');
    $this->session->set_flashdata('success','Data Berhasil diubah');
    redirect('User');
    }
    }

    public function delete_user($user){
        $where = array('id_user' => $user);

        $this->M_user->hapus_user($where,'user');
        $this->session->set_flashdata('success','Data Berhasil dihapus');
        redirect('User');
    }
}