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
            <?php echo form_open('admin/bookings/updatebooking/'.$this->uri->segment(4)); ?>

             <div class="form-group">
                 <label for="customer"> Mã Order</label>
                 <input type="text" disabled class="form-control" name="id" value="<?php echo ( $booking->id ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
              <div class="form-group">
                 <label for="customer"> Mã Trip</label>
                 <input type="text"  disabled="" class="form-control" name="trip_id" value="<?php echo ( $booking->trip_id ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div  class="form-group">
                 <label for="dateandtime">Ngày bắt đầu </label>
                 <div class="row">
                     <div class="col-md-6  date" id='datepicker_nbd'>
                         <input type="text" class="form-control" name="start_day" data-date-format="DD-MM-YYYY" value="<?php echo set_value('start_day', date('d-m-Y', strtotime($booking->start_day))); ?>">
                         <span class="input-group-addon"><span class="icon-calendar"></span>
                          </span>
                     </div>
                     
                     <div class="col-md-6  date" id='timepicker_nbd'>
                         <input type="text"  class="form-control" name="start_day" data-date-format="HH:mm" value="<?php echo set_value('time_start', date('H:i', strtotime($booking->start_day))); ?>">
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
                         <input type="text"class="form-control" name="end_day" data-date-format="DD-MM-YYYY" value="<?php echo set_value('from_start_date', date('d-m-Y', strtotime($booking->end_day))); ?>">
                         <span class="input-group-addon"><span class="icon-calendar"></span>
                          </span>
                     </div>
                     <div class="col-md-6  date" id='timepicker_nkt'>
                         <input type="text" class="form-control" name="end_day" data-date-format="HH:mm" value="<?php echo set_value('from_start_time', date('H:i', strtotime($booking->end_day))); ?>">
                         <span class="input-group-addon"><span class="icon-clock"></span>
                          </span>
                         <?php echo form_error('from_start_time'); ?>
                     </div> 
                 </div>
             </div>
             <div class="form-group">
                 <label for="guider_id"> Hướng Dẫn Viên</label>
                 <input type="text" class="form-control" name="guider_id" value="<?php echo ( $booking->guider_id ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="trip_id">Giờ</label>
                 <input type="text"  class="form-control" name="trip_id" value="<?php echo ( $booking->trip_id ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div  class="form-group">
                 <label for="dateandtime">Thời gian bắt đầu</label>
                 <div class="row">
                     <div class="col-md-6   date" id='datepicker_ngaytao'>
                         <input type="text" disabled="" class="form-control" name="time_start" data-date-format="DD-MM-YYYY" value="<?php echo set_value('from_start_date', date('d-m-Y', strtotime($booking->time_start))); ?>">
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
                         <input type="text" disabled="" class="form-control" name="time_start" data-date-format="HH:mm" value="<?php echo set_value('from_start_time', date('H:i', strtotime($booking->time_start))); ?>">
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
             <div class="form-group">
                 <label for="customer"> Vị Trí</label>
                 <input type="text"  disabled="" class="form-control" name="local_meet" value="<?php echo ( $booking->local_meet) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="lat"> Lat</label>
                 <input type="text"  disabled="" class="form-control" name="lat" value="<?php echo ( $booking->lat) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="lon"> Lon</label>
                 <input type="text"  disabled="" class="form-control" name="lon" value="<?php echo ( $booking->lon) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="note"> Ghi Chú </label>
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
                  <label class="radio-inline">
                     <input type="radio" name="status" value="3" <?php echo set_radio('status', '3', $booking->status == '3'); ?>> <?php echo lang('Xác nhận')?>
                 </label>
                  <label class="radio-inline">
                     <input type="radio" name="status" value="4" <?php echo set_radio('status', '4', $booking->status == '4'); ?>> <?php echo lang('Hoàn thành')?>
                 </label>
                 <?php echo form_error('role'); ?>
             </div>

                 <div class="form-group">
                 <label for="customer"> Tổng Tiền </label>
                 <input type="text" class="form-control" name="money" value="<?php echo ($booking->money) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
            <div class="form-group">
                 <label for="role"> Trạng Thái </label>
                 <br>
                 <label class="radio-inline">
                     <input type="radio" name="paid_type" value="0" <?php echo set_radio('status','0', $booking->paid_type == '0'); ?>> <?php echo lang('Tiền mặt')?>
                 </label>
                 <label class="radio-inline">
                     <input type="radio" name="paid_type" value="1" <?php echo set_radio('status', '1', $booking->paid_type == '1'); ?>> <?php echo lang('Online')?>
                 </label>
                 <label class="radio-inline">
                     <input type="radio" name="paid_type" value="2" <?php echo set_radio('status', '2', $booking->paid_type == '2'); ?>> <?php echo lang('Chuyển khoản')?>
                 </label>
             </div>
             
             <input type="hidden" name="id" value=" <?php echo ($booking->id) ?>">
             <button type="submit" class="btn btn-success"  name="update"  value="submit"><span class="icon-checkmark"></span> Update</button>
             </form>
         </div>
     <?php endforeach; ?>
     </div>
         </div>
