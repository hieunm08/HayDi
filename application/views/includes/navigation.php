<?php $page = $this->uri->segment(2);
$this->load->helper('language');
$this->lang->load('navigation', $this->session->userdata('language'));
?>
<?php if ($this->session->userdata['role'] == 0) { //ADMINISTATOR ?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
            <img src="<?php echo base_url(); ?>images/faces/face1.jpg" alt="profile image">
          </div>
          <div class="text-wrapper">
            <p class="profile-name"><?php echo ($this->session->userdata['firstname']) ?></p>
            <div>
              <small class="designation text-muted">Admin</small>
              <span class="status-indicator online"></span>
            </div>
          </div>
        </div>
        <button class="btn btn-success btn-block">New Project
        <i class="mdi mdi-plus"></i>
        </button>
      </div>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="<?php echo base_url() ?>admin/dashboard">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#order" aria-expanded="false" aria-controls="ui-basic">
        <i class="menu-icon mdi mdi-content-copy"></i>
        <span class="menu-title">Đơn Hàng</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="order">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>admin/bookings">Hướng Dẫn Viên</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>admin/bookings/list_booking_host">Host</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#payment" aria-expanded="false" aria-controls="ui-basic">
        <i class="menu-icon mdi mdi-content-copy"></i>
        <span class="menu-title">Thanh Toán</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="payment">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>admin/payments">Thu nhập</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>admin/payments/list_payment_out">Rút tiền</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url() ?>admin/suppliers">
        <i class="menu-icon mdi mdi-chart-line"></i>
        <span class="menu-title">Hướng Dẫn Viên</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url() ?>admin/hosts">
        <i class="menu-icon mdi mdi-table"></i>
        <span class="menu-title">Hosts</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url() ?>admin/trips">
        <i class="menu-icon mdi mdi-table"></i>
        <span class="menu-title">Trips</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url() ?>admin/members">
        <i class="menu-icon mdi mdi-backup-restore"></i>
        <span class="menu-title">Thành Viên</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="ui-basic">
        <i class="menu-icon mdi mdi-content-copy"></i>
        <span class="menu-title">Thiết lập</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="setting">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>admin/campaigns">Chiến dịch</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>admin/jobs">Công việc</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>admin/news">Tin tức</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>admin/services">Dịch vụ host</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>admin/skills">Kĩ năng</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>admin/sponsors">Quảng cáo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>admin/rooms">Room</a>
          </li>
        </ul>
      </div>
    </li>
   
  </ul>
</nav>
<?php } ?>