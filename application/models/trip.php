<?php

class Trip extends CI_Model
{

    /**
     * TripModel constructor.
     */

  	function totalTrip()
    {
        $this->db->select('*');
        $this->db->from('trips');
        $query = $this->db->get();
        return $query->num_rows();
    }
    //phân trang
    function getAllTrips($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('trips');
        $this->db->select("*");
        $query = $this->db->get();  
        return $query->result();
    }
    function getTripsById($id)
    {
        $this->db->select("*");
        $this->db->from('trips');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function updateTrips($data, $id)
    {
        $crop_data = elements(array('title','thumb','link','intro','content','status','group_id','updated_at'), $data);
        $this->db->where('id', $id);
        $this->db->update('news', $crop_data);
    }  
    function changeNewsStatus($id, $status)
	{
        if ($status==0) {
            $query = $this->db->query("UPDATE news SET status = '1' WHERE id = '$id' ");
        }else {
            $query = $this->db->query("UPDATE news SET status = '0' WHERE id = '$id' ");
        }
	}
    function createNews($data)
    {
        $crop_data = elements(array('title','thumb','link','intro','content','status','group_id','updated_at'), $data);
        $add_news = $this->db->insert_string('news', $crop_data);
        $this->db->query($add_news);
    }
    function showNewsStatus($status)
    {
        if ($status==0) {
        echo '<span class="label label-default">'.lang('Inactive').'</span>';
        }else{
        echo '<span class="label label-success">'.lang('Active').'</span>';
        }
    }
    function getNewsGroupById($id)
    {
        $this->db->select('*');
        $this->db->from('news_group');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function getNewsGroup()
    {
        $this->db->select('*');
        $this->db->from('news_group');
        $query = $this->db->get();
        return $query->result();
    }
    function deleteNews($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('news');
    }

  
}
?>