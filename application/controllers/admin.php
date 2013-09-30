<?php

/**
* Admin controller
*/
class Admin extends CI_Controller
{


    function __construct(){
        parent::__construct();
        session_start();
    }

    public function index(){

        if (isset($_SESSION['username'])) {
            redirect('welcome');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email Address', 'requried|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[4]');

        if ($this->form_validation->run() != false) {
            $this->load->model('admin_model');
            $res = $this->admin_model->verify_user($this->input->post('email'),$this->input->post('password'));

            if($res != false){
                $_SESSION['username'] =$this->input->post('email');
                $_SESSION['userid'] = $res->email;
                redirect('welcome');
            }

        }

        $this->load->view('login_view');
    }

    public function logout(){
        session_destroy();
        $this->load->view('login_view');
    }

    public function register(){
        $this->load->view('register_view');
    }

}
