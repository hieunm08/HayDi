 <div class="col-sm-10 col-md-11 main">
          <div class="row" >
            <div class="col-sm-12 col-md-12" style="padding-left:0px;">
             <h1 class="page-header"><a href="<?php echo base_url().'admin/skills' ?>"><i class="icon-arrow-left-3"></i></a> Create Skills</h1>
            </div>
          </div>
     <div class="row">
         <div class="col-sm-5 col-md-5">
             <?php $this-> load->model('skill'); ?>
    <?php echo form_open('admin/skills/add_skill') ?>
             <div class="form-group">
                 <label for="item_type">Tên User</label>
                 <input type="text" class="form-control" name="name" value="">
                 <?php echo form_error('name'); ?>
             </div>
             <div class="form-group">
                 <label for="customer">Icon</label>
                 <input type="text"   class="form-control" name="icon" value="">
                 <?php echo form_error('icon'); ?>
             </div>
             <div class="form-group">
                 <label for="customer">Mô tả </label>
                 <input type="textarea" class="form-control" name="desc" value="">
                 <?php echo form_error('desc'); ?>
             </div>
            
    
             
             <button type="submit" class="btn btn-success"  name="create"  value="submit"><span class="icon-checkmark"></span> Create</button>
             </form>
         </div>
     </div>
         </div>
