
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
                    <th>Mã chiến dịch</th>
                    <th>Tên chiến dịch</th>
                    <th>Ảnh</th>
                    <th>Link</th>
                    <th>Mô tả</th>
                    <th>Quảng cáo</th>
                    <th>Trạng thái</th>
                    <th>Ngày cập nhật</th>
                    <th>Chiến dịch cho</th>
                    <th>Chức năng</th>
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
                        <td><?php echo $campaign->desc ?></td>s
                        <td><?php echo $this->campaign->show_sponsor_status($campaign->is_sponsor) ?></td>
                        <td><?php echo $this->campaign->getCampaignStatus($campaign->status) ?></td>
                        <td><span class="mdi mdi-calendar-clock" style="color: red;"></span></span> <?php echo date('d/m/Y',strtotime( $campaign->updated_at))?>
                        <td><?php echo $campaign->type ?></td>

                    
                       
                       <td style="text-align:center">
                        <div class="btn-group" role="group">
                            <a href="<?php echo base_url('admin/campaigns/list_campaign_by_id/'.$campaign->id); ?>" class="btn btn-default btn-xs"><span class="icon-pencil" style="color:green"></span>Chỉnh sửa</a>
                            <?php if($campaign->status == 0){?>
                                <a href="<?php echo base_url("admin/campaigns/off_campaign?id={$campaign->id}&status={$campaign->status}"); ?>" onclick="return confirm('Bạn có chắc chắn bật chiến dịch này?')" class="btn btn-default btn-xs "><span class="icon-plus" style="color:blue"></span> Bật </a>
                            <?php }else{?>
                                <a href="<?php echo base_url("admin/campaigns/off_campaign?id={$campaign->id}&status={$campaign->status}") ?>" onclick="return confirm('Bạn có chắc chắn tắt chiến dịch này?')" class="btn btn-default  btn-xs"><span class="icon-minus" style="color:red"></span> Tắt</a>
                            <?php }?>
                          <a href="<?php echo base_url('admin/campaigns/delete_campaign/'.$campaign->id); ?>" onclick="return confirm('Bạn có chắc chắn xóa chiến dịch này?')" class="btn btn-default btn-xs"><span class="icon-cancel-2" style="color:red"></span> Xóa</a>

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






