<?php

/**
*
*/
class Sheep_model extends CI_Model
{

    public function get_users_sheep(){
        $q = $this->db->query("SELECT * FROM sau AS t1 LEFT JOIN (select * from saupos t1 where t1.dato = (select max(t2.dato) from saupos t2 where t2.sauID = t1.sauID)) AS t2 on t1.ID = t2.sauID WHERE t1.ownerID = '".$_SESSION['userid']."';");
        return $q;
    }

    public function get_sheep_by_id($id){
        $q = $this->db->query("SELECT * FROM sau WHERE ID ='".$id."' LIMIT 1;");
        return $q->row();
    }

    public function insert_sheep($sheepname,$lat,$lng,$health,$birthyear,$weight,$saueid){
        $sql = "INSERT INTO sau (ID,navn,ownerID,birthYear,weight,health,color) VALUES (?,?,?,?,?,?,?)";
        $this->db->query($sql, array($saueid,$sheepname, $_SESSION["userid"], $birthyear, $weight,$health,'1'));
        $sqlpos = "INSERT INTO saupos (xpos,ypos,sauID,dato) VALUES (?,?,?,NOW());";
        $this->db->query($sqlpos,array($lat,$lng,$saueid));
    }



    public function delete_sheep($id){
        $this->db->query("DELETE FROM saupos WHERE sauID =".$id.";");
        $this->db->query("DELETE FROM sau WHERE ID =".$id.";");
    }

}
