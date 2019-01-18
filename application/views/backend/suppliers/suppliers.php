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
        <body>
            <div class="col-sm-10 col-md-11 main">
                <div class="row" style="margin-right:0px;">
                    <h1 class="page-header"><?php echo lang('Hướng Dẫn Viên');?></h1>
                </div>
                <div class="row" style="margin-right:0px;margin-bottom: 10px;width: 500px">
                    <div class="col-sm-4 col-md-4" style="padding-left:0px;width: 1000px">
                        <form class="form-inline" method="POST" action="../admin/suppliers" style="float:left">
                            <div class="form-group">
                                <input type="text" class="form-control"  name="supplier_search"
                                placeholder="<?php echo lang('Supplier cd') ?>">
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
                <div class="row" style="margin-right:0px;margin-bottom: 10px;width: 500px;">
                    <div class="col-sm-4 col-md-4" style="padding-left:0px;width: 1000px">
                        <form class="form-inline" method="GET" action="../admin/suppliers/list_suppliers_by_item" style="float:left" >
                            <div class="col-sm-4 col-md-4" style="padding-left:0px;width: 1000px">
                                <div class="form-group" >
                                    <!-- <label for="company_street">Username</label> -->
                                    <input type="text" class="form-control"  name="username"
                                    placeholder=Username>
                                </div>
                                <div class="form-group" style="margin-left: 20px;">
                                    <!-- <label for="company_street">Username</label> -->
                                    <input type="text" class="form-control"  name="fullname"
                                    placeholder=Fullname>
                                    
                                </div>
                                
                                <div class="form-group" style="margin-left: 20px;">
                                    <!-- <label for="company_street">Username</label> -->
                                    <select class="form-control" id="lt" name="type">
                                        <option value=""></option>
                                        <option value="">Guide</option>
                                        <option value="">Homestay</option>
                                        <option value="">Cars</option>
                                    </select>
                                    <!--  <input type="text" class="form-control" name="supplier_search"
                                    placeholder=Type> -->
                                    
                                </div>
                                <div class="form-group" style="margin-left: 20px;">
                                    <!-- <label for="company_street">Username</label> -->
                                    <select class="form-control" id="sel1" name="status">
                                        <option value=""></option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <!--  <input type="text" class="form-control" name="status"
                                    placeholder=Status> -->
                                    
                                </div>
                                <button style="margin-right:5px;margin-bottom: 10px; margin-top:10px; margin-left: 20px;" type="Submit" id="btnadd"
                                class="btn btn-info"> Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th><?php echo lang('ID number'); ?></th>
                                    <th>Họ tên</th>
                                    <th>SĐT</th>
                    
                                    <th>Nguồn</th>
                                    <th>Email</th>
                                    <th>Sub Phone</th>
                                    <th>Địa chỉ</th>
                                    <th>Mã quốc gia</th>
                                    <th>Level</th>
                                    <th>Trạng thái</th>
                                    <th>Type</th>
                                    <th>Giá</th>
                                    <th>Đơn vị giá</th>
                                    <th>Ngày đăng kí</th>
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
                                    <td><?php echo $this->supplier->show_Supplier_Status($supplier->status) ?></td>
                                    <td><span class="label label-info"><?php echo $supplier->type ?></span></td>
                                    <td><?php echo $supplier->price ?></td>
                                    <td><?php echo $supplier->price_unit ?></td>
                                    <td><span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $supplier->created_at))?>
                                </td>
                                
                                <!--  // cái list_tickets là gì đấuy
                                //hinh nhu no la cai danh sách thoi ông
                                uh còn cái model kia ô muốn lấy gì thì select cái đó nhé nãy tôi tiện nên tôi lấy * luôn còn ông muốn lấy trường nào thì lấy trg đó vs lại nó có oder by đó -->
                                <td style="text-align:center">
                                    <div class="btn-group" role="group">
                                        <!--                                <a href="" onclick="return confirm('Are you sure you want to delete this booking ticket?')" class="btn btn-default btn-xs"><span class="icon-cancel-2" style="color:red"></span> -->
                                        <?php //echo lang('Delete')
                                        ?><!--</a>-->
                                        <a href="<?php echo base_url('admin/suppliers/list_suppliers_by_id/' . $supplier->id ); ?>"class="btn btn-info btn-xs">
                                            <span class="icon-search"><?php echo lang('View') ?></span></a>
                                            <?php if ($supplier->status==1) {
                                                 ?> 
                                            <a href="<?php echo base_url("admin/suppliers/block_Supplier?id={$supplier->id}&status={$supplier->status}"); ?>"
                                                onclick="return confirm('Are you sure you want to Block this supplier?')"
                                                class="btn btn-warning   btn-xs"></span>
                                            Block</a>
                                           <?php }else{ ?>
                                                 <a href="<?php echo base_url("admin/suppliers/block_Supplier?id={$supplier->id}&status={$supplier->status}"); ?>"
                                                onclick="return confirm('Are you sure you want to Active this supplier?')"
                                                class="btn btn-success btn-xs">
                                            Active</a>
                                            <?php } ?>

                                            <a href="<?php echo base_url('admin/suppliers/delete_supplier/' .$supplier->id) ?>"
                                                onclick="return confirm('Are you sure you want to delete this supplier?')"
                                                class="btn btn-danger   btn-xs"></span>
                                            Delete</a>


                                        </div>
                                    </td>
                                </tr>
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
    </body>
    <script>
    function validateForm() {
    // Bước 1: Lấy giá trị của username và password
    var userName = document.myform.username.value;
    var FullName = document.myform.FullName.value;
    var SupplierType = document.myform.SupplierType.value;
    var active = document.myform.active.value;
    var sup_profile_id = document.myform.sup_profile_id.value;
    // Bước 2: Kiểm tra dữ liệu hợp lệ hay không
    if (userName == '') {
    alert('Bạn chưa nhập tên đăng nhập');
    } else if (FullName == '') {
    alert('Bạn chưa nhập tên');
    } else if (SupplierType == '' || !isNaN(SupplierType)) {
    alert("nhap khong hop le!");
    } else if (active == '') {
    alert("bạn chưa nhập dữ liệu");
    } else if (sup_profile_id == '') {
    alert("bạn chưa nhập dữ liệu");
    }
    return false;
    }
    $(document).ready(function () {
    $("#btnadd").click(function () {
    $('#dialog-form').dialog();
    //TODO daon nay chu ok chua check dc
    validateForm();
    })
    });
    </script>