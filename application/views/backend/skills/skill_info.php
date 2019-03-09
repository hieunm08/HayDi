 <div class="col-sm-10 col-md-11 main">
          <div class="row" >
            <div class="col-sm-12 col-md-12" style="padding-left:0px;">
             <h1 class="page-header"><a href="<?php echo base_url().'admin/skills' ?>"><i class="mdi mdi-arrow-left-bold-circle-outline"></i></a> Update Skills</h1>
            </div>
          </div>
     <div class="row">
         <div class="col-sm-5 col-md-5">
             <?php $this-> load->model('skill'); ?>
         <?php foreach ($skills as $skills): ?>
    <?php echo form_open('admin/skills/edit_skill/'.$this->uri->segment(4)); ?>
             <div class="form-group">
                 <label for="customer"> Mã Skill</label>
                 <input type="text" disabled class="form-control" name="id" value="<?php echo ( $skills->id ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="item_type"> Tên</label>
                 <input type="text" class="form-control" name="name" value="<?php echo ( $skills->name ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="customer">Icon</label>
                 <input type="text"   class="form-control" name="icon" value="<?php echo ( $skills->icon ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
             <div class="form-group">
                 <label for="customer"> Mô tả </label>
                 <input type="textarea" class="form-control" name="desc" value="<?php echo ( $skills->desc ) ?>">
                 <?php echo form_error('customer'); ?>
             </div>
            
    
             
             <input type="hidden" name="id" value=" <?php echo ($skills->id) ?>">
             <button type="submit" class="btn btn-success"  name="update"  value="submit"><span class="icon-checkmark"></span> cập nhật</button>
             </form>
         </div>
     <?php endforeach; ?>
     </div>
         </div>
