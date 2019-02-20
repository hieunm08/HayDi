 <div class="col-sm-10 col-md-11 main">
          <div class="row" >
            <div class="col-sm-12 col-md-12" style="padding-left:0px;">
             <h1 class="page-header"><a href="<?php echo base_url().'admin/jobs' ?>"><i class="icon-arrow-left-3"></i></a> Create Jobs</h1>
            </div>
          </div>
     <div class="row">
         <div class="col-sm-5 col-md-5">
             <?php $this-> load->model('job'); ?>
    <?php echo form_open('admin/jobs/add_job') ?>
             <div class="form-group">
                 <label for="item_type"> Tên</label>
                 <input type="text" class="form-control" name="name" value="">
                 <?php echo form_error('customer'); ?>
             </div>
             <button type="submit" class="btn btn-success"  name="create"  value="submit"><span class="icon-checkmark"></span> Create</button>
             </form>
         </div>
     </div>
         </div>
