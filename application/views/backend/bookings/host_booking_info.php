<div class="col-sm-10 col-md-11 main">
	<div class="row" >
		<div class="col-sm-12 col-md-12" style="padding-left:0px;">
			<h1 class="page-header"><a href="<?php echo base_url().'admin/sponsors' ?>"><i class="icon-arrow-left-3"></i></a> Update Sponsor</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-5 col-md-5">
			<?php $this-> load->model('booking'); ?>
			<?php foreach ($orders as $booking): ?>
			<?php echo form_open('admin/bookings/edit_host_booking/'.$this->uri->segment(4)); ?>
			<div class="form-group">
				<label for="customer"> Mã đơn hàng </label>
				<input type="text" disabled class="form-control" name="id" value="<?php echo ( $booking->id ) ?>">
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
				<label for="customer"> Mã khách hàng </label>
				<input type="text" disabled class="form-control" name="id" value="<?php echo ( $booking->user_id ) ?>">
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
				<label for="customer"> Mã hành trình</label>
				<input type="text" disabled class="form-control" name="id" value="<?php echo ( $booking->trip_id ) ?>">
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
				<label for="item_type"> Host</label>
				<input type="text" class="form-control" name="type" value="<?php echo ( $booking->host_id ) ?>">
				<?php echo form_error('customer'); ?>
			</div>
			<div  class="form-group">
				<label for="dateandtime">Ngày bắt đầu</label>
				<div class="row">
					<div class="col-md-6   date" id='datepicker_ngaytao'>
						<input type="text"  class="form-control" name="date_start" data-date-format="DD-MM-YYYY" value="<?php echo set_value('time_start', date('d-m-Y', strtotime($booking->start_day))); ?>">
						<span class="input-group-addon"><span class="icon-calendar"></span>
					</span>
					<?php echo form_error('time_start'); ?>
				</div>
				<script type="text/javascript">
				$(function () {
				$('#datepicker_ngaytao').datetimepicker({
				pickTime: false,
				useCurrent: false
				});
				});
				</script>
			</div>
		</div>
		<div  class="form-group">
				<label for="dateandtime">Ngày kết thúc</label>
				<div class="row">
					<div class="col-md-6   date" id='datepicker_ngaykt'>
						<input type="text"  class="form-control" name="date_end" data-date-format="DD-MM-YYYY" value="<?php echo set_value('from_start_date', date('d-m-Y', strtotime($booking->end_day))); ?>">
						<span class="input-group-addon"><span class="icon-calendar"></span>
					</span>
					<?php echo form_error('from_start_date'); ?>
				</div>
				<script type="text/javascript">
				$(function () {
				$('#datepicker_ngaykt').datetimepicker({
				pickTime: false,
				useCurrent: false
				});
				});
				</script>
			</div>
		</div>
		<div class="form-group">
			<label for="item_type">Người lớn</label>
			<input type="text" class="form-control" name="sponsor_money" value="<?php echo ( $booking->person_number) ?>">
			<?php echo form_error('customer'); ?>
		</div>
		<div class="form-group">
			<label for="item_type">Trẻ em</label>
			<input type="text" class="form-control" name="sponsor_money" value="<?php echo ( $booking->baby_number) ?>">
			<?php echo form_error('customer'); ?>
		</div>
		<div class="form-group">
			<label for="item_type">Mã phòng</label>
			<input type="text" class="form-control" name="sponsor_money" value="<?php echo ( $booking->room_id ) ?>">
			<?php echo form_error('customer'); ?>
		</div>
		<div class="form-group">
			<label for="customer">Extras</label>
			<textarea rows="4" cols="50"  class="form-control"  name="content" ><?php echo ( $booking->extras ) ?> </textarea>
		</div>
		<div class="form-group">
			<label for="customer">Tổng tiền</label>
			<input type="text" class="form-control" name="sponsor_money" value="<?php echo ( $booking->total_money ) ?>">
		</div>
	
		<div class="form-group">
			<label for="sel1">Trạng thái:</label>
			<select class="form-control" id="sel1" name="status">
				<option value="new">New</option>
				<option value="cancel">Cancel</option>
				<option value="reject">Reject</option>
				<option value="accept">Accept</option>
			</select>
		</div>
		<div  class="form-group">
					<label for="dateandtime">Ngày tạo</label>
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
						<input type="text" disabled="" class="form-control" name="updated_at" data-date-format="HH:mm" value="<?php echo set_value('from_start_time', date('H:i', strtotime($booking->created_at))); ?>">
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
						<div class="col-md-6   date" id='datepicker_ngaytao'>
							<input type="text" disabled="" class="form-control" name="updated_at" data-date-format="DD-MM-YYYY" value="<?php echo set_value('from_start_date', date('d-m-Y', strtotime($booking->updated_at))); ?>">
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
						<input type="text" disabled="" class="form-control" name="updated_at" data-date-format="HH:mm" value="<?php echo set_value('from_start_time', date('H:i', strtotime($booking->updated_at))); ?>">
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
	
		
			<input type="hidden" name="id" value=" <?php echo ($booking->id) ?>">
			<button type="submit" class="btn btn-success"  name="edit"  value="submit"><span class="icon-checkmark"></span> Update</button>
	</form>
</div>
<?php endforeach; ?>
</div>
</div>