

        <div class="content-wrapper">
          <div class="row" >
            <div class="col-sm-10 col-md-10" style="padding-left:0px;">
                <h1 class="page-header">Đơn hàng hướng dẫn viên</h1>
            </div>
              
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
                    <th>Mã Order</th>
                    <th>Mã Trip </th>
                    <th>Hướng dẫn viên</th>
                    <th>Ngày bắt đầu </th>
                    <th>Ngày kết thúc</th>
                    <th>Giờ</th>
                    <th>Thời gian bắt đầu</th>
                    <th>Vị trị </th>
                    <th>Lat</th>
                    <th>Lon</th>
                    <th>Ghi Chú</th>
                    <th>Trạng thái thanh toán</th>
                    <th>Phương thức thanh toán</th>
                    <th>Trạng thái đơn hàng</th>  
                    <th>Tổng tiền</th>                                    
                    <th>Ngày cập nhật</th>
                      <th width="12%" ><?php echo lang('Options');?></th>
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
                      <td><?php echo $booking->guider_id?></td>
                         <td><?php echo $booking->trip_id?></td>
                          <!--                          <td><?php /*echo ($this->booking->get_amount($booking->from)) */?></td>
                          -->
                        <td>
                        <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->start_day))?>
                        <div class="pull-right"><span class="icon-clock" style="color:red;"></span> <?php echo date('H:i', strtotime( $booking->start_day)) ?></div>
                      </td>
                      <td>
<!--                        --><?php /*if($booking->returning == '2') { //1 = one way; 2 = returning ticket */?>
                            <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->end_day))?>
                          <div class="pull-right"><span class="icon-clock" style="color:red;"></span> <?php echo date('H:i', strtotime( $booking->end_day)) ?></div>
<!--                        --><?php /*} */?>
                      </td>  
                         <td><?php echo $booking->hours?></td>
                          <!-- <td>
                        <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->time_start))?>
                        <div class="pull-right"><span class="icon-clock" style="color:red;"></span> <?php echo date('H:i', strtotime( $booking->time_start)) ?></div>
                      </td> <--></-->
                <td><?php echo $booking->start_day?></td>

                    <td><?php echo $booking->address_meet?></td>
                      <td><?php echo $booking->lat?></td>
                      <td><?php echo $booking->lon?></td>
                      <td><?php echo $booking->note?></td>
                     <td><?php echo $this->booking->status_payment($booking->payment_status) ?> </td>
                        <td><?php echo $this->booking->paid_type ($booking->payment_type) ?></td>
                        <td><?php echo $this->booking->status_order($booking->status)?></td>
                        <td><?php echo $booking->money?></td>
                        <td>
                        <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->created_at))?>
                        <div class="pull-right"><span class="icon-clock" style="color:red;"></span> <?php echo date('H:i', strtotime( $booking->created_at)) ?></div>
                      </td>

                        <td style="text-align:center">
                        <div class="btn-group" role="group">
                          <?php if($booking->status == 2){?>
                                <a href="<?php echo base_url('admin/bookings/nocancel_trips/'.$booking->id); ?>" class="btn btn-default btn-xs active"><span class="icon-plus" style="color:blue"></span>Hoàn Hủy</a>
                            <?php }else{?>
                                <a href="<?php echo base_url('admin/bookings/cancel_trips/'.$booking->id); ?>" class="btn btn-default btn-xs"><span class="icon-minus" style="color:red"></span> Hủy </a>
                            <?php }?>
                          <a href="<?php echo base_url('admin/bookings/list_booking_byID/'. $booking->id) ?>" target="_blank" class="btn btn-default btn-xs"><span class="icon-pencil" style="color:green"></span> Update</a>
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
