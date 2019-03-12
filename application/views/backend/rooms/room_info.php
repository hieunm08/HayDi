<div class="col-sm-10 col-md-11 main">
  <div class="row" >
    <div class="col-sm-12 col-md-12" style="padding-left:0px;">
      <h1 class="page-header"><a href="<?php echo base_url().'admin/rooms' ?>"><i class="mdi mdi-arrow-left-bold-circle-outline"></i></a>Cập nhật phòng</h1>
    </div>
  </div>
  <div class="row">
    <?php
    if ($this->session->flashdata('message') != '') echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('message') . '</div>';
    ?>
  </div>
  <div class="row">
    <div class="col-sm-5 col-md-5">
      <?php foreach ($room as $rooms): ?>
      <?php echo form_open('admin/rooms/edit_room') ?>
       <div class="form-group">
        <label for="item_type"> Tên khách sạn</label>
            <input disabled type="text" class="form-control" name="host_id" value="<?php echo $this->host->getHotelName($rooms->host_id) ?>">   
        <?php echo form_error('host_id'); ?>
      </div>
      <div class="form-group">  
        <label for="item_type"> Tên phòng</label>
        <input disabled type="text" class="form-control" name="name" value="<?php echo $rooms->name  ?>">
        <?php echo form_error('name'); ?>
      </div>
      <div class="form-group">
        <label for="item_type">Ảnh</label>
        <input type="file" class="form-control" name="images" value="" multiple>
        <?php echo form_error('images'); ?>
      </div>
      <div class="form-group">
        <label for="item_type">Số giường ngủ</label>
        <input type="text" class="form-control" name="bed_number" value="<?php echo $rooms->bed_number  ?>" >
        <?php echo form_error('bed_number'); ?>
      </div>
      <div class="form-group">
        <label for="company_street">Loại giường</label>
        <select class="form-control"  id="cmbMake" name="bed_type"  >
          <option value= >Chọn</option>
          <option value="single" >Giường đơn</option>
          <option value="double" >Giường đôi</option>
          <option value="bunk">Giường tầng</option>
        </select>
         <?php echo form_error('bed_type'); ?>
      </div>
      <div class="form-group">
        <label for="item_type"> Giá</label>
        <input type="text" class="form-control" name="price" value="<?php echo $rooms->price  ?>">
        <?php echo form_error('price'); ?>
      </div>
      <div class="form-group">
        <label for="company_street">Unit</label>
        <select class="form-control"  id="cmbMake" name="unit"  >
          <option value= >Chọn</option>
          <option value="USD" >USD</option>
          <option value="VND" >VND</option>
        </select>
        <?php echo form_error('unit'); ?>
      </div>     
      <div class="form-group">
        <label for="company_street">Phục vụ ăn sáng</label>
        <select class="form-control"  id="cmbMake" name="is_breakfast"  >
      <?php if ($rooms->is_breakfast=="1"){ ?>
             <option value="1" >Có</option>
             <option value="0" >Không</option>
      <?php }else{ ?>
          <option value="0" >Không</option>
          <option value="1" >Có</option>
         <?php } ?>
        </select>
         <?php echo form_error('is_breakfast'); ?>
      </div>           
      <button type="submit" class="btn btn-success"  name="create"  value="submit"><span class="icon-checkmark"></span>Thêm</button>
    </form>
     <?php  endforeach; ?>
  </div>
</div>
</div>