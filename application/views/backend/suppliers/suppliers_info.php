
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
                <label for="company_name">Username</label>
                <input type="text" class="form-control" id="company_name" name="userName" value="<?php echo($supplier->supplier_User) ?>">            
              </div>
              <div class="form-group">
                <label for="company_street">Password</label>
                <input type="text" class="form-control" id="company_street" name="password" value="<?php echo($supplier->supplier_Pass) ?>" >
                <?php echo form_error('company_street'); ?>
              </div>
               <div class="form-group">
                <label for="company_street">Fullname</label>
                <input type="text" class="form-control" id="company_street" name="fullname" value="<?php echo($supplier->supplier_Fullname) ?> ">
                <?php echo form_error('company_street'); ?>
              </div>
              <div class="form-group">
                <label for="company_street">Type</label>
                <input type="text" class="form-control" id="company_street" name="type" value="<?php echo($supplier->supplier_Type) ?> ">
                <?php echo form_error('company_street'); ?>
              </div>
                <div class="form-group">
                <label for="company_street">Status</label>
                <input type="text" class="form-control" id="company_street" name="status" value="<?php echo($supplier->supplier_Status) ?> ">
                <?php echo form_error('company_street'); ?>
              </div>

              <input type="hidden" name="id" value=" <?php echo ($supplier->supplier_ID) ?>">
             
           

                <button style="width:100px; margin-top:20px" name="update" type="submit" class="btn btn-success" value="submit"><span
                    class="icon-checkmark"></span> Update</button>
                  </form>
              </div>
            
         
          <?php  endforeach ?>
          </div>

         </div>
