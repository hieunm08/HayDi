<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>jQuery UI Dialog - Modal form</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="dialog_css.css">
        <style>
        </style>
    </head>
    
    <body>
        <div class="col-sm-10 col-md-11 main">
            <div class="row" style="margin-right:0px;">
                <h1 class="page-header"><?php echo lang('Hướng Dẫn Viên');?></h1>
            </div>
            <div class="row" style="margin-right:0px;margin-bottom: 10px;width: 500px">
                <div class="col-sm-4 col-md-4" style="padding-left:0px;width: 1000px">
                    <form class="form-inline" method="POST" action="../admin/suppliers" style="float:left">
                        <div class="form-group">
                            <input type="text" class="form-control"  name="id"
                            placeholder="ID">
                            <input type="text" class="form-control"  name="name"
                            placeholder="Họ tên">
                            <input type="text" class="form-control"  name="phone"
                            placeholder="Số điện thoại">
                            <input type="text" class="form-control"  name="email"
                            placeholder="Email">
                            <input type="text" class="form-control"  name="address"
                            placeholder="Địa chỉ">
                            <select class="form-control" name="status" style="margin:6px 6px 6px 0px;width: 15%;float: left; placeholder="Trạng thái">
                                <option value="">Chọn Trạng Thái</option>
                                <option  value="0">Active</option>
                                <option  value="1">Inactive </option>
                            </select>
                            <select class="form-control" name="type" style="margin:6px 6px 6px 0px;width: 15%;float: left;placeholder="BookStatus">
                                <option value="">Chọn Chọn Loại</option>
                                <option  value="customer">Người dùng</option>
                                <option  value="guider">Hướng dẫn viên </option>
                            </select>
                            <button style="margin-right:5px;margin-bottom: 10px; margin-top:10px;" type="submit"
                            class="btn btn-primary"><?php echo lang('Search supplier'); ?>Search
                            </button>
                            <button style="margin-right:5px;margin-bottom: 10px; margin-top:10px;" type="button" id="btnadd"
                            class="btn btn-advance"> Add
                            </button>
                        </div>
                    </form>
                    <form method="post" class="col-sm-4 col-md-4" action="" enctype="multipart/form-data" style="float: left;width:500px;">
                        <input type="file" name="file" style="float: left;margin-top: 18px"/>
                        <button type="submit" name="uploadclick" class="btn btn-primary"
                        style="margin-right:5px;margin-bottom: 10px; margin-top:10px;float: left" value="Upload">Up File
                        </button>
                    </form>
                </div>
            </div>
            <div class="row">
                <?php
                if ($this->session->flashdata('message') != '') echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('message') . '</div>';
                ?>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã tài khoản</th>
                                <th>Họ tên</th>
                                <th>SĐT</th>
                                <th>Nguồn</th>
                                <th>Email</th>
                                <th>Sub Phone</th>
                                <th>Địa chỉ</th>
                                <th>Mã quốc gia</th>
                                <th>Level</th>
                                <th>Trạng thái hoạt động</th>
                                <th>Tổng đơn hàng</th>
                                <th>Ngôn ngữ</th>
                                <th>Trạng thái tài khoản</th>
                                <th>Loại</th>
                                <th>Giá</th>
                                <th>Đơn vị giá</th>
                                <th>Ngày đăng kí</th>
                                <th>Ngày cập nhật</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $this->load->model('supplier'); ?>
                            <?php
                            if ($this->pagination->per_page > $this->pagination->total_rows) $i = 1;
                            else $i = 1 + ($this->pagination->cur_page - 1) * $this->pagination->per_page;
                            foreach ($suppliers as $supplier):
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $supplier->id ?></td>
                                <td><?php echo $supplier->name ?></td>
                                <td><?php echo $supplier->phone ?></td>
                                <td><?php echo $supplier->source ?></td>
                                <td><?php echo $supplier->email ?></td>
                                <td><?php echo $supplier->sub_phone ?></td>
                                <td><?php echo $supplier->address ?></td>
                                <td><?php echo $supplier->country_code ?></td>
                                <td><?php echo $supplier->level ?></td>
                                <td><?php echo $this->supplier->showSupplierStatus($supplier->status) ?></td>
                                <td><?php echo $supplier->order_total ?></td>
                                <td><?php echo $supplier->language ?></td>
                                <td><?php echo $this->supplier->showActiveGuider($supplier->active_guide) ?></td>
                                <td><?php echo $this->supplier->showSupplierType($supplier->type) ?></span></td>
                                <td><?php echo $supplier->price ?></td>
                                <td><?php echo $supplier->unit ?></td>
                                <td><span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $supplier->created_at))?>
                            </td>
                            <td><span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $supplier->updated_at))?>
                        </td>
                        
                        <td style="text-align:center">
                            <div class="btn-group" role="group">
                                <a href="<?php echo base_url('admin/suppliers/list_suppliers_by_id/'.$supplier->id); ?>" class="btn btn-default btn-xs"><span class="icon-pencil" style="color:green"></span> Update</a>
                                <?php if ($supplier->active_guide==1) {
                                ?>
                                <a href="<?php echo base_url("admin/suppliers/active_guider?id={$supplier->id}&active_guide={$supplier->active_guide}"); ?>"
                                    onclick="return confirm('Are you sure you want to Block this supplier?')"
                                    class="btn btn-default btn-xs"><span class="icon-minus" style="color:red"></span>
                                Khóa tài khoản</a>
                                <?php }else{ ?>
                                <a href="<?php echo base_url("admin/suppliers/active_guider?id={$supplier->id}&active_guide={$supplier->active_guide}"); ?>"
                                    onclick="return confirm('Are you sure you want to Active this supplier?')"
                                    class="btn btn-default btn-xs"><span class="icon-plus" style="color:blue"></span>
                                Kích hoạt</a>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
                </tbody>
            </table>
        </div>
        <nav aria-label="...">
        <ul class="pagination pagination-sm"><?php echo $links ?></ul>
    </nav>
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
</body>