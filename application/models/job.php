<?php

class Job extends CI_Model
{

    /**
     * JobModel constructor.
     */

  	function totalJob()
    {
        $this->db->select('*');
        $this->db->from('jobs');
        $query = $this->db->get();
        return $query->num_rows();
    }
    //phân trang
    function getAllJob($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('jobs');
        $this->db->select("*");
        $query = $this->db->get();  
        return $query->result();
    }
    function getJobById($id)
    {
        $this->db->select("*");
        $this->db->from('jobs');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function updateJob($data, $id)
    {
        $crop_data = elements(array('name','icon','desc'), $data);
        $this->db->where('id', $id);
        $this->db->update('jobs', $crop_data);
    }
    function deleteJob($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jobs');
    }
  
}
?>