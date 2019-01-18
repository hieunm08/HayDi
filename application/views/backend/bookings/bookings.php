
        <div class="col-sm-10 col-md-11 main">
          <div class="row" >
            <div class="col-sm-10 col-md-10" style="padding-left:0px;">
                <h1 class="page-header"><?php echo lang('Bookings');?></h1>
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
                      <input type="text" class="form-control" id="booking_search" name="booking_search"
                             placeholder="Từ khóa">
                      <button style="margin-right:10px;" type="submit"
                              class="btn btn-primary"><?php echo lang('Search supplier'); ?>Tìm kiếm 
                      </button>
                  </div>
              </form>
              </div>
          </div>
        </br>
            <div class="row" >
                <div id="form-search2" style="display: block">
                <h4> Search Detail</h4>
            <div class="form-2" style="float: left; padding-right: 40px;width: 100%; display: ">
                      <input style="margin:6px 6px 6px 0px; width: 10%;float: left" type="text" class="form-control"  id="supplier_search" name="supplier_search"
                             placeholder="Tên">
                      <input style="margin:6px 6px 6px 0px;width: 20%;float: left" type="text" class="form-control" id="supplier_search" name="supplier_search"
                             placeholder="ID Hướng dẫn viên">
                      <input style="margin:6px 6px 6px 0px;width: 10%;float: left" type="text" class="form-control" id="supplier_search" name="supplier_search"
                             placeholder="Ngày tạo">
                <input style="margin:6px 6px 6px 0px;width: 10%;float: left" type="text" class="form-control" id="supplier_search" name="supplier_search"
                             placeholder="Số ngày ">

                <select class="form-control" name="BookStatus" style="margin:6px 6px 6px 0px;width: 13%;float: left;placeholder="BookStatus">
                    <option  value="0" >Paid</option>
                    <option  value="1">Holding</option>
                    <option  value="2">Expired</option>
                </select>

                          <button style="margin-right:5px;margin-bottom: 5px; margin-top:5px;float: left" type="submit"
                                  class="btn btn-primary"><?php echo lang('Search supplier'); ?>Tìm kiếm
                          </button>
                      </div>
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
                    <th>ID Trip</th>
                    <th>Tên Khách Hàng</th>
                    <th>Ngày bắt đầu </th>
                    <th>Ngày kết thúc</th>
                    <th>Số ngày</th>
                    <th>Số đêm</th>
                    <th>Hướng dẫn viên</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th> Ngày cập nhật</th>
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
                      <td><?php echo $booking->name?></td>
                      <td>
                        <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->time_start))?>
                        <div class="pull-right"><span class="icon-clock" style="color:red;"></span> <?php echo date('H:i', strtotime( $booking->time_start)) ?></div>
                      </td>
                      <td>
<!--                        --><?php /*if($booking->returning == '2') { //1 = one way; 2 = returning ticket */?>
                            <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->time_end))?>
                          <div class="pull-right"><span class="icon-clock" style="color:red;"></span> <?php echo date('H:i', strtotime( $booking->time_end)) ?></div>
<!--                        --><?php /*} */?>
                      </td>
                          <td><?php echo $booking->days ?></td>
                          <td><?php echo $booking->nights ?></td>

                          <!--                          <td><?php /*echo ($this->booking->get_amount($booking->from)) */?></td>
                          -->
                          <td><?php echo $booking->guider_id ?></td>
                          <td><?php echo $this-> booking->status_order ($booking->status) ?> </td>
                          <td>
                        <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->created_at))?>
                        <div class="pull-right"><span class="icon-clock" style="color:red;"></span> <?php echo date('H:i', strtotime( $booking->created_at)) ?></div>
                      </td>
                        <td>
                        <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->updated_at))?>
                        <div class="pull-right"><span class="icon-clock" style="color:red;"></span> <?php echo date('H:i', strtotime( $booking->updated_at)) ?></div>
                      </td>
                        <td style="text-align:center">
                        <div class="btn-group" role="group">
                          <?php if($booking->status == 3){?>
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
