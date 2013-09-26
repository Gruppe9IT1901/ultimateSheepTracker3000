<?php

/**
*
*/
class Admin_model extends CI_Model
{

    private $userId;

    function __construct()
    {
        # code...
    }

    public function verify_user($email,$password)
    {
        $q =$this->db
                ->where('email',$email)
                ->where('password',sha1($password))->limit(1)->get('users');

        if ($q->num_rows > 0) {
            return $q->row();
        }
        return false;
    }

    public function getUserId(){

    }
}
