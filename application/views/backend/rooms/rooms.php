

            <div class="container-fluid">
                <div class="row" style="margin-right:0px;">
                    <div class="col-sm-10 col-md-10" style="padding-left:0px;">
                        <h1 class="page-header">Room</h1>
                    </div>
                    <div class="col-sm-2 col-md-2">
                       <a href="<?php echo base_url('admin/sponsors/add_sponsor'); ?>"><button type="button" class="btn btn-primary top_button"><span class="icon-plus-2"></span> Add Sponsor</button></a>
                    </div>
                </div>
                <div class="row" style="margin-right:0px;margin-bottom: 10px;width: 500px">
                    <div class="col-sm-4 col-md-4" style="padding-left:0px;width: 1000px">               
                                                <div class="form-group">
        
                            <div class="input-group">
                                <span class="input-group-addon">Search</span>
                                <input type="text" class="form-control"  name="supplier_search"
                                placeholder="<?php echo lang('Supplier cd') ?>">
                                <!-- <button style="margin-right:5px;margin-bottom: 10px; margin-top:10px;" type="submit"
                                class="btn btn-primary"><?php echo lang('Search supplier'); ?>Search
                                </button> -->
                            </div>
                        </div>
                        <br/>
                  
                    </div>
                </div>
          
  <div id="result">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã phòng</th>
                                    <th>Mã host</th>
                                    <th>Tên phòng</th>
                                    <th>Số giường ngủ</th>
                                    <th>Kiểu giường</th>
                                    <th>Giá</th>
                                    <th>Đơn vị</th>
                                    <th>Phục vụ ăn sáng</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($this->pagination->per_page >= $this->pagination->total_rows) $i = 1;
                                else $i = 1 + ($this->pagination->cur_page - 1) * $this->pagination->per_page;
                                foreach ($rooms as $rooms):
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $rooms->id ?></td>
                                    <td><?php echo $rooms->host_id ?></td>
                                    <td><?php echo $rooms->name ?></td>
                                    <td><?php echo $rooms->bed_number ?></td>
                                    <td><?php echo $rooms->bed_type ?></td>
                                    <td><?php echo $rooms->price ?></td>
                                    <td><?php echo $rooms->unit ?></td>
                                    <td><?php echo $this->host->showIsBreakfast($rooms->is_breakfast) ?></td>
                                    <td><span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $rooms->updated_at))?>
                                    <td style="text-align:center">
                                        <div class="btn-group" role="group">
                                        </div>
                                    </td>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <ul class="pagination"><?php echo $links ?></ul>

        </div>

</div>

</div>
</body>
</body>
    </div>
</body>
</html>
<script>
    $(document).ready(function)(){
        function load_data($query){
            $.ajax(){
                url:"<?php echo base_url();?> sponsor/search_fetch "
            }
        }
}
</script>
