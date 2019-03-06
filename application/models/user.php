<?php
Class User extends CI_Model
{
	function validate()
	{
	   $this->db->where('username', $this->input->post('username'));
	   $this->db->where('password', MD5($this->input->post('password')));
	   $this->db->where('blocked', "0");
	

	   $query = $this->db->get('users_admin');

	   if($query->num_rows != 0)
	   {
	     return true;
	   }

	 }
	function showStatus($status){
		if ($status==0) {
           echo '<span class="label label-default">'.lang('Block').'</span>';
        }else
        { 
          echo '<span class="label label-success">'.lang('Active').'</span>';
    }
	} 

 	function showRole($role)
	{
		if ($role==0) {
			return "Quản trị";
		}else{
			return "Nhân viên";
		}
		
	}
	function show_users($limit, $start)
	{
		$this->db->limit($limit, $start);
		$this->db->where('id !=', 1);
	 	$query = $this->db->get('users_admin');
	 	return $query->result();
	}
	function get_user($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('users_admin');
		if($query->num_rows() > 0)
		{
			$row = $query->row();
		}

	 	return $row;
	}
	function save_user($data, $id)
	{

		if (empty($data['password'])) {
			$crop_data = elements(array('firstname','lastname','username','role','email'), $data);
		} else {
			$crop_data = elements(array('firstname','lastname','username','password','role','email'), $data);
		}

		$this->db->where('id', $id);
		$this->db->update('users_admin', $crop_data);
	}
	function create_user($data)
	{
		$crop_data = elements(array('firstname','lastname','username','password','role','email'), $data);
		$add_user = $this->db->insert_string('users_admin', $crop_data);
		$this->db->query($add_user);
	}
	function delete_member($id)
	{
		$this->db->where('id', $id);
     	$this->db->delete('users_admin');
	}
	function block_member($id)
	{
		$this->db->set('blocked', "1");
		$this->db->where('id', $id);
     	$this->db->update('users_admin');
	}
	function unblock_member($id)
	{
		$this->db->set('blocked', "0");
		$this->db->where('id', $id);
     	$this->db->update('users_admin');
	}
	function member_role($username){
		$this->db->select('role');
		$this->db->where('username',$username);
		$query = $this->db->get('users_admin');

		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->role;
		}
	}
	function member_id($username){
		$this->db->select('id');
		$this->db->where('username',$username);
		$query = $this->db->get('users_admin');

		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->id;
		}
	}
	function member_firstname($username){
		$this->db->select('firstname');
		$this->db->where('username',$username);
		$query = $this->db->get('users_admin');

		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->firstname;
		}
	}
	function member_language($username){
		$this->db->select('language');
		$this->db->where('username',$username);
		$query = $this->db->get('users_admin');

		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->language;
		}
	}
}
?>
