<?php $this->load->view('includes/header'); ?>
    <div class="container-fluid page-body-wrapper">
        <?php $this->load->view('includes/navigation'); ?>
      	<div class="main-panel" style="margin-top: 10px; margin-left: 30px;">
    		<?php $this->load->view($main_content); ?>
			<footer class="footer">
				<div class="container-fluid clearfix">
					<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
						<a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
						<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted &amp; made with
							<i class="mdi mdi-heart text-danger"></i>
					</span>
				</div>
			</footer>
    	</div>
    </div><!-- #endof row -->

<script src="<?php echo base_url(); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>/js/docs.min.js"></script>
     <script src="<?php echo base_url(); ?>/js/moment.js"></script>
    <script src="<?php echo base_url(); ?>/js/datetimepicker.js"></script>
    <script src="<?php echo base_url(); ?>vendors/js/vendor.bundle.base.js"></script>
    <script src="<?php echo base_url(); ?>vendors/js/vendor.bundle.addons.js"></script>
    <script src="<?php echo base_url(); ?>js/misc.js"></script>
    <script src="<?php echo base_url(); ?>js/off-canvas.js"></script>
    <script src="<?php echo base_url(); ?>js/dashboard.js"></script>

   </body>
</html>