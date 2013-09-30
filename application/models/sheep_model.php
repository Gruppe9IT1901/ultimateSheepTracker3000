<?php

/**
*
*/
class Sheep_model extends CI_Model
{

    public function get_users_sheep(){
        // $q = $this->db->query("SELECT * FROM sheep WHERE owner_id = ".$_SESSION["userid"].";");
        // return $q;
        // $q = $this->db->query("SELECT * FROM sau LEFT JOIN saupos ON sau.ID = saupos.sauID WHERE ownerID = '".$_SESSION['userid']."';");
        $q = $this->db->query("SELECT * FROM sau AS t1 LEFT JOIN (SELECT MAX(dato) dato,sauID,xpos,ypos FROM saupos
            group by sauID) AS t2 on t1.ID = t2.sauID WHERE t1.ownerID = '".$_SESSION['userid']."';");
        return $q;
    }

    public function insert_sheep($sheepname,$lat,$lng,$health,$birthyear,$weight){
        $sql = "INSERT INTO sau (navn,ownerID,birthYear,weight,health,color) VALUES (?,?,?,?,?,?)";
        $this->db->query($sql, array($sheepname, $_SESSION["userid"], $birthyear, $weight,$health,'1'));
        $sqlpos = "INSERT INTO saupos (xpos,ypos,sauID,dato) VALUES (?,?,LAST_INSERT_ID(),NOW());";
        $this->db->query($sqlpos,array($lat,$lng,));
    }

    public function get_sheep_by_id($id){
        $q = $this->db->query("SELECT * FROM sau WHERE ID =".$id." LIMIT 1;");
        return $q;
    }

    public function delete_sheep($id){
        $this->db->query("DELETE FROM saupos WHERE sauID =".$id.";");
        $this->db->query("DELETE FROM sau WHERE ID =".$id.";");
    }

}
