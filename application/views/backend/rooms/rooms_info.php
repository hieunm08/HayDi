<div class="col-sm-10 col-md-11 main">
<div class="col-sm-10 col-md-11 main">
<div class="col-sm-10 col-md-11 main">
  <div class="row" >
    <div class="col-sm-12 col-md-12" style="padding-left:0px;">
      <h1 class="page-header"><a href="<?php echo base_url().'admin/rooms' ?>"><i class="icon-arrow-left"></i></a> UPDATE ROOM</h1>
    </div>
  </div>
  <div class="row">
    <?php
    if ($this->session->flashdata('message') != '') echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('message') . '</div>';
    ?>
  </div>
  <div class="row" >
    <?php $this->load->model('room'); ?>
    <?php
    foreach ($rooms as $rooms):
    ?>
    <div class="col-sm-4 col-md-4">
      <?php echo form_open('admin/rooms/update_room/'.$this->uri->segment(4)); ?>
        <div class="form-group">
          <label for="company_name">Mã phòng</label>
          <input disabled  type="text" class="form-control" id="company_name" name="id" value="<?php echo($rooms->id) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Mã Host</label>
          <input type="text" class="form-control" id="host_id" name="host_id" value="<?php echo($rooms->host_id) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Tên phòng</label>
          <input type="text" class="form-control" id="name" name="name" value="<?php echo($rooms->name) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Số giường ngủ</label>
          <input type="text" class="form-control" id="bed_number" name="bed_number" value="<?php echo($rooms->bed_number) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Kiểu giường</label>
          <input type="text" class="form-control" id="bed_type" name="bed_type" value="<?php echo($rooms->bed_type) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Giá</label>
          <input type="text" class="form-control" id="price" name="price" value="<?php echo($rooms->price) ?>">
        </div>     
        <div class="form-group">
          <label for="company_name">Đơn vị</label>
          <input type="text" class="form-control" id="unit" name="unit" value="<?php echo($rooms->unit) ?>">
        </div>     
                <div class="form-group">
          <label for="company_name">Phục vụ ăn sáng</label>
          <input type="text" class="form-control" id="is_breakfast" name="is_breakfast" value="<?php echo($rooms->is_breakfast) ?>">
        </div>
        
        <div class="form-group">
          <label for="company_street">Ngày cập nhật</label>
          <input disabled type="text" class="form-control" id="company_street" name="created_at" value="<?php echo date('d/m/Y',strtotime( $rooms->updated_at)) ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <input  type="hidden" class="form-control" id="company_street" name="updated_at" value="<?php echo (mdate('%Y-%m-%d %H:%i:%s', now())) ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
                <input type="hidden" name="id" value=" <?php echo ($rooms->id) ?>">
       <button type="submit" class="btn btn-success"  name="update"  value="submit"><span class="icon-checkmark"></span> Update</button>

              </form>
      <?php  endforeach ?>
    </div>
   

  </div>
</div>
<script>
$(function() {
    $("#country_input").autocomplete({
        source: data
        
    });
});


</script>
 