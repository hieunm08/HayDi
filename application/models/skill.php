<?php

class Skill extends CI_Model
{

    /**
     * SkillModel constructor.
     */

  	function totalSkill()
    {
        $this->db->select('*');
        $this->db->from('skill');
        $query = $this->db->get();
        return $query->num_rows();
    }
    //phân trang
    function getAllSkill($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('skill');
        $this->db->select("*");
        $query = $this->db->get();  
        return $query->result();
    }
    function getSkillById($id)
    {
        $this->db->select("*");
        $this->db->from('skill');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function updateSkill($data, $id)
    {
        $crop_data = elements(array('name','icon','desc'), $data);
        $this->db->where('id', $id);
        $this->db->update('skill', $crop_data);

    }
    function deleteSkill($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('skill');
    }
  
}
?>