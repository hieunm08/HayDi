<?php
Class Booking extends CI_Model
{
/*	function show_booking_status($booking_status)
	{
		if ($booking_status==0) {
			return "Holding";
		}elseif ($booking_status==1)
		{ 
			return "Paid";
		}else return "Expired";
	}*/

	/*function show_bookings($limit, $start, $user_id = '')
	{

		$this->db->limit($limit, $start);
		$this->db->order_by('created_time','desc');
		$this->db->from('bookings', 'tours');
	 	$this->db->join('tours', 'tours.tour_id = bookings.tour_id');
		if($user_id != '')
			$this->db->where('created_by', $user_id);
	 	$query = $this->db->get();
	 	return $query->result();
	}*/

    function show_bookings($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('orders');
        $this->db->order_by('id','desc');
        $this->db->select("*");
        $query = $this->db->get();
        return $query->result();

    }

    function show_bookings_id($book_id)
    {
        $this->db->from('orders');
        $this->db->select("*");
        $this->db->where("id",$book_id);
        $query = $this->db->get();
        return $query->result();
    }
    function search_bookings_id($book_cd1,$customer1)
    {

        $query = $this->db->query("SELECT * FROM booking where book_id = '$book_cd1' OR  customer like '%$customer1%'");
     /*   $this->db->from('booking');
        $this->db->select("*");
        $this->db->where("book_id",$book_id);
        $query = $this->db->get();*/
        return $query->result();
    }


    static function status_order($status){
        if ($status == 0) {
            echo '<span class="label label-success">'.lang('Mới').'</span>';
        }else if ($status == 1) {
            echo '<span class="label label-default">'.lang('Đã thanh toán').'</span>';
        }
        else {  echo '<span class="label label-default">'.lang('Hủy bỏ').'</span>';
        }
    }

    function cancel_trips($id)
	{

		$this->db->set('status', "2");
		$this->db->where('id', $id);
     	$this->db->update('orders');
/*		$query = $this->db->query("UPDATE trips set status='3' WHERE id='$id'") 
*/	}

function nocancel_trips($id)
	{

		$this->db->set('status', "0");
		$this->db->where('id', $id);
     	$this->db->update('orders');

    function update_booking($item_type,$trip_id,$note,$status,$updated_at,$money,$cancel_money,$coupon_code,$coupon_value,$id)
    {

    /*	$updated_at = strtotime($time_start);*/
		        $query = $this->db->query("UPDATE orders SET item_type='$item_type'trip_id='$trip_id', note='$note', status='$status',updated_at='$updated_at', money='$money',cancel_money='$cancel_money', coupon_code='$coupon_code', coupon_value='$coupon_value'  WHERE id = '$id'");

    }

/*    function search_bookingID($customer, $phone, $trip_no, $route, $route, $fromdate,$todate,$price,$PIC,$detail_booking,$book_status,$payment_status,$book_id){
        $this->db->select("');
        $this->db->from('booking');
        $this->db->where('booking');
*/



    }

    /*function get_amount( $book_id ){

        $time_stamp = strtotime($this->db->query("SELECT fromdate FROM `booking` WHERE book_id,$book_id"));
        $new = strtotime($this->db->query("SELECT todate FROM `booking` WHERE book_id,$book_id"));
        $a= $time_stamp - $new;


    }*/





	/*function get_company_info()
	{
		$this->db->from('settings');
	 	$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $row;
		}
	}

	/*function show_booking_date($book_id){
		$this->db->select('fromdate');
		$this->db->where('book_id', $book_id);

	 	if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->fromdate;
		}
	}*/
    function get_city_name($id){
		$this->db->select('city');
		$this->db->where('destination_id', $id);
		$query = $this->db->get('destinations');
		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->city;
		}
	}
	/*function get_username($id){
		$this->db->select('username');
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->username;
		}

	}*/

	/*function check_available_tours($from, $to, $returning, $depart_date='', $return_date=''){
	$data = array();

	$query_currency = $this->db->query("SELECT symbol,iso FROM currency JOIN settings ON settings.company_currency = currency.currency_id LIMIT 1");
	$currency = $query_currency->row();

	if(isset($depart_date) && !empty($depart_date))
		$start_time = $depart_date;
	else
		$start_time =  date('Y-m-d');

	//$query = $this->db->query("SELECT tour_id, from_start_time,start_price, available_seats FROM tours WHERE (`from` = '$from' AND `to` = '$to') AND `from_start_time` >= '$start_time'");

	$query = $this->db->query("SELECT tours.tour_id, tours.from_start_time,tours.start_price, tours.available_seats - 
				 sum(bookings.booked_seats) AS available_seatss
				 FROM tours LEFT JOIN bookings
				 ON tours.tour_id = bookings.tour_id
				 WHERE (`from` = '$from' AND `to` = '$to') AND `from_start_time` >= '$start_time'
				 GROUP BY tours.tour_id, tours.from_start_time,tours.start_price, tours.available_seats ");
	//
	if($returning == 'true'){ //false in quotes because php doest read it as boolean
		if(isset($depart_date) && !empty($depart_date))
			$start_time = $depart_date;
		else 
			$start_time =  date('d.m.Y');

		//$query_back = $this->db->query("SELECT tour_id, from_start_time, start_price, available_seats FROM tours WHERE (`from` = '$to' AND `to` = '$from') AND `from_start_time` > '$start_time'");
		$query = $this->db->query("SELECT tours.tour_id, tours.from_start_time,tours.start_price, tours.available_seats - 
				 bookings.booked_seats AS available_seatss
				 FROM tours LEFT JOIN bookings
				 ON tours.tour_id = bookings.tour_id
				 WHERE (`from` = '$from' AND `to` = '$to') AND `from_start_time` >= '$start_time'
				 GROUP BY tours.tour_id, tours.from_start_time,tours.start_price, tours.available_seats");
	}

		if ($query->num_rows() > 0) {
			$one_way = [];
			foreach($query->result() as $row) {
    			$data[$row->tour_id] = ['ticket_type' => 'one_way', 'start_time' => date('d.m.Y', strtotime($row->from_start_time)), 'start_price' => $row->start_price, 'seats' => $row->available_seatss, 'currency' =>  $currency->symbol.' ('.$currency->iso.')'];
    		}
		}

		if ($returning == 'true' && $query_back->num_rows() > 0) {
			$returning = [];
			foreach($query_back->result() as $row_back) {
    			$data[$row_back->tour_id] = ['ticket_type' => 'returning', 'start_time' => date('d.m.Y', strtotime($row_back->from_start_time)), 'start_price' => $row_back->start_price,'seats' => $row->available_seatss, 'currency' =>  $currency->symbol.' ('.$currency->iso.')'];

    		}
		}

		return $json = json_encode($data);
	}*/

	/*function get_booking($id)
	{
		$this->db->from('bookings', 'tours');
	 	$this->db->join('tours', 'tours.tour_id = bookings.tour_id');

		$this->db->where('booking_id', $id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
		}

	 	return $row;
	}*/
	/*function get_booking_returned($id)
	{
		$this->db->from('bookings', 'tours');
	 	$this->db->join('tours', 'tours.tour_id = bookings.tour_back_id');

		$this->db->where('booking_id', $id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $row;
		}
		else{
			return false;
		}
	}
	function save_booking($data, $id)
	{

		$data['tour_id'] = element('choose_from', $data);
		$data['tour_back_id']  = element('choose_back', $data);
		$data['modified_by'] = $this->session->userdata['user_id'];
		$crop_data = elements(array('tour_id','tour_back_id','booked_seats','client_firstname','client_lastname','identification_nr','returning','modified_by'), $data);
		$this->db->where('booking_id', $id);
		$this->db->update('bookings', $crop_data);

	}*/
	

	function delete_booking($id)
	{
		$this->db->where('booking_id', $id);
     	$this->db->delete('bookings');
	}
	
}
?>