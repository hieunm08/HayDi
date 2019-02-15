<?php

class Service extends CI_Model
{

    /**
     * ServiceModel constructor.
     */

  	function totalService()
    {
        $this->db->select('*');
        $this->db->from('service');
        $query = $this->db->get();
        return $query->num_rows();
    }
    //phân trang
    function getAllService($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('service');
        $this->db->select("*");
        $query = $this->db->get();  
        return $query->result();
    }
    function getServiceById($id)
    {
        $this->db->select("*");
        $this->db->from('service');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function updateService($data, $id)
    {
        $crop_data = elements(array('name','icon','desc'), $data);
        $this->db->where('id', $id);
        $this->db->update('service', $crop_data);
    }
    function deleteService($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('service');
    }
  
}
?>