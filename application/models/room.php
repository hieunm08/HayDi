<?php

class Room extends CI_Model
{

    /**
     * Room constructor.
     */

    function showIsBreakfast($is_breakfast)
    {
        if ($is_breakfast==1) {
            echo '<span class="label label-primary">'.lang('Phục vụ').'</span>';
        }else{
            echo '<span class="label label-default">'.lang('Không phục vụ').'</span>';
        }
    }
    function totalRoom()
    {
        $this->db->select('*');
        $this->db->from('room');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     function getRoom(){
        $this->db->select("*");
        $this->db->from('room');
        $query = $this->db->get();
        return $query->result();   
    }
    function getAllRoom($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('room');
        $this->db->select("*");
        $query = $this->db->get();  
        return $query->result();
    }
    function getRoomById($id)
    {
        $this->db->select("*");
        $this->db->from('room');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function updateRoom($data, $id)
    {
        if (empty($data['images'])) {
            $crop_data = elements(array('bed_number','bed_type','price','unit','is_breakfast','updated_at'), $data);
        }else{
            $crop_data = elements(array('images','bed_number','bed_type','price','unit','is_breakfast','updated_at'), $data);
        }
        $edit_room = $this->db->insert_string('room', $crop_data);
        $this->db->query($edit_room);
    }
    function createRoom($data)
    {
        if (empty($data['images'])) {
            $crop_data = elements(array('host_id','name','bed_number','bed_type','price','unit','is_breakfast','updated_at'), $data);
        }else{
            $crop_data = elements(array('host_id','name','images','bed_number','bed_type','price','unit','is_breakfast','updated_at'), $data);
        }
        $add_room = $this->db->insert_string('room', $crop_data);
        $this->db->query($add_room);
    }
    function deleteRoom($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('room');
    }

   
}

    ?>