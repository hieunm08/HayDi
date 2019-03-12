<?php

class Host_service extends CI_Model
{

    /**
     * Host_service constructor.
     */

    function totalHostService()
    {
        $this->db->select('*');
        $this->db->from('host_service');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     function getHostService(){
        $this->db->select("*");
        $this->db->from('host_service');
        $query = $this->db->get();
        return $query->result();   
    }
    function getAllHostService($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('host_service');
        $this->db->select("*");
        $query = $this->db->get();  
        return $query->result();
    }
    function getHostServiceById($id)
    {
        $this->db->select("*");
        $this->db->from('host_service');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function updateHostService($data, $id)
    {
        $crop_data = elements(array('name','icon','desc'), $data);
        $this->db->where('id', $id);
        $this->db->update('host_service', $crop_data);
    }
    function createHostService($data)
    {
        if (empty($data['cost'])) {
            $crop_data = elements(array('host_id','service_id','access'), $data);
        }else{
            $crop_data = elements(array('host_id','service_id','access','cost','unit'), $data);
        }
        $add_host_service = $this->db->insert_string('host_service', $crop_data);
        $this->db->query($add_host_service);
    }
    function deleteHostService($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('host_service');
    }

   
}

    ?>