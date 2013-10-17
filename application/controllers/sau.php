<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sau extends CI_Controller {

    /**
     *
     */

    public function __construct(){
        session_start();
        parent::__construct();
		$this->load->helper('url');
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
        print_r($data["res"]);
    }

    public function saveSheep(){
            $sheepid = $this->input->post('saueid');
            $sheepname = $this->input->post("sauenavn");
            $lat = $this->input->post("lat");
            $lng = $this->input->post("lng");
            $health = $this->input->post('health');
            $birthyear = $this->input->post('birthYear');
            $weight = $this->input->post('weight');
            $this->sheep_model->insert_sheep($sheepname,$lat,$lng,$health,$birthyear,$weight,$sheepid);
            redirect('welcome');

    }

    public function deleteSheep(){
        $this->sheep_model->delete_sheep($this->uri->segment(2));
        redirect('welcome');
    }

    public function getSheepInfo(){
	    $q = $this->sheep_model->get_sheep_by_id($this->input->post('id'));
	    echo(json_encode($q));
    }

}
