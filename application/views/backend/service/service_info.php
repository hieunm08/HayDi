 <div class="col-sm-10 col-md-11 main">
          <div class="row" >
            <div class="col-sm-12 col-md-12" style="padding-left:0px;">
             <h1 class="page-header"><a href="<?php echo base_url().'admin/services' ?>"><i class="icon-arrow-left-3"></i></a> Update Service</h1>
            </div>
          </div>
     <div class="row">
         <div class="col-sm-5 col-md-5">
             <?php $this-> load->model('service'); ?>
         <?php foreach ($service as $service): ?>
    <?php echo form_open('admin/services/edit_service/'.$this->uri->segment(4)); ?>
             <div class="form-group">
                 <label for="customer"> Mã Service</label>
                 <input type="text" disabled class="form-control" name="id" value="<?php echo ( $service->id ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="item_type"> Tên</label>
                 <input type="text" class="form-control" name="name" value="<?php echo ( $service->name ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="customer">Icon</label>
                 <input type="text"   class="form-control" name="icon" value="<?php echo ( $service->icon ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="customer"> Ghi Chú </label>
                 <input type="textarea" class="form-control" name="desc" value="<?php echo ( $service->desc ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
            
    
             
             <input type="hidden" name="id" value=" <?php echo ($service->id) ?>">
             <button type="submit" class="btn btn-success"  name="update"  value="submit"><span class="icon-checkmark"></span> Update</button>
             </form>
         </div>
     <?php endforeach; ?>
     </div>
         </div>
