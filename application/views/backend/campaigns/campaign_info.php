<div class="col-sm-10 col-md-11 main">
	<div class="row" >
		<div class="col-sm-12 col-md-12" style="padding-left:0px;">
			<h1 class="page-header"><a href="<?php echo base_url().'admin/campaigns' ?>"><i class="mdi mdi-arrow-left-bold-circle-outline"></i></a> Cập nhật chiến dịch</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-5 col-md-5">
			<?php $this-> load->model('campaign'); ?>
			<?php foreach ($campaigns as $campaign): ?>
			<?php echo form_open('admin/campaigns/edit_campaign/'.$this->uri->segment(4)); ?>
			<div class="form-group">
				<label for="customer"> Mã </label>
				<input type="text" disabled class="form-control" name="id" value="<?php echo ( $campaign->id ) ?>">
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
				<label for="item_type"> Tên</label>
				<input type="text" class="form-control" name="name" value="<?php echo ( $campaign->name) ?>">
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
                      <label>Ảnh</label>
                      <input type="file" name="img[]" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                        </span>
                      </div>
                    </div>
			<div class="form-group">
				<label for="item_type">Link</label>
				<input type="text" class="form-control" name="link" value="<?php echo ( $campaign->link ) ?>">
				<?php echo form_error('customer'); ?>
			</div>
			<div class="form-group">
				<label for="item_type">Mô tả</label>
				<textarea rows="4" cols="50"  class="form-control"  name="desc" ><?php echo ( $campaign->desc ) ?>  </textarea>
				<?php echo form_error('customer'); ?>
			</div>
				<div  class="form-group">
					<label for="dateandtime">Ngày cập nhật</label>
					<div class="row">
						<div class="col-md-6   date" id='datepicker_ngaytao'>
							<input type="text" disabled="" class="form-control" name="updated_at" data-date-format="DD-MM-YYYY" value="<?php echo set_value('from_start_date', date('d-m-Y', strtotime($campaign->updated_at))); ?>">
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
						<input type="text" disabled="" class="form-control" name="updated_at" data-date-format="HH:mm" value="<?php echo set_value('from_start_time', date('H:i', strtotime($campaign->updated_at))); ?>">
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
		<?php $type = array("customer","guider");
		array_unshift($type,   $campaign->type );
		$result=array_unique($type);

		 ?>	
		<div class="form-group">
				<label for="item_type">Chiến dịch cho</label>
				<select  class="form-control" id="cmbMake" name="type" >
					<?php foreach ($result as $result): ?>
						<option value=<?php echo $result ?> ><?php echo $result ?></option>
					<?php endforeach ?>
					
				</select>
			</div>
		<div class="form-group">
			<label for="role"> Quảng cáo </label>
			<br>
			<?php if($campaign->is_sponsor == '1') {?>
			<label class="radio-inline">
				<input type="radio" name="is_sponsor" value="0" <?php echo set_radio('is_sponsor','0', $campaign->is_sponsor == '0'); ?>>Tắt
			</label>
			<label class="radio-inline">
				<input type="radio" checked name="is_sponsor" value="1" <?php echo set_radio('is_sponsor', '1', $campaign->is_sponsor == '1'); ?>>Bật
				<?php }else{ ?>
				<label class="radio-inline">
					<input type="radio" checked name="is_sponsor" value="0" <?php echo set_radio('is_sponsor','0', $campaign->is_sponsor == '0'); ?>>Tắt
				</label>
				<label class="radio-inline">
					<input type="radio"  name="is_sponsor" value="1" <?php echo set_radio('is_sponsor', '1', $campaign->is_sponsor == '1'); ?>>Bật
					<?php } ?>
				</label>
				<?php echo form_error('role'); ?>
			</div>
		<div class="form-group">
			<label for="role"> Trạng Thái </label>
			<br>
			<?php if($campaign->status == '1') {?>
			<label class="radio-inline">
				<input type="radio" name="status" value="0" <?php echo set_radio('status','0', $campaign->status == '0'); ?>>Tắt
			</label>
			<label class="radio-inline">
				<input type="radio" checked name="status" value="1" <?php echo set_radio('status', '1', $campaign->status == '1'); ?>>Bật
				<?php }else{ ?>
			<label class="radio-inline">
				<input type="radio" checked name="status" value="0" <?php echo set_radio('status','0', $campaign->status == '0'); ?>>Tắt
			</label>
			<label class="radio-inline">
				<input type="radio"  name="status" value="1" <?php echo set_radio('status', '1', $campaign->status == '1'); ?>>Bật
				<?php } ?>
			</label>
				<?php echo form_error('role'); ?>
		</div>
		
			<input type="hidden" name="id" value=" <?php echo ($campaign->id) ?>">
			<button type="submit" class="btn btn-success"  name="update"  value="submit"><span class="icon-checkmark"></span> Cập nhật</button>
	</form>
</div>
<?php endforeach; ?>

</div>