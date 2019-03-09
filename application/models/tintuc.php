<?php

class Tintuc extends CI_Model
{

    /**
     * NewsModel constructor.
     */

  	function totalNews()
    {
        $this->db->select('*');
        $this->db->from('news');
        $query = $this->db->get();
        return $query->num_rows();
    }
    //phân trang
    function getAllNews($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('news');
        $this->db->select("*");
        $query = $this->db->get();  
        return $query->result();
    }
    function getNewsById($id)
    {
        $this->db->select("*");
        $this->db->from('news');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function updateNews($data, $id)
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
        echo '<span class="badge badge-secondary">'.lang('Inactive').'</span>';
        }else{
        echo '<span class="badge badge-success">'.lang('Active').'</span>';
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