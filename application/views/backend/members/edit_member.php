
        <div class="col-sm-10 col-md-11 main">
          <div class="row" >
            <div class="col-sm-12 col-md-12" style="padding-left:0px;">
                <h1 class="page-header"><a href="<?php echo base_url().'admin/members' ?>"><i class="icon-arrow-left-3"></i></a> <?php echo lang('Edit Member')?></h1>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-5 col-md-5">
             <?php echo form_open('admin/members/edit_member/'.$this->uri->segment(4)); ?>
                <div class="form-group">
                  <label for="username"><?php echo lang('Username')?></label>
                  <input type="text" class="form-control" name="username" value="<?php echo set_value('username', $user->username ); ?>">
                  <?php echo form_error('username'); ?>
                </div>
                <div class="form-group">
                  <label for="password">Mật khẩu</label>
                  <input type="password" class="form-control" name="password">
                  <?php echo form_error('password'); ?>
                </div>
                <div class="form-group">
                  <label for="passagain">Xác nhận mật khẩu</label>
                  <input type="password" class="form-control" name="passagain" >
                  <?php echo form_error('passagain'); ?>
                </div>
                <div class="form-group">
                  <label for="firstname"><?php echo lang('First name')?></label>
                  <input type="text" class="form-control" name="firstname" value="<?php echo set_value('firstname', $user->firstname ); ?>">
                  <?php echo form_error('firstname'); ?>
                </div>
                <div class="form-group">
                  <label for="lastname"><?php echo lang('Last name')?></label>
                  <input type="text" class="form-control" name="lastname" value="<?php echo set_value('lastname', $user->lastname ); ?>">
                  <?php echo form_error('lastname'); ?>
                </div>
                <div class="form-group">
                  <label for="email"><?php echo lang('E-Mail')?></label>
                  <input type="email" class="form-control" name="email" value="<?php echo set_value('email', $user->email ); ?>">
                  <?php echo form_error('email'); ?>
                </div>
                <div class="form-group">
                  <label for="role"><?php echo lang('Role')?>: </label>
                  <?php if($user->role == '1') {?>
                  <label class="radio-inline">
                    <input type="radio" name="role" value="0" <?php echo set_radio('role','0', $user->role == '0'); ?>>Quản trị
                  </label>
                  <label class="radio-inline">
                    <input type="radio" checked name="role" value="1" <?php echo set_radio('role', '1', $user->role == '1'); ?>>Nhân viên
                    <?php }else{ ?>
                  <label class="radio-inline">
                    <input type="radio" checked name="role" value="0" <?php echo set_radio('role','0', $user->role == '0'); ?>>Quản trị
                  </label>
                  <label class="radio-inline">
                    <input type="radio"  name="role" value="1" <?php echo set_radio('role', '1', $user->role == '1'); ?>>Nhân viên
                    <?php } ?>
                  </label>
                  <?php echo form_error('role'); ?>
                </div>

              <button type="submit" class="btn btn-success" value="submit"><span class="icon-checkmark"></span> <?php echo lang('Submit')?></button>
              </form>
            </div>
          </div>
         </div>
