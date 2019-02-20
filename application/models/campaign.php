<?php

class Campaign extends CI_Model
{

    /**
     * SupplerModel constructor.
     */

    function getAll()
    {
        $this->db->select();

    }

    function show_Supplier_Type($supplier_type)
    {
        if ($supplier_type==0) {
            echo '<span class="label label-primary">'.lang('Homestay').'</span>';
        }else if($supplier_type==1)
        { 
            echo '<span class="label label-success">'.lang('Guide').'</span>';
    }else{
            echo '<span class="label label-info">'.lang('Car').'</span>';
    }
}

     function getCampaignStatus($campaign_status)
    {
        if ($campaign_status==0) {
           echo '<span class="label label-default">'.lang('Inactive').'</span>';
        }else
        { 
          echo '<span class="label label-success">'.lang('Active').'</span>';
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
        $crop_data = elements(array('name','images','link','desc','status','is_sponsor','updated_at', 'type'), $data);
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