<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


    function __construct(){
            parent::__construct();
            $this->load->model('M_login');          
            $this->load->helper(array('url','form'));
        }

    function index()
        {
            // $data = "";
            $this->load->view('login_form');
        }

    function login_akses()
      {

         $username = $this->input->post('username');
         $password = md5($this->input->post('password'));

         $akses = $this->M_login->login($username,$password);

         if($akses->num_rows() == 1)
         {

          foreach ($akses->result_array() as $data) 
          {
               $session['id_user'] = $data['id_user'];
               $session['username'] = $data['username'];
               $session['nama_user'] = $data['nama_user'];
               $session['email_user'] = $data['email_user'];
               $session['telp_user'] = $data['telp_user'];
               $session['level_id'] = $data['level_id'];
               $session['nama_level'] = $data['nama_level'];
               $session['deskripsi_level'] = $data['deskripsi_level'];

               $this->session->set_userdata($session);
               redirect('Welcome');
          }
         } else {

               $this->session->set_flashdata("error", "<stong> Username / Password Salah! </strong>");
               redirect('Login');
         }
      }

      public function logout() {

        $this->session->sess_destroy();

      redirect('Login');
        


    }


    
}