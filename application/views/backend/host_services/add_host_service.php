<div class="col-sm-10 col-md-11 main">
	<div class="row" >
		<div class="col-sm-12 col-md-12" style="padding-left:0px;">
			<h1 class="page-header"><a href="<?php echo base_url().'admin/host_services' ?>"><i class="mdi mdi-arrow-left-bold-circle-outline"></i></a>Thêm dịch vụ cho host</h1>
		</div>
	</div>
	<div class="row">
		<?php
		if ($this->session->flashdata('message') != '') echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('message') . '</div>';
		?>
	</div>
	<div class="row">
		<div class="col-sm-5 col-md-5">
			<?php echo form_open('admin/host_services/add_host_service') ?>
			<div class="form-group">
				<label for="company_street">Tên host</label>
				<select class="form-control"  id="cmbMake" name="host_id"  >
					<option value= >Chọn</option>
					<?php foreach ($host_name as $host_name ){ ?>
					<option value=<?php echo $host_name->id  ?> ><?php echo $host_name->name ?></option>
					<?php } ?>
				</select>
				<?php echo form_error('host_id'); ?>		
			</div>
			<div class="form-group">
				<label for="company_street">Dịch vụ</label>
				<select class="form-control"  id="cmbMake" name="service_id"  >
					<option value= >Chọn</option>
					<?php foreach ($service_name as $service_name ){ ?>
					<option value=<?php echo $service_name->id  ?> ><?php echo $service_name->name ?></option>
					<?php } ?>
				</select>	
				<?php echo form_error('service_id'); ?>	
			</div>
			<div class="form-group">
				<label for="company_street">Access</label>
				<select class="form-control"  id="cmbMake" name="access"  >
					<option value="yes" >Yes</option>
					<option value="no" >no</option>
					<option value="option">option</option>
				</select>
			</div>
			<div class="form-group">
				<label for="item_type"> Cost</label>
				<input type="text" class="form-control" name="cost" value="">
				<?php echo form_error('cost'); ?>
			</div>
			<div class="form-group">
				<label for="company_street">Unit</label>
				<select class="form-control"  id="cmbMake" name="unit"  >
					<option value= >Chọn</option>
					<option value="USD" >USD</option>
					<option value="VND" >VND</option>
				</select>
				
			</div>				
			<button type="submit" class="btn btn-success"  name="create"  value="submit"><span class="icon-checkmark"></span> Thêm</button>
		</form>
	</div>
</div>
</div>