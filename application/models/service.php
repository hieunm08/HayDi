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
    
     function getService(){
        $this->db->select("*");
        $this->db->from('service');
        $query = $this->db->get();
        return $query->result();   
    }
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
    function createService($data)
    {
        $crop_data = elements(array('name','icon','desc'), $data);
        $add_service = $this->db->insert_string('service', $crop_data);
        $this->db->query($add_service);
    }
    function deleteService($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('service');
    }
    function getServiceName($id){
        $this->db->select('name');
        $this->db->where('id',$id);
        $query = $this->db->get('service');

        if ($query->num_rows() > 0)
        {
           $row = $query->row();
           return $row->name;
        }
    }
  
}
?>