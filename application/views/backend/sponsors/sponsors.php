
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
 
 <script>
     /*$(document).ready(function)(){
        search_data(1)
        function search_data(page)
        {
            $('#result').html("<div id='load'></div>")
            var actiong='fetch_data';
            var id =get_search('id');
            $ajax({
                    url:"<?php echo base_url();?> sponsor/fetch_data"+page,
                    method:"POST";
                    dataType:"JSON",
                    data:{ action:action, id:id                        
                    },
                    success:function(data){

                        $('.filter_data').html(data.sponsor_list);
                        $("#pagination_link").html(data.pagination);
                    }


            })

       }

     function get_search(class_name)
    {
        var search = [];
        $('.'+class_name+':checked').each(function(){
            search.push($(this).val());
        });
        return search;
    }
    $(document).on('click', '.pagination li a', function(event){
        event.preventDefault();
        var page = $(this).data('ci-pagination-page');
        search_data(page);
    });
    $('.common_selector').click(function(){
        search_data(1);
    });*/

<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>ajaxsearch/fetch",
   method:"POST",
   data:{query:query},
   success:function(data){
    $('#result').html(data);
   }
  })
 }

 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>

 </script> 

       <body>
            <div class="col-sm-10 col-md-11 main">
                <div class="row" style="margin-right:0px;">
                    <div class="col-sm-10 col-md-10" style="padding-left:0px;">
                        <h1 class="page-header">Sponsor</h1>
                    </div>
                    <div class="col-sm-2 col-md-2">
                       <a href="<?php echo base_url('admin/sponsors/add_sponsor'); ?>"><button type="button" class="btn btn-primary top_button"><span class="icon-plus-2"></span> Add Sponsor</button></a>
                    </div>
                </div>
                <div class="row" style="margin-right:0px;margin-bottom: 10px;width: 500px">
                    <div class="col-sm-4 col-md-4" style="padding-left:0px;width: 1000px">               
                                                <div class="form-group">
        
                            <div class="input-group">
                                <input type="text" class="form-control"  name="id" id="id"
                                placeholder="<?php echo lang('Supplier cd') ?> ">
                                <button style="margin-right:5px;margin-bottom: 10px; margin-top:10px;" type="submit"
                                class="btn btn-primary"><?php echo lang('Search supplier'); ?>Search
                                </button>
                            </div>
                        </div>
                        <br/>
                  
                    </div>
                </div>
         
                 <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th><?php echo lang('ID number'); ?></th>
                                    <th>Loại</th>
                                    <th>Thời gian bắt đầu</th>
                                    <th>Thời gian kết thúc</th>
                                    <th>Số tiền quảng cáo</th>
                                    <th>Trạng thái</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $this->load->model('sponsor'); ?>
                                <?php
                                if ($this->pagination->per_page >= $this->pagination->total_rows) $i = 1;
                                else $i = 1 + ($this->pagination->cur_page - 1) * $this->pagination->per_page;
                                foreach ($sponsors as $sponsor):
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $sponsor->sponsor_id ?></td>
                                    <td><?php echo $sponsor->type ?></td>
                                    <td><span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $sponsor->time_start))?>
                                    <td><span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $sponsor->time_end))?>
                                    <td><?php echo $sponsor->sponsor_money ?></td>
                                    <td><?php echo $this->sponsor->showSponsorStatus($sponsor->status) ?></td>
                                    <td style="text-align:center">
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo base_url('admin/sponsors/list_sponsors_by_id/'.$sponsor->sponsor_id); ?>" class="btn btn-default btn-xs"><span class="icon-pencil" style="color:green"></span> Update</a>
                                            <?php if ($sponsor->status==1) { ?>
                                            <a href="<?php echo base_url("admin/sponsors/block_sponsor?id={$sponsor->id}&status={$sponsor->status}"); ?>" onclick="return confirm('Bạn có chắc chắn muốn HỦY quảng cáo này?')" class="btn btn-default btn-xs"><span class="icon-minus" style="color:red"></span> Hủy</a>
                                            <?php }else{ ?>
                                            <a href="<?php echo base_url("admin/sponsors/block_sponsor?id={$sponsor->id}&status={$sponsor->status}"); ?>" onclick="return confirm('Bạn có chắc chắn muốn KÍCH HOẠT quảng cáo này?')" class="btn btn-default btn-xs"><span class="icon-plus" style="color:blue"></span> Kích hoạt</a>
                                            <?php } ?>
                                            <a href="<?php echo base_url('admin/sponsors/delete_sponsor/' .$sponsor->id); ?>" onclick="return confirm('Bạn có chắc chắn muốn XÓA quảng cáo này?')" class="btn btn-default btn-xs"><span class="icon-cancel-2" style="color:red"></span> Delete</a>
                                        </div>
                                    </td>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <ul class="pagination"><?php echo $links ?></ul>
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
</body>
    </div>
</body>
</html>
<script>
    $(document).ready(function)(){
        function filter_data($page){
          var action='fetch_data';
          }
        }
</script>
