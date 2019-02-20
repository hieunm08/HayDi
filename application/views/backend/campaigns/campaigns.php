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
                    <h1 class="page-header">Chiến dịch</h1>
                </div>
    <div class="row" style="margin-right:0px;margin-bottom: 10px;width: 500px">
        <div class="col-sm-4 col-md-4" style="padding-left:0px;width: 1000px">
            <form class="form-inline" method="POST" action="../admin/campaigns" style="float:left">
                <div class="form-group">
                    <input type="text" class="form-control"  name="supplier_search"
                           placeholder="<?php echo lang('Supplier cd') ?>">
                    <button style="margin-right:5px;margin-bottom: 10px; margin-top:10px;" type="submit"
                            class="btn btn-primary"><?php echo lang('Search supplier'); ?>Search
                    </button>

                    <button style="margin-right:5px;margin-bottom: 10px; margin-top:10px;" name="add" type="submit" id="btnadd"
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

    <div class="row" style="margin-right:0px;margin-bottom: 10px;width: 500px">
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
                    <th>Tên chiến dịch</th>
                    <th>Ảnh</th>
                    <th>Link</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Ngày cập nhật</th>
                    <th>Type</th>
                    <th><?php echo lang('Options'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $this->load->model('campaign'); ?>

                <?php
                if ($this->pagination->per_page > $this->pagination->total_rows) $i = 1;
                else $i = 1 + ($this->pagination->cur_page - 1) * $this->pagination->per_page;
                foreach ($campaigns as $campaign):
                    ?>
                    <tr>

                        <td><?php echo $i ?></td>
                        <td><?php echo $campaign->id ?></td>
                        <td><?php echo $campaign->name ?></td>
                        <td><?php echo $campaign->images ?></td>
                        <td><?php echo $campaign->link ?></td>
                        <td><?php echo $campaign->desc ?></td>
                        <td><?php echo $this->campaign->getCampaignStatus($campaign->status) ?></td>
                         <td><span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $campaign->updated_at))?>
                        <td><?php echo $campaign->type ?></td>

                    
                       
                       <td style="text-align:center">
                        <div class="btn-group" role="group">
                            <a href="<?php echo base_url('admin/campaigns/list_campaign_by_id/'.$campaign->id); ?>" class="btn btn-default btn-xs"><span class="icon-pencil" style="color:green"></span> Update</a>
                            <?php if($campaign->status == 0){?>
                                <a href="<?php echo base_url("admin/campaigns/off_campaign?id={$campaign->id}&status={$campaign->status}"); ?>" class="btn btn-default btn-xs "><span class="icon-plus" style="color:blue"></span> ON</a>
                            <?php }else{?>
                                <a href="<?php echo base_url("admin/campaigns/off_campaign?id={$campaign->id}&status={$campaign->status}") ?>" class="btn btn-default  btn-xs"><span class="icon-minus" style="color:red"></span> OFF</a>
                            <?php }?>
                          <a href="<?php echo base_url('admin/campaigns/delete_campaign/'.$campaign->id); ?>" onclick="return confirm('Are you sure you want to delete this member?')" class="btn btn-default btn-xs"><span class="icon-cancel-2" style="color:red"></span> Delete</a>

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


</body>
