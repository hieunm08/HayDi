 <div class="col-sm-10 col-md-11 main">
          <div class="row" >
            <div class="col-sm-12 col-md-12" style="padding-left:0px;">
             <h1 class="page-header"><a href="<?php echo base_url().'admin/bookings' ?>"><i class="icon-arrow-left-3"></i></a> Update Booking</h1>
            </div>
          </div>
     <div class="row">
         <div class="col-sm-5 col-md-5">
             <?php $this-> load->model('booking'); ?>
         <?php foreach ($bookings as $booking): ?>
<form method="GET" action="../updatebooking">
             <div class="form-group">
                 <label for="customer"> Mã Order</label>
                 <input type="text" disabled class="form-control" name="id" value="<?php echo ( $booking->id ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div  class="form-group">
                 <label for="dateandtime">Ngày bắt đầu </label>
                 <div class="row">
                     <div class="col-md-6  date" id='datepicker_nbd'>
                         <input type="text" disabled=""class="form-control" name="time_start" data-date-format="DD-MM-YYYY" value="<?php echo set_value('time_start', date('d-m-Y', strtotime($booking->time_start))); ?>">
                         <span class="input-group-addon"><span class="icon-calendar"></span>
                          </span>
                     </div>
                     
                     <div class="col-md-6  date" id='timepicker_nbd'>
                         <input type="text" disabled="" class="form-control" name="time_start" data-date-format="HH:mm" value="<?php echo set_value('time_start', date('H:i', strtotime($booking->time_start))); ?>">
                         <span class="input-group-addon" ><span class="icon-clock"></span>
                          </span>
                         <?php echo form_error('time_start'); ?>
                     </div>
                 </div>
             </div>
             <div  class="form-group">
                 <label for="dateandtime">Ngày kết thúc</label>
                 <div class="row">
                     <div class="col-md-6  date" id='datepicker_nkt'>
                         <input type="text" disabled=""class="form-control" name="time_end" data-date-format="DD-MM-YYYY" value="<?php echo set_value('from_start_date', date('d-m-Y', strtotime($booking->time_end))); ?>">
                         <span class="input-group-addon"><span class="icon-calendar"></span>
                          </span>
                     </div>
                     <div class="col-md-6  date" id='timepicker_nkt'>
                         <input type="text" disabled="" class="form-control" name="time_end" data-date-format="HH:mm" value="<?php echo set_value('from_start_time', date('H:i', strtotime($booking->time_end))); ?>">
                         <span class="input-group-addon"><span class="icon-clock"></span>
                          </span>
                         <?php echo form_error('from_start_time'); ?>
                     </div> 
                 </div>
             </div>
             <div class="form-group">
                 <label for="item_type"> Hướng Dẫn Viên</label>
                 <input type="text" class="form-control" name="item_type" value="<?php echo ( $booking->item_type ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="customer"> Mã Trip</label>
                 <input type="text"  disabled="" class="form-control" name="trip_id" value="<?php echo ( $booking->trip_id ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="customer"> Ghi Chú </label>
                 <input type="textarea" class="form-control" name="note" value="<?php echo ( $booking->note ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="role"> Trạng Thái </label>
                 <br>
                 <label class="radio-inline">
                     <input type="radio" name="status" value="0" <?php echo set_radio('status','0', $booking->status == '0'); ?>> <?php echo lang('Mới')?>
                 </label>
                 <label class="radio-inline">
                     <input type="radio" name="status" value="1" <?php echo set_radio('status', '1', $booking->status == '1'); ?>> <?php echo lang('Đã thanh toán')?>
                 </label>
                 <label class="radio-inline">
                     <input type="radio" name="status" value="2" <?php echo set_radio('status', '2', $booking->status == '2'); ?>> <?php echo lang('Hủy bỏ')?>
                 </label>
                 <?php echo form_error('role'); ?>
             </div>
             <div  class="form-group">
                 <label for="dateandtime">Ngày khởi tạo</label>
                 <div class="row">
                     <div class="col-md-6   date" id='datepicker_ngaytao'>
                         <input type="text" disabled="" class="form-control" name="created_at" data-date-format="DD-MM-YYYY" value="<?php echo set_value('from_start_date', date('d-m-Y', strtotime($booking->created_at))); ?>">
                         <span class="input-group-addon"><span class="icon-calendar"></span>
                          </span>
                         <?php echo form_error('from_start_date'); ?>
                     </div>
                     <script type="text/javascript">
                         $(function () {
                             $('#datepicker_ngaytao').datetimepicker({
                                 pickTime: false,
                                 useCurrent: false
                             });
                         });
                     </script>
                     <div class="col-md-6  date" id='timepicker_ngaytao'>
                         <input type="text" disabled="" class="form-control" name="created_at" data-date-format="HH:mm" value="<?php echo set_value('from_start_time', date('H:i', strtotime($booking->created_at))); ?>">
                         <span class="input-group-addon"><span class="icon-clock"></span>
                          </span>
                         <?php echo form_error('from_start_time'); ?>
                     </div>
                     <script type="text/javascript">
                         $(function () {
                             $('#timepicker_ngaytao').datetimepicker({
                                 pickDate: false,
                                 useCurrent: false,
                                 icons: {
                                     up: "icon-arrow-up",
                                     down: "icon-arrow-down"
                                 }
                             });
                         });
                     </script>
                 </div>
             </div>
             <div  class="form-group">
                 <label for="dateandtime">Ngày cập nhật</label>
                 <div class="row">
                     <div class="col-md-6  date" id='datepicker_ncn'>
                         <input type="text" class="form-control" name="updated_at" data-date-format="DD-MM-YYYY" value="<?php echo set_value('from_start_date', date('d-m-Y', strtotime($booking->updated_at))); ?>">
                         <span class="input-group-addon"><span class="icon-calendar"></span>
                          </span>
                         <?php echo form_error('from_start_date'); ?>
                     </div>
                     <script type="text/javascript">
                         $(function () {
                             $('#datepicker_ncn').datetimepicker({
                                 pickTime: false,
                                 useCurrent: false
                             });
                         });
                     </script>
                     <div class="col-md-6  date" id='timepicker_ncn'>
                         <input type="text"  class="form-control" name="updated_at" data-date-format="HH:mm" value="<?php echo set_value('from_start_time', date('H:i', strtotime($booking->updated_at))); ?>">
                         <span class="input-group-addon"><span class="icon-clock"></span>
                          </span>
                         <?php echo form_error('from_start_time'); ?>
                     </div>
                     <script type="text/javascript">
                         $(function () {
                             $('#timepicker_ncn').datetimepicker({
                                 pickDate: false,
                                 useCurrent: false,
                                 icons: {
                                     up: "icon-arrow-up",
                                     down: "icon-arrow-down"
                                 }
                             });
                         });
                     </script>
                 </div>
                 <div class="form-group">
                 <label for="customer"> Tổng Tiền </label>
                 <input type="text" class="form-control" name="money" value="<?php echo ($booking->money) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="customer"> Hủy Tiền </label>
                 <input type="text" class="form-control" name="cancel_money" value="<?php echo ( $booking->cancel_money) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="customer"> Mã Sử Dụng  </label>
                 <input type="text" class="form-control" name="coupon_code" value="<?php echo ( $booking->coupon_code) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="customer"> Số tiền được hoàn </label>
                 <input type="text" class="form-control" name="coupon_value" value="<?php echo ( $booking->coupon_value ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             </div>
             
             <input type="hidden" name="id" value=" <?php echo ($booking->id) ?>">
             <button type="submit" class="btn btn-success"  name="update"  value="submit"><span class="icon-checkmark"></span> Update</button>
             </form>
         </div>
     <?php endforeach; ?>
     </div>
         </div>
