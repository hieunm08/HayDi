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
    function getSponsorById($id)
    {
        $this->db->select("*");
        $this->db->from('sponsor');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function updateSponsor($data, $id)
    {
        $data['time_start'] = date('Y-m-d', strtotime(element('date_start', $data))). ' ' .(element('time_start', $data));
        $data['time_end'] = date('Y-m-d', strtotime(element('time_end', $data))). ' ' .(element('time_end', $data));
        $crop_data = elements(array('type','time_start','time_end','sponsor_money','status'), $data);
        $this->db->where('sponsor_id', $id);
        $this->db->update('sponsor', $crop_data);
    }
    function createSponsor($data)
    {
        $data['time_start'] = date('Y-m-d', strtotime(element('date_start', $data))). ' ' .(element('time_start', $data));
        $data['time_end'] = date('Y-m-d', strtotime(element('time_end', $data))). ' ' .(element('time_end', $data));
        $crop_data = elements(array('type','sponsor_id','time_start','time_end','sponsor_money','status'), $data);
        $add_sponsor = $this->db->insert_string('sponsor', $crop_data);
        $this->db->query($add_sponsor);
    }
    function showSponsorStatus($status)
    {
        if ($status==0) {
        echo '<span class="label label-default">'.lang('Inactive').'</span>';
        }else{
        echo '<span class="label label-success">'.lang('Active').'</span>';
        }
    }
    function changeSponsorStatus($id, $status)
	{
        if ($status==0) {
            $query = $this->db->query("UPDATE sponsor SET status = '1' WHERE id = '$id' ");
        }else {
            $query = $this->db->query("UPDATE sponsor SET status = '0' WHERE id = '$id' ");
        }
	}

  
}
?>