<?php

class Sponsor extends CI_Model
{

    /**
     * SponsorModel constructor.
     */

  	function totalSponsor()
    {
        $this->db->select('*');
        $this->db->from('sponsor');
        $query = $this->db->get();
        return $query->num_rows();
    }
    //phân trang
    function getAllSponsor($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('sponsor');
        $this->db->select("*");
        $query = $this->db->get();  
        return $query->result();
    }
    function changeStatusSponsor($id, $status)
	{
        if ($status==0) {
            $query = $this->db->query("UPDATE sponsor SET status = '1' WHERE id = '$id' ");
        }else {
            $query = $this->db->query("UPDATE sponsor SET status = '0' WHERE id = '$id' ");
        }
	}

  
}
?>