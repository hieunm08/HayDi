<div class="col-sm-10 col-md-11 main">
	<div class="row" >
		<div class="col-sm-12 col-md-12" style="padding-left:0px;">
			<h1 class="page-header"><a href="<?php echo base_url().'admin/news' ?>"><i class="mdi mdi-arrow-left-bold-circle-outline"></i></a> Update News</h1>
		</div>
	</div>
	<div class="row">	
		<div class="col-sm-5 col-md-5">
			<?php $this-> load->model('tintuc'); ?>
			<?php foreach ($news as $news): ?>
			<?php  $news_group = $this->tintuc->getNewsGroupById($news->group_id) ?>
			<?php  $group = $this->tintuc->getNewsGroup() ?>
			<?php echo form_open('admin/news/edit_news/'.$this->uri->segment(4)); ?>
			<div class="form-group">
				<label for="customer"> Mã </label>
				<input type="text" disabled class="form-control" name="id" value="<?php echo ( $news->id ) ?>">
				<?php echo form_error('id'); ?>	
			</div>
			<div class="form-group">
				<label for="item_type"> Tiêu đề</label>
				<input type="text" class="form-control" name="title" value="<?php echo ( $news->title ) ?>">
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
				<label for="customer">Ảnh đại diện</label>
				<input type="text"   class="form-control" name="thumb" value="<?php echo ( $news->thumb ) ?>">
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
				<label for="customer"> Đường dẫn </label>
				<input type="textarea" class="form-control" name="link" value="<?php echo ( $news->link ) ?>">
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
				<label for="customer"> Giới thiệu </label>
				<textarea rows="2" cols="50"  class="form-control"  name="intro" ><?php echo ( $news->intro ) ?> </textarea>
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
				<label for="customer"> Nội dung</label>
				<textarea rows="4" cols="50"  class="form-control"  name="content" ><?php echo ( $news->content ) ?> </textarea>
			</div>
			<div class="form-group">
				<label for="role"> Trạng Thái </label>
				<br>
				<?php if($news->status == '1') {?>
				<label class="radio-inline">
					<input type="radio" name="status" value="0" <?php echo set_radio('status','0', $news->status == '0'); ?>>Tắt
				</label>
				<label class="radio-inline">
					<input type="radio" checked name="status" value="1" <?php echo set_radio('status', '1', $news->status == '1'); ?>>Bật
				</label>
				<?php }else{ ?>
					<label class="radio-inline">
						<input type="radio" checked name="status" value="0" <?php echo set_radio('status','0', $news->status == '0'); ?>>Tắt
					</label>
					<label class="radio-inline">
						<input type="radio"  name="status" value="1" <?php echo set_radio('status', '1', $news->status == '1'); ?>>Bật
				<?php } ?>
					</label>
					<?php echo form_error('role'); ?>
				</div>
				<div class="form-group">
					<label for="customer">Loại tin</label>
					<select  id="cmbMake" name="group_id" >
			     		<?php foreach ($group as $group ){ ?> 			
	     					<option value=<?php echo $group->id  ?> ><?php echo $group->name ?></option>
		     		 	<?php } ?> 
				  	</select>
					<?php echo form_error('customer'); ?>
				</div>
				<div  class="form-group">
					<label for="dateandtime">Ngày cập nhật</label>
					<div class="row">
						<div class="col-md-6   date" id='datepicker_ngaytao'>
							<input type="text" disabled="" class="form-control" name="updated_at" data-date-format="DD-MM-YYYY" value="<?php echo set_value('from_start_date', date('d-m-Y', strtotime($news->updated_at))); ?>">
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
						<input type="text" disabled="" class="form-control" name="updated_at" data-date-format="HH:mm" value="<?php echo set_value('from_start_time', date('H:i', strtotime($news->updated_at))); ?>">
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
		
		
		<input type="hidden" name="id" value=" <?php echo ($news->id) ?>">
		<button type="submit" class="btn btn-success"  name="update"  value="submit"><span class="icon-checkmark"></span> Update</button>
	</form>
</div>
<?php endforeach; ?>
</div>
</div>