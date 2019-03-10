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
    foreach ($hosts as $host){
    }
    ?>
    <div class="col-sm-4 col-md-4">
    <?php echo form_open('admin/hosts/edit_host/'.$this->uri->segment(4)); ?> 
        <div class="form-group">
          <label for="company_name">Họ tên</label>
          <input type="text" class="form-control" id="company_name" name="name" value="<?php echo $host->id ?>">
        </div>
        <div class="form-group">
          <label for="company_name">SĐT</label>
          <input type="text" class="form-control" id="company_name" name="phone" value="<?php echo $host->phone ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Email</label>
          <input type="text" class="form-control" id="company_name" name="email" value="<?php echo $host->email ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Ảnh</label>
          <input type="file" class="form-control" id="company_name" multiple name="images[]" value="<?php echo $host->image ?>">
        </div>
        <div class="form-group">  
          <label for="company_name">Video</label>
          <input type="text" class="form-control" id="company_name" name="video" value="<?php echo $host->video ?>">
        </div>
        <div class="form-group">
          <label for="company_name">Giới thiệu</label>
          <input type="text" class="form-control" id="company_name" name="intro" value="<?php echo $host->intro ?>">
        </div>
        
       

        
      </div>
      <div class="col-sm-4 col-md-4">
        <div class="form-group">
          <label for="company_name">Địa chỉ</label>
          <input type="text" class="form-control" id="company_name" name="address" value="<?php echo $host->address ?>">
        </div>
        <div class="form-group">
          <label for="company_street">Mã Quốc Gia</label> 
          <select class="form-control"  id="cmbMake" name="country_code"  >
              <option value=<?php echo $host->country_code  ?> ><?php echo $host->country_code ?></option>
              <?php foreach ($city_code as $city_code ){ ?>  
                <option value=<?php echo $city_code->code  ?> ><?php echo $city_code->code ?></option>
              <?php } ?> 
          </select>
          
        </div>
        
        <div class="form-group">
          <label for="company_street">Giá</label>
          <input type="text" class="form-control" id="company_street" name="price" value="<?php echo $host->price ?>" >
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Giá trẻ em</label>
          <input type="text" class="form-control" id="country_input" name="price_baby" value="<?php echo $host->price_baby ?>" >
        </div>
        <?php $type = array("USD","VND");
        array_unshift($type,   $host->unit );
        $result=array_unique($type);

     ?> 
    <div class="form-group">
        <label for="item_type">Đơn vị giá</label>
        <select  class="form-control" id="cmbMake" name="unit" >
          <?php foreach ($result as $result): ?>
            <option value=<?php echo $result ?> ><?php echo $result ?></option>
          <?php endforeach ?>
          
        </select>
    </div>
        <div class="form-group">
          <label for="role"> Trạng Thái </label>
          <br>
          <?php if($host->status == 'active') {?>
          <label class="radio-inline">
            <input type="radio" checked name="status" value="active" >Active
          </label>
          <label class="radio-inline">
            <input type="radio"  name="status" value="inactive" >Inactive
            <?php }else{ ?>
            <label class="radio-inline">
              <input type="radio" checked name="status" value="inactive" >Inactive
            </label>
            <label class="radio-inline">
              <input type="radio"  name="status" value="active" >Active
              <?php } ?>
            </label>
          </label>
        </div>

        </div>
        <div class="col-sm-4 col-md-4">
        
        <div class="form-group">
          <label for="company_street">Trạng thái phòng</label>
          <br>
          <?php if($host->is_full == '0') {?>
          <label class="radio-inline">
            <input type="radio" checked name="is_full" value="0" >Còn phòng
          </label>
          <label class="radio-inline">  
            <input type="radio"  name="is_full" value="1" > Đã đầy
            <?php }else{ ?>
            <label class="radio-inline">
              <input type="radio" checked name="is_full" value="1" >Đã đầy
            </label>
            <label class="radio-inline">
              <input type="radio"  name="is_full" value="0" >Còn phòng
              <?php } ?>
            </label>
          </label>
        </div>
        <div class="form-group">
          <label for="company_street">Phụ phí</label>
            <input type="text" class="form-control" id="company_street" name="surcharge" value="<?php echo $host->surcharge ?>">
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Tổng số phòng</label>
            <input type="text" class="form-control" id="company_street" name="room_number" value="<?php echo $host->room_number ?> ">
          <?php echo form_error('company_street'); ?>
        </div>
         <div class="form-group">
          <label for="company_street">Tổng số khách cùng thời điểm</label>
            <input type="text" class="form-control" id="company_street" name="customers_same_time" value="<?php echo $host->customers_same_time ?> ">
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Ở cùng chủ</label>
          <select class="form-control"  id="cmbMake" name="with_boss"  >    
              <option value="1" >Có</option>
        <option value="0">Không</option>
            </select>
        </div>
         <?php $type = array("host","hotel");
        array_unshift($type,   $host->type );
        $result=array_unique($type);

     ?> 
    <div class="form-group">
        <label for="item_type">Loại</label>
        <select  class="form-control" id="cmbMake" name="type" >
          <?php foreach ($result as $result): ?>
            <option value=<?php echo $result ?> ><?php echo $result ?></option>
          <?php endforeach ?>
          
        </select>
    </div>
        
        <input type="hidden" class="form-control" id="company_street" name="id" value="<?php echo $host->id ?>">
        </div>


         <div class="form-group">
          <button style="width:100px; margin-top:20px" name="create" type="submit" class="btn btn-primary" value="submit"><span
          class="icon-checkmark"></span>Tạo</button>
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
 