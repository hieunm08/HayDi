
<div class="col-sm-10 col-md-11 main">
	<div class="row" >
		<div class="col-sm-12 col-md-12" style="padding-left:0px;">
			<h1 class="page-header"><a href="<?php echo base_url().'admin/sponsors' ?>"><i class="icon-arrow-left-3"></i></a> Update Sponsor</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-5 col-md-5">
			<?php $this-> load->model('sponsor'); ?>
			<?php foreach ($sponsors as $sponsor): ?>
			<?php echo form_open('admin/sponsors/edit_sponsor/'.$this->uri->segment(4)); ?>
			<div class="form-group">
				<label for="customer"> Mã </label>
				<input type="text" disabled class="form-control" name="id" value="<?php echo ( $sponsor->sponsor_id ) ?>">
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
				<label for="item_type"> Loại</label>
				<input type="text" class="form-control" name="type" value="<?php echo ( $sponsor->type ) ?>">
				<?php echo form_error('customer'); ?>
			</div>
		<div  class="form-group">
				<label for="dateandtime">Thời gian kết thúc</label>
				<div class="row">
					<div class="col-md-6   date" id='datepicker_ngaykt'>
						<input type="text"  class="form-control" name="date_end" data-date-format="DD-MM-YYYY" value="<?php echo set_value('from_start_date', date('d-m-Y', strtotime($sponsor->time_end))); ?>">
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
				<div class="col-md-6  date" id='timepicker_ngaykt'>
					<input type="text"  class="form-control" name="time_end" data-date-format="HH:mm" value="<?php echo set_value('from_start_time', date('H:i', strtotime($sponsor->time_end))); ?>">
					<span class="input-group-addon"><span class="icon-clock"></span>
				</span>
				<?php echo form_error('from_start_time'); ?>
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
			<input type="text" class="form-control" name="sponsor_money" value="<?php echo ( $sponsor->sponsor_money ) ?>">
			<?php echo form_error('customer'); ?>
		</div>
		<div class="form-group">
			<label for="role"> Trạng Thái </label>
			<br>
			<?php if($sponsor->status == '1') {?>
			<label class="radio-inline">
				<input type="radio" name="status" value="0" <?php echo set_radio('status','0', $sponsor->status == '0'); ?>>Tắt
			</label>
			<label class="radio-inline">
				<input type="radio" checked name="status" value="1" <?php echo set_radio('status', '1', $sponsor->status == '1'); ?>>Bật
				<?php }else{ ?>
				<label class="radio-inline">
					<input type="radio" checked name="status" value="0" <?php echo set_radio('status','0', $sponsor->status == '0'); ?>>Tắt
				</label>
				<label class="radio-inline">
					<input type="radio"  name="status" value="1" <?php echo set_radio('status', '1', $sponsor->status == '1'); ?>>Bật
					<?php } ?>
				</label>
			</label>
				<?php echo form_error('role'); ?>
		</div>
		
			<input type="hidden" name="id" value=" <?php echo ($sponsor->sponsor_id) ?>">
			<button type="submit" class="btn btn-success"  name="update"  value="submit"><span class="icon-checkmark"></span> Update</button>
		</form>
</div>
</div>
</div>
<?php endforeach; ?>

