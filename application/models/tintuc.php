<?php

class Tintuc extends CI_Model
{

    /**
     * NewsModel constructor.
     */

  	function totalNews()
    {
        $this->db->select('*');
        $this->db->from('news');
        $query = $this->db->get();
        return $query->num_rows();
    }
    //phân trang
    function getAllNews($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('news');
        $this->db->select("*");
        $query = $this->db->get();  
        return $query->result();
    }
    function changeStatusNews($id, $status)
	{
        if ($status==0) {
            $query = $this->db->query("UPDATE news SET status = '1' WHERE id = '$id' ");
        }else {
            $query = $this->db->query("UPDATE news SET status = '0' WHERE id = '$id' ");
        }
	}

  
}
?>