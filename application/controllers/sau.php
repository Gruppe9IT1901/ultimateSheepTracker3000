<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Saueklasse
 *
 * @author Anders Kolstad
*/
class Sau extends CI_Controller {

/**
 * @desc Sjekker om bruker er pålogget og laster sheep_model
 * @return void
*/
    public function __construct(){
        session_start();
        parent::__construct();
        $this->load->helper('url');
        if (!isset($_SESSION['username'])) {
            redirect('admin'); //redirect til login hvis ikke bruker er logget inn
        }
        $this->load->model('sheep_model');
    }

/**
 * @return void
*/
    public function regSheep(){
        $data["sheep"] = $this->sheep_model->get_users_sheep();
        $this->load->view('regsau',$data);
    }

    public function editSheep(){
        $data["sheep"] = $this->sheep_model->get_users_sheep();
        $data["editsheep"] = $this->sheep_model->get_sheep_by_id($this->uri->segment(2));
        $this->load->view('editsheep',$data);
    }

    public function saveSheep(){
            $sheepid = $this->input->post('saueid');
            $sheepname = $this->input->post("sauenavn");
            $lat = $this->input->post("lat");
            $lng = $this->input->post("lng");
            $health = $this->input->post('health');
            $birthyear = $this->input->post('birthYear');
            $weight = $this->input->post('weight');
            if (count($this->sheep_model->get_sheep_by_id($sheepid)) > 0) {
                $data["sheep"] = $this->sheep_model->get_users_sheep();
                $data["inDb"] = true; // saueid finnes fra før
                $this->load->view('regsau',$data);
            }
            else{
                $this->sheep_model->insert_sheep($sheepname,$lat,$lng,$health,$birthyear,$weight,$sheepid);
                redirect('welcome');
            }

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
