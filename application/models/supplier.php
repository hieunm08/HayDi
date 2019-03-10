<?php

class Supplier extends CI_Model
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
            echo '<span class="badge badge-success">'.lang('Guide').'</span>';
    }else{
            echo '<span class="label label-info">'.lang('Car').'</span>';
    }
}

    function show_Supplier_Status($supplier_status)
    {
    if ($supplier_status==0) {
    echo '<span class="badge badge-success">'.lang('Inactive').'</span>';
    }else
    {
    echo '<span class="badge badge-success">'.lang('Active').'</span>';
    }
    }
    function showActiveGuider($active_guide)
    {
    if ($active_guide==0) {
    echo '<span class="badge badge-secondary">'.lang('Chưa kích hoạt').'</span>';
    }else
    {
    echo '<span class="badge badge-success">'.lang('Đã kích hoạt').'</span>';
    }
    }
    function activeGuider($id, $active_guide){
        if ($active_guide==0) {
            $query = $this->db->query("UPDATE users SET active_guide = '1' WHERE id = '$id' ");
        }else {
            $query = $this->db->query("UPDATE users SET active_guide = '0' WHERE id = '$id' ");
        }
    }

    function getAllSuppler()
    {
        $query = $this->db->query();
    }

    //insert data
    function insert_infomation( $supplier_User, $supplier_Pass, $supplier_Fullname, $supplier_Type, $supplier_Status)
    {
        //dang loi
        $query = $this->db->query("INSERT INTO supplier_mst(supplier_User, supplier_Pass, supplier_Fullname, supplier_Type, supplier_Status) 
                    VALUES('$supplier_User','$supplier_Pass','$supplier_Fullname','$supplier_Type','$supplier_Status')");
    }

   
    function saveSupplier($data, $id)
    {
       if (!empty($data['password'])) {
        $crop_data = elements(array('name','phone','password','email','sub_phone','address','country_code','level','type','status','languages','price','unit','updated_at','description'), $data);
        }else{
             $crop_data = elements(array('name','phone','email','sub_phone','address','country_code','level','type','status','languages','price','unit','updated_at','description'), $data);
        }
        $this->db->where('id', $id);
        $this->db->update('users', $crop_data);

    }
        //tim kiem tat ca
    function Find_Supplier($supplier_search)
    {
           $query = $this->db->query("SELECT * FROM supplier_mst WHERE supplier_User LIKE '%$supplier_search%' OR supplier_Fullname LIKE '%$supplier_search%' OR supplier_Type LIKE '$supplier_search'  ");
           return $query->result();
    }
        //tim kiem theo muc
    function Find_Supplier_By_Item($supplier_u, $supplier_f, $supplier_t, $supplier_s)
    {
           $query = $this->db->query("SELECT * FROM supplier_mst WHERE supplier_User LIKE '%$supplier_u%' OR supplier_Fullname LIKE '%$supplier_f%' OR supplier_Type LIKE '$supplier_t' OR supplier_Status LIKE '$supplier_s'  ");
           return $query->result();
    }
    function show_all_suppliers($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('users');
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

     function total_suppliers()
    {
        $this->db->select('*');
        $this->db->from('users');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function show_suppliers( $id)
    {
//        $this->db->limit($limit, $start);
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    //phuong thuc xoa

    function delete_supplier($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }
    function getCityCode(){
        $this->db->select("*");
        $this->db->from('country');
        $query = $this->db->get();
        return $query->result();   
    }

  
}
?>