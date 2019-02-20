<div class="col-sm-10 col-md-11 main">
	<div class="row" >
		<div class="col-sm-12 col-md-12" style="padding-left:0px;">
			<h1 class="page-header"><a href="<?php echo base_url().'admin/campaigns' ?>"><i class="icon-arrow-left-3"></i></a> Tạo chiến dịch</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-5 col-md-5">
			<?php $this-> load->model('campaign'); ?>
			<?php echo form_open('admin/campaigns/add_campaign') ?>
			<div class="form-group">
				<label for="item_type"> Tên</label>
				<input type="text" class="form-control" name="name" value="">
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
				<label for="item_type">Ảnh</label>
				<textarea rows="3" cols="50"  class="form-control"  name="images" ></textarea>
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
				<label for="item_type">Link</label>
				<input type="text" class="form-control" name="link" value="">
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
				<label for="item_type">Mô tả</label>
				<textarea rows="4" cols="50"  class="form-control"  name="desc" > </textarea>
				<?php echo form_error('customer'); ?>
			</div>
			
		<div class="form-group">
				<label for="item_type"> Loại</label>
				<input type="text" class="form-control" name="type" value="">
				<?php echo form_error('customer'); ?>
			</div>
		<div class="form-group">
			<label for="role"> Is Sponsor </label>
			<br>
			<label class="radio-inline">
				<input type="radio" checked name="is_sponsor" value="1" >Bật
			<label class="radio-inline">
				<input type="radio"  name="is_sponsor" value="0" >Tắt
			</label>
				<?php echo form_error('role'); ?>
			</div>
		<div class="form-group">s
			<label for="role"> Trạng Thái </label>
			<br>
			<label class="radio-inline">
				<input type="radio" name="status" value="1">Bật
			</label>
			<label class="radio-inline">
				<input type="radio" checked name="status" value="0">Tắt
			</label>
				<?php echo form_error('role'); ?>
			</div>
		
			<button type="submit" class="btn btn-success"  name="create"  value="submit"><span class="icon-checkmark"></span> Create</button>
	</form>
</div>
</div>
</div>