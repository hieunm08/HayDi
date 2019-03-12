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

     public function search_list_host($id,$user_id,$name,$email,$phone,$address,$status,$type,$is_full)
     {
         $where = '1=1';
        if(isset($id) && $id!=null && !empty($id)) { $where.=" and id ='".$id ."'";}
        if(isset($user_id) && $user_id!=null && !empty($user_id)) { $where.=" and user_id ='".$user_id ."'";}

        if(isset($name) && $name!=null && !empty($name)) { $where.=" and name ='".$name."'" ;}
        if(isset($phone) &&$phone!=null && !empty($phone)) { $where.=" and phone ='".$phone."'" ;}
        if(isset($email) && $email!=null && !empty($email)) { $where.=" and email ='".$email."'" ;}
        if(isset($address) && $address!=null && !empty($address)) { $where.=" and address ='".$address."'" ;}
        if(isset($status) && $status!=null && !empty($status)) { $where.=" and status ='".$status."'" ;}
        if(isset($type) && $type!=null && !empty($type)) { $where.=" and type ='".$type."'" ;}
        if(isset($is_full) && $type!=null && !empty($is_full)) { $where.=" and is_full ='".$type."'" ;}
        $this->db->select('*');
        $this->db->from('host');
        $this->db->where($where, NULL, FALSE);
        $query = $this->db->get();
        return $query->result();
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
    function getHostByTypeHost()
    {
        $this->db->select("*");
        $this->db->from('host');
        $this->db->where('type', 'host');
        $query = $this->db->get();
        return $query->result();
    }
    function getHotel()
    {
        $this->db->select("*");
        $this->db->from('host');
        $this->db->where('type', 'hotel');
        $query = $this->db->get();
        return $query->result();
    }
    function getAllHostName()
    {
        $this->db->select("*");
        $this->db->from('host');
        $query = $this->db->get();
        return $query->result();
    }

    //phuong thuc xoa

    function deleteHost($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('host');
    }

    function getHostName($id){
        $this->db->select('name');
        $this->db->where('id',$id);
        $query = $this->db->get('host');

        if ($query->num_rows() > 0)
        {
           $row = $query->row();
           return $row->name;
        }
    }
    function getHotelName($id){
        $this->db->select('name');
        //$where = "id='$id' AND type='boss' ";
        $this->db->where('id',$id);
        $this->db->where('type','hotel');
        $query = $this->db->get('host');

        if ($query->num_rows() > 0)
        {
           $row = $query->row();
           return $row->name;
        }
    }

   
  

  
}
?>