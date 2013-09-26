<?php

/**
*
*/
class Sheep_model extends CI_Model
{

    public function get_users_sheep(){
        $q = $this->db->query("SELECT * FROM sheep WHERE owner_id = ".$_SESSION["userid"].";");
        return $q;
    }

    public function insert_sheep($sheepname,$lat,$long){
        $sql = "INSERT INTO sheep (name,lng,lat,owner_id) VALUES (?,?,?,?)";
        $this->db->query($sql, array($sheepname, $long, $lat,$_SESSION["userid"]));
    }

    public function get_sheep_by_id($id){
        $q = $this->db->query("SELECT * FROM sheep WHERE id =".$id." LIMIT 1;");
        return $q;
    }

    public function delete_sheep($id){
        $q = $this->db->query("DELETE FROM sheep WHERE id =".$id.";");
    }

}
