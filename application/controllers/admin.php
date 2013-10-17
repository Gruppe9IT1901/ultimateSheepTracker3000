<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
* Admin controller
*/
class Admin extends CI_Controller
{


    function __construct(){
        parent::__construct();
        session_start();
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index(){
		
		//Redirect hvis bruker er logget inn
     	if (isset($_SESSION['username'])) {
            redirect('welcome');
        }

		//Validering av post-felter
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email Address', 'requried|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[4]');

        if ($this->form_validation->run() != false) {
            
            $this->load->model('admin_model');
            
            //Hent bruker fra database
            $res = $this->admin_model->verify_user($this->input->post('email'),$this->input->post('password'));
			
			//Logg inn
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
