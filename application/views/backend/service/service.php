<div class="col-sm-10 col-md-11 main">
    <div class="row" >
        <div class="col-sm-10 col-md-10" style="padding-left:0px;">
            <h1 class="page-header">Dịch vụ Host</h1>
        </div>
         <div class="col-sm-2 col-md-2">
                <a href="<?php echo base_url('admin/services/add_service'); ?>"><button type="button" class="btn btn-primary top_button"><span class="icon-plus-2"></span> Add service</button></a>
            </div>
        <div id="form-search1" >
            <form  class="form-inline" method="POST" action="../admin/bookings" style="float:left;" >
                <div class="form-group" style="width: 500px:">
                    <input style="margin:6px 6px 6px 0px; width: 20%;float: left" type="text" class="form-control"  id="item_type" name="guider_id" placeholder=" Tên Hướng Dẫn Viên">
                    <input style="margin:6px 6px 6px 0px;width: 12%;float: left" type="text" class="form-control" id="time_start"   data-date-format="DD-MM-YYYY"  name="start_day" placeholder="Ngày tạo">
                    <input style="margin:6px 6px 6px 0px;width: 12%;float: left" type="text" class="form-control" id="time_end"  data-date-format="DD-MM-YYYY" name="end_day" placeholder="Ngày kết thúc">
                    <select class="form-control" name="status" style="margin:6px 6px 6px 0px;width: 15%;float: left;placeholder="BookStatus">
                        <option>Chọn Trạng Thái</option>
                        <option  value="0">Mới</option>
                        <option  value="1">Đã Thanh Toán </option>
                        <option  value="2">Hủy</option>
                        <option  value="3">Xác nhận</option>
                        <option  value="4">Hoàn thành</option>
                    </select>
                    <input style="margin:6px 6px 6px 0px;width: 10%;float: left" type="text" class="form-control"  name="money"
                    placeholder="Tổng tiền ">
                    <button style="margin-right:10px;" type="submit"
                    class="btn btn-primary">Tìm kiếm
                    </button>
                </div>
            </form>
        </div>
    </div>
     <?php
        if ($this->session->flashdata('message') != '') echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('message') . '</div>';
        ?>
    </br>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã dịch vụ</th>
                        <th>Tên dịch vụ</th>
                        <th>Icon</th>
                        <th>Mô tả</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $this->load->model('service'); ?>
                    <?php
                    if ($this->pagination->per_page >= $this->pagination->total_rows) $i = 1;
                    else $i = 1 + ($this->pagination->cur_page - 1) * $this->pagination->per_page;
                    foreach ($service as $service):
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $service->id ?></td>
                        <td ><?php echo $service->name ?></td>
                        <td><?php echo $service->icon ?></td>
                        <td><?php echo $service->desc ?></td>
                        <td style="text-align:center">
                            <div class="btn-group" role="group">
                                <a href="<?php echo base_url('admin/services/list_service_by_id/'.$service->id); ?>" class="btn btn-default btn-xs"><span class="icon-pencil" style="color:green"></span> Chỉnh sửa</a>
                                <a href="<?php echo base_url('admin/services/delete_service/' .$service->id); ?>" onclick="return confirm('Bạn có chắc chắn muốn XÓA quảng cáo này?')" class="btn btn-default btn-xs"><span class="icon-cancel-2" style="color:red"></span> Xóa</a>
                            </div>
                        </td>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        <ul class="pagination"><?php echo $links ?></ul>
    </div>
</div>
<div
    "form-2" id="dialog-form" style="display: none; " title="Create Supplier">
    <p class="validateTips">All form fields are required.</p>
    <form name="myform" method="POST" action="../admin/suppliers" onsubmit="return validateForm()">
        <fieldset>
            <div class="form-group">
                <label style="width: 300px" for="userName">Username</label>
                <input type="text" name="userName" id="userName" value="" class="form-control">
            </div>
            <div class="form-group">
                <label style="width: 300px" for="FullName">Password</label>
                <input type="password" name="password" id="FullName" value="" class="form-control">
            </div>
            <div class="form-group">
                <label style="width: 300px" for="SupplierType">Full name</label>
                <input type="text" name="fullname" id="SupplierType" value=""
                class="form-control">
            </div>
            <div class="form-group">
                <label style="width: 300px" for="Type">Type</label>
                <select class="form-control" id="sel1" name="type">
                    <option value="1">Guide</option>
                    <option value=0>Homestay</option>
                    <option value=2>Cars</option>
                </select>
            </div>
            <input type="hidden" name="status" id="sup_profile_id" value="1"
            class="text ui-widget-content ui-corner-all">
            <!--            <submit></submit>-->
            <button style="width:100px; margin-top:20px" type="submit" class="btn btn-success" value="submit"><span
            class="icon-checkmark"></span> <?php echo lang('Submit') ?></button>
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>