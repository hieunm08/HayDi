
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
          <div class="row">
           <?php $this->load->model('supplier'); ?>
               <?php
                foreach ($suppliers as $supplier):
                    ?>
            <div class="col-sm-6 col-md-4"> 
              <form method="GET" action="../updateSupplier">
              <div class="form-group"> 
                <label for="company_name">Họ tên</label>
                <input type="text" class="form-control" id="company_name" name="userName" value="<?php echo($supplier->name) ?>">            
              </div>
              <div class="form-group"> 
                <label for="company_name">SĐT</label>
                <input type="text" class="form-control" id="company_name" name="userName" value="<?php echo($supplier->phone) ?>">        
              </div>
               <div class="form-group"> 
                <label for="company_name">Email</label>
                <input type="text" class="form-control" id="company_name" name="userName" value="<?php echo($supplier->email) ?>">        
              </div>
               <div class="form-group"> 
                <label for="company_name">Sub Phone</label>
                <input type="text" class="form-control" id="company_name" name="userName" value="<?php echo($supplier->sub_phone) ?>">        
              </div>
              <div class="form-group">
                <label for="company_street">Địa chỉ</label>
                <input type="text" class="form-control" id="company_street" name="password" value="<?php echo($supplier->address) ?>" >
                <?php echo form_error('company_street'); ?>
              </div>
                <div class="form-group">
                <label for="company_street">Mã Quốc Gia</label>
                <input type="text" class="form-control" id="company_street" name="password" value="<?php echo($supplier->country_code) ?>" >
            </div>
              </div>
                <div class="form-group">
                <label for="company_street">Password</label>
                <input type="text" class="form-control" id="company_street" name="password" value="<?php echo($supplier->address) ?>" >
                <?php echo form_error('company_street'); ?>
              </div>
      
              <div class="form-group">
                <label for="company_street">Type</label>
                  <select class="form-control" id="sel1" name="type">  
                    <option value="1">Guide</option>
                    <option value=0>Homestay</option>
                    <option value=2>Cars</option>
                  </select>
              <!--   <input type="text" class="form-control" id="company_street" name="type" value="<?php echo($supplier->supplier_Type) ?> "> -->
                <?php echo form_error('company_street'); ?>
              </div>
                <div class="form-group">
                <label for="company_street">Status</label>
                <select class="form-control" id="sel1" name="status">  
                    <option value="1">Active</option>
                    <option value=0>Inactive</option>
                  </select>
               <!--  <input type="text" class="form-control" id="company_street" name="status" value="<?php echo($supplier->supplier_Status) ?> "> -->
                <?php echo form_error('company_street'); ?>
              </div>

              <input type="hidden" name="id" value=" <?php echo ($supplier->id) ?>">
             
           

                <button style="width:100px; margin-top:20px" name="update" type="submit" class="btn btn-success" value="submit"><span
                    class="icon-checkmark"></span> Update</button>
                  </form>
              </div>
            
         
          <?php  endforeach ?>
          </div>

         </div>
