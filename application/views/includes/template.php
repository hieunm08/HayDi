<?php $this->load->view('includes/header'); ?>
    <div class="container-fluid page-body-wrapper">
        <?php $this->load->view('includes/navigation'); ?>
      	<div class="main-panel" style="margin-top: 10px; margin-left: 30px;">
    		<?php $this->load->view($main_content); ?>
    	</div>
    </div><!-- #endof row -->
<?php $this->load->view('includes/footer'); ?>


