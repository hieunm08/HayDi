

        <div class="col-sm-10 col-md-12 main">
          <div class="row" >
            <div class="col-sm-10 col-md-10" style="padding-left:0px;">
                <h1 class="page-header">Đơn hàng Host</h1>
            </div>
              <button style="margin-right:10px; background:red" id="btn1"
                      class="btn btn-primary">Search Advance
              </button>
          <!--  <div class="col-sm-2 col-md-2">
               <a href="<?php /*echo base_url('admin/bookings/add_ticket'); */?>"><button type="button" class="btn btn-primary top_button"><span class="icon-plus-2"></span> <?php /*echo lang('Book a ticket');*/?></button></a>
            </div>-->
             <div id="form-search1" >
              <form  class="form-inline" method="POST" action="../admin/bookings" style="float:left;" >
                  <div class="form-group" style="width: 500px:">
                  <input style="margin:6px 6px 6px 0px; width: 20%;float: left" type="text" class="form-control"  id="item_type" name="guider_id" placeholder=" Tên Hướng Dẫn Viên">
                      <input style="margin:6px 6px 6px 0px;width: 12%;float: left" type="text" class="form-control" id="time_start"   data-date-format="DD-MM-YYYY"  name="start_day" placeholder="Ngày tạo">
                       <input style="margin:6px 6px 6px 0px;width: 12%;float: left" type="text" class="form-control" id="time_end"  data-date-format="DD-MM-YYYY" name="end_day" placeholder="Ngày kết thúc">
                <select class="form-control" name="status" style="margin:6px 6px 6px 0px;width: 15%;float: left;placeholder="BookStatus">
                    <option>Chọn Trạng Thái</option>
                    <option  value="0">Mới</option>
                    <option  value="1">Đã Thanh Toán </option>
                    <option  value="2">Hủy</option>
                    <option  value="3">Xác nhận</option>
                    <option  value="4">Hoàn thành</option>
                </select>
                      <input style="margin:6px 6px 6px 0px;width: 10%;float: left" type="text" class="form-control"  name="money"
      placeholder="Tổng tiền ">
                      <button style="margin-right:10px;" type="submit"
                              class="btn btn-primary">Tìm kiếm 
                      </button>
                  </div>
              </form>
              </div>
          </div>
        </br>
                  <div class="row">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr style="text-align: center;">
<!--                     <th><?php echo $this->session->userdata['user_id']?> STT </th>
 -->                <th>STT </th>
                    <th>Mã đơn hàng</th>
                    <th>Mã người dùng</th>
                    <th>Mã Trip </th>
                    <th>Host</th>
                    <th>Ngày bắt đầu </th>
                    <th>Ngày kết thúc</th>
                    <th>Người lớn</th>
                    <th>Trẻ em</th>
                    <th>Loại</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái thanh toán</th>
                    <th>Phương thức thanh toán</th>  
                 	<th>Trạng thái đơn hàng</th>  
                    <th>Ngày tạo</th>                               
                    <th>Ngày cập nhật</th>
                      <th width="12%" >Chức năng</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $this->load->model('booking'); ?>

                  <?php
                    if ($this->pagination->per_page >= $this->pagination->total_rows) $i =1 ;
                    else $i = 1 + ($this->pagination->cur_page-1)*$this->pagination->per_page;
                    foreach($bookings as $booking):
                  ?>
                      <tr>
	                  	<td><?php echo $i?></td>
	                  	<td><?php echo $booking->id?></td>
	                  	<td><?php echo $booking->user_id?></td>
                 		<td><?php echo $booking->trip_id?></td>
                 		<td><?php echo $booking->host_id?></td>
                        <td>
                        <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->start_day))?>
                        <div class="pull-right"><span class="icon-clock" style="color:red;"></span> <?php echo date('H:i', strtotime( $booking->start_day)) ?></div>
                      	</td>
                      	<td>
	                        <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->end_day))?>
                          	<div class="pull-right"><span class="icon-clock" style="color:red;"></span> <?php echo date('H:i', strtotime( $booking->end_day)) ?></div>
                      	</td>  
                     	<td><?php echo $booking->person_number?></td>
                     	<td><?php echo $booking->baby_number?></td>
                     	<td><?php echo $booking->host_type?></td>
                     	<td><?php echo $booking->total_money?></td>
                        <td><?php echo $this->booking->status_payment($booking->payment_status) ?> </td>
                       	<td><?php echo $this->booking->paid_type ($booking->payment_type) ?></td>
                       	<td><?php echo $this->booking->status_order($booking->status)?></td>
             			<td>
                        <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->created_at))?>
                      	</td>
                      	<td>
                        <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->updated_at))?>
                      	</td>
                      	<td style="text-align:center">
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo base_url('admin/bookings/list_host_booking_by_id/'.$booking->id); ?>" class="btn btn-default btn-xs"><span class="icon-pencil" style="color:green"></span> Update</a>
                                        </div>
                                    </td> 
                    </tr>
                  <?php $i++; endforeach; ?>

                </tbody>
              </table>
            </div>
            <ul class="pagination"><?php echo $links ?></ul>
          </div>
         </div>
