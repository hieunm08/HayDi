<div class="col-sm-10 col-md-11 main">
	<div class="row" >
		<div class="col-sm-12 col-md-12" style="padding-left:0px;">
			<h1 class="page-header"><a href="<?php echo base_url().'admin/news' ?>"><i class="mdi mdi-arrow-left-bold-circle-outline"></i></a> Tạo News</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-5 col-md-5">
			<?php $this->load->model('tintuc'); ?>
			<?php echo form_open('admin/news/add_news') ?>
			<div class="form-group">
				<label for="item_type"> Tiêu đề</label>
				<input type="text" class="form-control" name="title" value="">
				<?php echo form_error('title'); ?>
			</div>
			<div class="form-group">
				<label for="customer">Ảnh đại diện</label>
				<input type="text"   class="form-control" name="thumb" value="">
				<?php echo form_error('thumb'); ?>
			</div>
			<div class="form-group">
				<label for="customer"> Đường dẫn </label>
				<input type="textarea" class="form-control" name="link" value="">
				<?php echo form_error('link'); ?>
			</div>
			<div class="form-group">
				<label for="customer"> Giới thiệu </label>
				<textarea rows="2" cols="50"  class="form-control"  name="intro" > </textarea>
				<?php echo form_error('intro'); ?>
			</div>
			<div class="form-group">
				<label for="customer"> Nội dung</label>
				<textarea rows="4" cols="50"  class="form-control"  name="content" > </textarea>
				<?php echo form_error('content'); ?>
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
				</label>
				</div>
				<div class="form-group">
					<label for="customer">Loại tin</label>
					<select class="form-control"  id="cmbMake" name="group_id" >
			     		<?php foreach ($group as $group ){ ?> 			
	     					<option value=<?php echo $group->id ?> ><?php echo $group->name ?></option>
		     		 	<?php } ?> 
				  	</select>
					<?php echo form_error('customer'); ?>
				</div>
		
		<button type="submit" class="btn btn-success"  name="create"  value="submit"><span class="icon-checkmark"></span>Tạo</button>
	</form>
</div>
</div>
</div>