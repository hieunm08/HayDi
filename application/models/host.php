<?php

class Host extends CI_Model
{

    /**
     * HostModel constructor.
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
    function showIsFull($actice_guide)
    {
        if ($actice_guide==0) {
           echo '<span class="label label-success">'.lang('Còn phòng').'</span>';
        }else
        { 
          echo '<span class="label label-default">'.lang('Hết phòng').'</span>';
    }
}
     function showType($type)
    {
        if ($type=="host") {
           echo '<span class="label label-success">'.lang('host').'</span>';
        }else
        { 
          echo '<span class="label label-primary">'.lang('hotel').'</span>';
    }
}
     function getHostStatus($host_status)
    {
        if ($host_status="active") {
           echo '<span class="label label-success">'.lang('Active').'</span>';
        }else
        { 
          echo '<span class="label label-default">'.lang('Inactive').'</span>';
    }
}
    function changeHostStatus($id, $status){
        if ($status="active") {
    	 	 $query = $this->db->query("UPDATE host SET status = 'inactive' WHERE id = '$id' ");
    	 	 echo "hoan thanh";
        }else {
             $query = $this->db->query("UPDATE host SET status = 'active' WHERE id = '$id' ");
        }
    }

   
     function getAllHost($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('host');
        $this->db->select("*");
        $query = $this->db->get();  
        return $query->result();
    }
   
    function show_all_host($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('host');
        $this->db->select("*");
        $query = $this->db->get();  
        return $query->result();
    }

    function check_all_id($id)
    {
//        $data = null;
//        $query = $this->db->query("SELECT sup_id FROM supplier_mst WHERE `sup_id`='$id'");
//        $data = $query->result();
//        echo "dung123...". $data;

        $this->db->select("supplier_ID");
        $this->db->from('supplier_mst');
        $this->db->where('supplier_ID', $id);
        $query = $this->db->get();
        $data= $query->result();

        if ($data!=null){
//            echo "co id nay..";
            return true;
        }else{
//            echo "khong co id nay ...";
            return false;
        }
    }

    function total_hosts()
    {
        $this->db->select('*');
        $this->db->from('host');
        $query = $this->db->get();
        return $query->num_rows();
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

    function getHostById($id)
    {
        $this->db->select("*");
        $this->db->from('host');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    //phuong thuc xoa

    function deleteHost($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('host');
    }
   
  

  
}
?>