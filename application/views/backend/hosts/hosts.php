<div class="col-sm-10 col-md-11 main">
	<div class="row">
            <div class="col-sm-10 col-md-10" style="padding-left:0px;">
                <h1 class="page-header">Hosts</h1>
            </div>
              <button style="margin-right:10px; background:red" id="btn1" class="btn btn-primary">Search Advance
              </button>
          <!--  <div class="col-sm-2 col-md-2">
               <a href=""><button type="button" class="btn btn-primary top_button"><span class="icon-plus-2"></span> </button></a>
            </div>-->
             <div id="form-search1">
              <form class="form-inline" method="POST" action="../admin/bookings" style="float:left;">
                  <div class="form-group" style="width: 500px:">
                      <input type="text" class="form-control" id="booking_search" name="booking_search" placeholder="Từ khóa">
                      <button style="margin-right:10px;" type="submit" class="btn btn-primary">Tìm kiếm 
                      </button>
                  </div>
              </form>
              </div>
          </div>
        
	<div class="row">
		<?php
		if ($this->session->flashdata('message') != '') echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('message') . '</div>';
		?>
	</div>
	<br>
	<div class="row">
                <div id="form-search2" style="display: block">
                <h4> Search Detail</h4>
            <div class="form-2" style="float: left; padding-right: 40px;width: 100%; display: ">
                      <input style="margin:6px 6px 6px 0px; width: 10%;float: left" type="text" class="form-control" id="supplier_search" name="supplier_search" placeholder="Tên">
                      <input style="margin:6px 6px 6px 0px;width: 20%;float: left" type="text" class="form-control" id="supplier_search" name="supplier_search" placeholder="ID Hướng dẫn viên">
                      <input style="margin:6px 6px 6px 0px;width: 10%;float: left" type="text" class="form-control" id="supplier_search" name="supplier_search" placeholder="Ngày tạo">
                <input style="margin:6px 6px 6px 0px;width: 10%;float: left" type="text" class="form-control" id="supplier_search" name="supplier_search" placeholder="Số ngày ">

                <select class="form-control" name="BookStatus" style="margin:6px 6px 6px 0px;width: 13%;float: left;placeholder=" bookstatus"="">
                    <option value="0">Paid</option>
                    <option value="1">Holding</option>
                    <option value="2">Expired</option>
                </select>

                          <button style="margin-right:5px;margin-bottom: 5px; margin-top:5px;float: left" type="submit" class="btn btn-primary">Tìm kiếm
                          </button>
                      </div>
                </div>
            </div>
            <br>
	<div class="row">
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>STT</th>
						<th>ID</th>
						<th>Tên</th>
						<th>SĐT</th>
						<th>Email</th>
						<th>Địa chỉ</th>
						<th>Mã quốc gia</th>
						<th>Giá</th>
						<th>Giá trẻ em</th>
						<th>Đơn vị</th>
						<th>Tổng phòng</th>
						<th>Loại</th>
						<th>Trạng thái</th>
						<th>Ngày đăng kí</th>
						<th>Chức năng</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; foreach($hosts as $host): ?>
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $host->id ?></td>
						<td><?php echo $host->name ?></td>
						<td><?php echo $host->phone ?></td>
						
						<td><?php echo $host->email ?></td>
						<td><?php echo $host->address ?></td>
						<td><?php echo $host->country_code ?></td>
						<td><?php echo $host->price ?></td>
						<td><?php echo $host->price_baby ?></td>
						<td><?php echo $host->unit ?></td>
						<td><?php echo $host->room_number ?></td>
						<td><span class="label label-info"><?php echo $host->type ?></span></td>
						<td><?php echo $this->host->getHostStatus($host->status) ?></td>
						<td><span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $host->created_at))?>
					</td>
					<td style="text-align:center">
						<div class="btn-group" role="group">
							<a href="<?php echo base_url('admin/hosts/list_hosts_by_id/' . $host->id ); ?>"class="btn btn-info btn-xs">
								<span class="icon-search"><?php echo lang('View') ?></span></a>
								<?php if ($host->status="active") {
								?>
								<a href="<?php echo base_url("admin/hosts/block_host?id={$host->id}&status={$host->status}"); ?>"
									onclick="return confirm('Are you sure you want to Block this Host?')"
								class="btn btn-warning   btn-xs"></span>
							Block</a>
							<?php }else{ ?>
							<a href="<?php echo base_url("admin/hosts/block_host?id={$host->id}&status={$host->status}"); ?>"
								onclick="return confirm('Are you sure you want to Active this Host?')"
								class="btn btn-success btn-xs">
							Active</a>
							<?php } ?>
							<a href="<?php echo base_url('admin/hosts/delete_host/' .$host->id) ?>"
								onclick="return confirm('Are you sure you want to delete this host?')"
							class="btn btn-danger   btn-xs"></span>
						Delete</a>
					</div>
				</td>
			</tr>
			<?php $i++; endforeach; ?>
		</tbody>
	</table>
	<ul class="pagination"><?php echo $links ?></ul>
</div>
</div>
</div>