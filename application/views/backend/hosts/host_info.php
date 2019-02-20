<div class="col-sm-10 col-md-11 main">
  <div class="row" >
    <div class="col-sm-12 col-md-12" style="padding-left:0px;">
      <h1 class="page-header"><a href="<?php echo base_url().'admin/hosts' ?>"><i class="icon-arrow-left-3"></i></a> Thông tin nhà trọ</h1>
    </div>
  </div>
  <div class="row">
    <?php
    if ($this->session->flashdata('message') != '') echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('message') . '</div>';
    ?>
  </div>
  <div class="row" >
    <?php
    foreach ($hd as $host){

    }
    ?>
    <div class="col-sm-4 col-md-4">
    <?php echo form_open('admin/hosts/edit_host/'.$this->uri->segment(4)); ?> 
        <div class="form-group">
          <label for="company_name">Mã </label>
          <input   type="text" class="form-control" id="company_name" name="id" value="<?php echo($host->id) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Họ tên</label>
          <input type="text" class="form-control" id="company_name" name="name" value="<?php echo($host->name) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Ảnh</label>
          <input type="text" class="form-control" id="company_name" name="image" value="<?php echo($host->image) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Video</label>
          <input type="text" class="form-control" id="company_name" name="video" value="<?php echo($host->video) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">SĐT</label>
          <input type="text" class="form-control" id="company_name" name="phone" value="<?php echo($host->phone) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Email</label>
          <input type="text" class="form-control" id="company_name" name="email" value="<?php echo($host->email) ?>">
        </div>
      	<div class="form-group">
          <label for="company_name">Kiểu</label>
          <input type="text" class="form-control" id="company_name" name="type" value="<?php echo($host->type) ?>">
        </div>
        <div class="form-group">
          <button style="width:100px; margin-top:20px" name="edit" type="submit" class="btn btn-primary" value="submit"><span
          class="icon-checkmark"></span>Update</button>
        </div>

        
      </div>
      <div class="col-sm-4 col-md-4">
        <div class="form-group">
          <label for="company_name">Intro</label>
          <input type="text" class="form-control" id="company_name" name="intro" value="<?php echo($host->intro) ?>">
        </div>
        <div class="form-group">
          <label for="company_street">Địa chỉ</label>
          <input type="text" class="form-control" id="company_street" name="address" value="<?php echo($host->address) ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Mã Quốc Gia</label>
          <input type="text" class="form-control" id="country_input" name="country_code" value="<?php echo($host->country_code) ?>" >
        </div>
        
        <div class="form-group">
          <label for="company_street">Đánh giá</label>
          <input type="text" class="form-control" id="company_street" name="rate" value="<?php echo($host->rate) ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Tổng vote</label>
            <input type="text" class="form-control" id="company_street" name="vote_total" value="<?php echo($host->vote_total) ?> ">
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Trạng thái</label>
          <select class="form-control" id="sel1" name="status">
            <?php
            if ($host->status == 1) { ?>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
            <?php }else{ ?>
            <option value="0">Inactive</option>
            <option value="1">Active</option>
            <?php } ?>
          </select>
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Ngày cập nhật</label>
          <input disabled type="text" class="form-control" id="company_street" name="updated_at" value="<?php echo date('d/m/Y',strtotime( $host->updated_at)) ?>" >
        </div>
      </div>
      <div class="col-sm-4 col-md-4">
        
        
        <div class="form-group">
          <label for="company_street">Giá</label>
          <input disabled type="text" class="form-control" id="company_street" name="price" value="<?php echo($host->price) ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Giá trẻ em</label>
          <input type="text" class="form-control" id="company_street" name="price_baby" value="<?php echo($host->price_baby) ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
       	<div class="form-group">
          <label for="company_street">Ngày tạo</label>
          <input disabled type="text" class="form-control" id="company_street" name="created_at" value="<?php echo date('d/m/Y',strtotime( $host->created_at)) ?>" >
        </div>
        <input type="hidden" name="id" value=" <?php echo ($host->id) ?>">
        <div class="form-group">
          <label for="company_street">Tổng số phòng</label>
          <input  class="form-control" id="company_street" name="room_number" value="<?php echo($host->room_number) ?>"> 
        </div>
        
      </form>
    
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
 