<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sau extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct(){
        session_start();
        parent::__construct();

        if (!isset($_SESSION['username'])) {
            redirect('admin');
        }
        $this->load->model('sheep_model');
    }


    public function regSheep(){
        $data["sheep"] = $this->sheep_model->get_users_sheep();
        $this->load->view('regsau',$data);
    }

    public function editSheep(){
        $data["res"] = $this->sheep_model->get_sheep_by_id($this->uri->segment(2));
        $data["sheep"] = $this->sheep_model->get_users_sheep();
        print_r($data["res"]);
    }

    public function saveSheep(){

            $sheepname = $this->input->post("sauenavn");
            $lat = $this->input->post("lat");
            $lng = $this->input->post("lng");
            $health = $this->input->post('health');
            $birthyear = $this->input->post('birthYear');
            $weight = $this->input->post('weight');
            $this->sheep_model->insert_sheep($sheepname,$lng,$lat,$health,$birthyear,$weight);
            redirect('welcome');

    }

    public function deleteSheep(){
        $this->sheep_model->delete_sheep($this->uri->segment(2));
        redirect('welcome');
    }

}
