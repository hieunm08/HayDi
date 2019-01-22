<div class="col-sm-10 col-md-11 main">
  <div class="row" >
    <div class="col-sm-12 col-md-12" style="padding-left:0px;">
      <h1 class="page-header"><a href="<?php echo base_url().'admin/suppliers' ?>"><i class="icon-arrow-left-3"></i></a> <?php echo lang('Edit supplier')?></h1>
    </div>
  </div>
  <div class="row">
    <?php
    if ($this->session->flashdata('message') != '') echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('message') . '</div>';
    ?>
  </div>
  <div class="row" >
    <?php $this->load->model('supplier'); ?>
    <?php
    foreach ($suppliers as $supplier):
    ?>
    <div class="col-sm-4 col-md-4">
      <form method="GET" action="../updateSupplier" autocomplete="on">
        <div class="form-group">
          <label for="company_name">Mã HDV</label>
          <input disabled  type="text" class="form-control" id="company_name" name="id" value="<?php echo($supplier->id) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Họ tên</label>
          <input type="text" class="form-control" id="company_name" name="name" value="<?php echo($supplier->name) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">SĐT</label>
          <input type="text" class="form-control" id="company_name" name="phone" value="<?php echo($supplier->phone) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Facebook ID</label>
          <input type="text" class="form-control" id="company_name" name="facebook_id" value="<?php echo($supplier->facebook_id) ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Password</label>
          <input type="text" class="form-control" id="company_name" name="password" value="">
        </div>
        <div class="form-group">
          <label for="company_name">Email</label>
          <input type="text" class="form-control" id="company_name" name="email" value="<?php echo($supplier->email) ?>">
        </div>
        <div class="form-group">
          <button style="width:100px; margin-top:20px" name="update" type="submit" class="btn btn-primary" value="submit"><span
          class="icon-checkmark"></span> Update</button>
        </div>
        
      </div>
      <div class="col-sm-4 col-md-4">
        <div class="form-group">
          <label for="company_name">Sub Phone</label>
          <input type="text" class="form-control" id="company_name" name="sub_phone" value="<?php echo($supplier->sub_phone) ?>">
        </div>
        <div class="form-group">
          <label for="company_street">Địa chỉ</label>
          <input type="text" class="form-control" id="company_street" name="address" value="<?php echo($supplier->address) ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Mã Quốc Gia</label>
          <input type="text" class="form-control" id="country_input" name="country_code" value="<?php echo($supplier->country_code) ?>" >
        </div>
        
        <div class="form-group">
          <label for="company_street">Level</label>
          <input type="text" class="form-control" id="company_street" name="level" value="<?php echo($supplier->level) ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Type</label>
            <input type="text" class="form-control" id="company_street" name="type" value="<?php echo($supplier->type) ?> ">
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Trạng thái</label>
          <select class="form-control" id="sel1" name="status">
            <?php
            if ($supplier->status == 1) { ?>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
            <?php }else{ ?>
            <option value="0">Inactive</option>
            <option value="1">Active</option>
            <?php } ?>
          </select>
          <?php echo form_error('company_street'); ?>
        </div>
      </div>
      <div class="col-sm-4 col-md-4">
        
        
        <div class="form-group">
          <label for="company_street">Đánh giá</label>
          <input disabled type="text" class="form-control" id="company_street" name="vote_total" value="<?php echo($supplier->vote_total) ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Ngôn ngữ</label>
          <input type="text" class="form-control" id="company_street" name="languages" value="<?php echo($supplier->languages) ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
        
        <div class="form-group">
          <label for="company_street">Giá</label>
          <input type="text" class="form-control" id="company_street" name="price" value="<?php echo($supplier->price) ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Đơn vị giá</label>
          <input type="text" class="form-control" id="company_street" name="price_unit" value="<?php echo($supplier->unit) ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Ngày đăng kí</label>
          <input disabled type="text" class="form-control" id="company_street" name="created_at" value="<?php echo date('d/m/Y',strtotime( $supplier->created_at)) ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
        <input type="hidden" name="id" value=" <?php echo ($supplier->id) ?>">
        <div class="form-group">
          <label for="company_street">Mô tả</label>
          <textarea  class="form-control" id="company_street" name="desc" value="<?php echo($supplier->description) ?>"> </textarea>
          <?php echo form_error('company_street'); ?>
        </div>
        
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
 