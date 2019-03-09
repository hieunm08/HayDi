 <div class="col-sm-10 col-md-11 main">
          <div class="row" >
            <div class="col-sm-12 col-md-12" style="padding-left:0px;">
             <h1 class="page-header"><a href="<?php echo base_url().'admin/jobs' ?>"><i class="mdi mdi-arrow-left-bold-circle-outline"></i></a> Cập nhật Jobs</h1>
            </div>
          </div>
     <div class="row">
         <div class="col-sm-5 col-md-5">
             <?php $this-> load->model('job'); ?>
         <?php foreach ($jobs as $job): ?>
    <?php echo form_open('admin/jobs/edit_job/'.$this->uri->segment(4)); ?>
    <div class="form-group">
                 <label for="item_type"> Mã</label>
                 <input type="text" disabled class="form-control" name="id" value="<?php echo ( $job->id ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="item_type"> Tên</label>
                 <input type="text" class="form-control" name="name" value="<?php echo ( $job->name ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
            
    
             
             <input type="hidden" name="id" value=" <?php echo ($job->id) ?>">
             <button type="submit" class="btn btn-success"  name="update"  value="submit"><span class="icon-checkmark"></span> Cập nhật</button>
             </form>
         </div>
     <?php endforeach; ?>
     </div>
         </div>
