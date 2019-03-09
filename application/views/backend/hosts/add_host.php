<div class="col-sm-10 col-md-11 main">
  <div class="row" >
    <div class="col-sm-12 col-md-12" style="padding-left:0px;">
      <h1 class="page-header"><a href="<?php echo base_url().'admin/hosts' ?>"><i class="icon-arrow-left-3"></i></a> Tạo host</h1>
    </div>
  </div>
  <div class="row">
    <?php
    if ($this->session->flashdata('message') != '') echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('message') . '</div>';
    ?>
  </div>
  <div class="row" >
    <div class="col-sm-4 col-md-4">
    <?php echo form_open('admin/hosts/add_host') ?> 
        <div class="form-group">
          <label for="company_name">Họ tên</label>
          <input type="text" class="form-control" id="company_name" name="name" value="">
        </div>
        <div class="form-group">
          <label for="company_name">SĐT</label>
          <input type="text" class="form-control" id="company_name" name="phone" value="">
        </div>
        <div class="form-group">
          <label for="company_name">Email</label>
          <input type="text" class="form-control" id="company_name" name="email" value="">
        </div>
        <div class="form-group">
          <label for="company_name">Ảnh</label>
          <input type="text" class="form-control" id="company_name" name="images" value="">
        </div>
        <div class="form-group">
          <label for="company_name">Video</label>
          <input type="text" class="form-control" id="company_name" name="video" value="">
        </div>
      	<div class="form-group">
          <label for="company_name">Giới thiệu</label>
          <input type="text" class="form-control" id="company_name" name="intro" value="">
        </div>
        
       

        
      </div>
      <div class="col-sm-4 col-md-4">
      	<div class="form-group">
          <label for="company_name">Địa chỉ</label>
          <input type="text" class="form-control" id="company_name" name="address" value="">
        </div>
        <div class="form-group">
          <label for="company_street">Mã Quốc Gia</label> 
          <select class="form-control"  id="cmbMake" name="country_code"  >
              <?php foreach ($city_code as $city_code ){ ?>  
                <option value=<?php echo $city_code->code  ?> ><?php echo $city_code->code ?></option>
              <?php } ?> 
          </select>
          
        </div>
        
        <div class="form-group">
          <label for="company_street">Giá</label>
          <input type="text" class="form-control" id="company_street" name="price" value="" >
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Giá trẻ em</label>
          <input type="text" class="form-control" id="country_input" name="price_baby" value="" >
        </div>
     	<div class="form-group">
          <label for="company_street">Đơn vị giá</label>
        	<select class="form-control"  id="cmbMake" name="unit"  >    
	            <option value="USD" >USD</option>
	 			<option value="VND">VND</option>
          	</select>
        </div>
    </div>
        <div class="col-sm-4 col-md-4">

        <div class="form-group">
          <label for="company_street">Phụ phí</label>
            <input type="text" class="form-control" id="company_street" name="surcharge" value=" ">
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Tổng phòng</label>
            <input type="text" class="form-control" id="company_street" name="room_number" value=" ">
          <?php echo form_error('company_street'); ?>
        </div>
         <div class="form-group">
          <label for="company_street">Tổng số khách cùng thời điểm</label>
            <input type="text" class="form-control" id="company_street" name="customers_same_time" value=" ">
          <?php echo form_error('company_street'); ?>
        </div>
        <div class="form-group">
          <label for="company_street">Ở cùng chủ</label>
        	<select class="form-control"  id="cmbMake" name="with_boss"  >    
	            <option value="1" >Có</option>
	 			<option value="0">Không</option>
          	</select>
        </div>
        <div class="form-group">
          <label for="company_street">Loại</label>
          <select class="form-control" id="cmbMake" name="type"  >
            <option id="hide" value="host" >Host</option>
            <option id="show" value="hotel">Hotel</option>
          </select>
        </div>
       
      
        </div>


         <div class="form-group">
          <button style="width:100px; margin-top:20px" name="create" type="submit" class="btn btn-primary" value="submit"><span
          class="icon-checkmark"></span>Tạo</button>
        </div>


      </form>
    
    </div>
  

<div class="host">
<div class="col-sm-4 col-md-4">
  <div class="form-group">
    <label for="company_street">Phụ phí</label>
    <input type="text" class="form-control" id="company_street" name="surcharge" value=" ">
    <?php echo form_error('company_street'); ?>
  </div>
  <div class="form-group">
    <label for="company_street">Tổng phòng</label>
    <input type="text" class="form-control" id="company_street" name="room_number" value=" ">
    <?php echo form_error('company_street'); ?>
  </div>
  <div class="form-group">
    <label for="company_street">Tổng số khách cùng thời điểm</label>
    <input type="text" class="form-control" id="company_street" name="customers_same_time" value=" ">
    <?php echo form_error('company_street'); ?>
  </div>
</div>
</div>

<div class="hotel">
<div class="col-sm-4 col-md-4">
  <div class="form-group">
    <label for="company_street">Phụ phí</label>
    <input type="text" class="form-control" id="company_street" name="surcharge" value=" ">
    <?php echo form_error('company_street'); ?>
  </div>
  <div class="form-group">
    <label for="company_street">Tổng phòng</label>
    <input type="text" class="form-control" id="company_street" name="room_number" value=" ">
    <?php echo form_error('company_street'); ?>
  </div>
  <div class="form-group">
    <label for="company_street">Tổng số khách cùng thời điểm</label>
    <input type="text" class="form-control" id="company_street" name="customers_same_time" value=" ">
    <?php echo form_error('company_street'); ?>
  </div>
</div>
</div>






  </div>
<p>If you click on the "Hide" button, I will disappear.</p>

<button id="">Host</button>
<button id="">Hotel</button>

    
<script>

   $(document).ready(function(){
  $("#hide").click(function(){
    $(".hotel").hide();
  });
  $("#show").click(function(){
    $(".hotel").show();
  });
});

</script>
 