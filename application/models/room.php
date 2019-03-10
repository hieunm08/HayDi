<?php

class Room extends CI_Model
{

    /**
     * SupplerModel constructor.
     */

    function getAll()
    {
        $this->db->select();

    }

       function showIsBreakfast($is_breakfast)
    {
        if ($is_breakfast==1) {
            echo '<span class="label label-primary">'.lang('Phục vụ').'</span>';
        }else{
            echo '<span class="label label-default">'.lang('Không phục vụ').'</span>';
        }
    }

    function updateroom($data,$id){

$crop_data = elements(array('host_id','name','bed_number','bed_type','price','unit','is_breakfast','updated_at'), $data);
          $this->db->where('id',$id);
$this->db->update('room',$crop_data);
    }

 function addroom($data){
        $crop_data = elements(array('host_id','name','bed_number','bed_type','price','unit','is_breakfast','updated_at'), $data);
         $add_room = $this->db->insert_string('room', $crop_data);
        $this->db->query($add_room);
    }



    function getAllRoom($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('room');
        $this->db->select("*");
        $query = $this->db->get();  
        return $query->result();
    }
    function totalRoom()
    {
        $this->db->select('*');
        $this->db->from('room');
        $query = $this->db->get();
        return $query->num_rows();
    }
   
    function show_room_byID($room_id){
        $this->db->from('room');
        $this->db->select("*");
        $this->db->where("id",$room_id);
        $query = $this->db->get();
        return $query->result();

    }


     function getCampaignStatus($campaign_status)
    {
        if ($campaign_status==0) {
           echo '<span class="badge badge-secondary">'.lang('Inactive').'</span>';
        }else
        { 
          echo '<span class="badge badge-success">'.lang('Active').'</span>';
    }
}
    function changeCampaignStatus($id, $status){
        if ($status==1) {
            $this->db->set('status', "0");
            $this->db->where('id', $id);
            $this->db->update('campaign');
        }else {
            $this->db->set('status', "1");
            $this->db->where('id', $id);
            $this->db->update('campaign');
        }
    }

    function getAllSuppler()
    {
        $query = $this->db->query();
    }

   
    function get_Campaign_Pagination($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('campaign');
        $this->db->select("*");
        $query = $this->db->get();  
        return $query->result();
    }

 
  function search_campaign($id,$name,$updated_at,$status){
        $query = $this->db->query("SELECT * FROM campaign where id = '$id' OR  name = '%$name%' OR  updated_at = '$updated_at' OR status = '$status'");
     /*   $this->db->from('booking');
        $this->db->select("*");
        $this->db->where("book_id",$book_id);
        $query = $this->db->get();*/
        return $query->result();
    }
   
     function total_Campaign()
    {
        $this->db->select('*');
        $this->db->from('campaign');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function showCampaign($id)
    {
        $this->db->select("*");
        $this->db->from('campaign');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function updateCampaign($data, $id)
    {
        $crop_data = elements(array('name','link','desc','status','is_sponsor','updated_at', 'type'), $data);
        $this->db->where('id', $id);
        $this->db->update('campaign', $crop_data);
    }  
   function createCampaign($data)
    {
        $crop_data = elements(array('name','images','link','desc','status','is_sponsor','updated_at', 'type'), $data);
        $add_campaign = $this->db->insert_string('campaign', $crop_data);
        $this->db->query($add_campaign);
    }

    function deleteCampaign($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('campaign');
    }

  
}
?>