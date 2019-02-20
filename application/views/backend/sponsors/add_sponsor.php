<div class="col-sm-10 col-md-11 main">
	<div class="row" >
		<div class="col-sm-12 col-md-12" style="padding-left:0px;">
			<h1 class="page-header"><a href="<?php echo base_url().'admin/sponsors' ?>"><i class="icon-arrow-left-3"></i></a> Create Sponsor</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-5 col-md-5">
			<?php $this-> load->model('sponsor'); ?>
			<?php echo form_open('admin/sponsors/add_sponsor') ?>
			<div class="form-group">
				<label for="customer"> Mã  </label>
				<input type="text"  class="form-control" name="sponsor_id" value="">
				<?php echo form_error('sponsor_id'); ?>
			</div>
			<div class="form-group">
				<label for="item_type"> Loại</label>
				<input type="text" class="form-control" name="type" value="">
				<?php echo form_error('type'); ?>
			</div>
			<div  class="form-group">
				<label for="dateandtime">Thời gian bắt đầu</label>
				<div class="row">
					<div class="col-md-6   date" id='datepicker_ngaytao'>
						<input type="text"  class="form-control" name="date_start" data-date-format="DD-MM-YYYY" value="">
						<span class="input-group-addon"><span class="icon-calendar"></span>
					</span>
					<?php echo form_error('date_start'); ?>
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
					<input type="text"  class="form-control" name="time_start" data-date-format="HH:mm" value="">
					<span class="input-group-addon"><span class="icon-clock"></span>
				</span>
				<?php echo form_error('time_start'); ?>
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
				<label for="dateandtime">Thời gian kết thúc</label>
				<div class="row">
					<div class="col-md-6   date" id='datepicker_ngaykt'>
						<input type="text"  class="form-control" name="date_end" data-date-format="DD-MM-YYYY" value="">
						<span class="input-group-addon"><span class="icon-calendar"></span>
					</span>
					<?php echo form_error('date_end'); ?>
				</div>
				<script type="text/javascript">
				$(function () {
				$('#datepicker_ngaykt').datetimepicker({
				pickTime: false,
				useCurrent: false
				});
				});
				</script>
				<div class="col-md-6  date" id='timepicker_ngaykt'>
					<input type="text"  class="form-control" name="time_end" data-date-format="HH:mm" value="">
					<span class="input-group-addon"><span class="icon-clock"></span>
				</span>
				<?php echo form_error('time_end'); ?>
			</div>
			<script type="text/javascript">
			$(function () {
			$('#timepicker_ngaykt').datetimepicker({
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
				<label for="item_type"> Số tiền quảng cáo</label>
				<input type="text" class="form-control" name="sponsor_money" value="">
				<?php echo form_error('sponsor_money'); ?>
			</div>
		<div class="form-group">
			<label for="role"> Trạng Thái </label>
			<br>
			<label class="radio-inline">
				<input type="radio" name="status" value="0" >Tắt
			</label>
			<label class="radio-inline">
				<input type="radio" checked name="status" value="1" >Bật
				<?php echo form_error('status'); ?>
			</div>
			<button type="submit" class="btn btn-success"  name="create"  value="submit"><span class="icon-checkmark"></span> Create</button>
	</form>
</div>
</div>
</div>