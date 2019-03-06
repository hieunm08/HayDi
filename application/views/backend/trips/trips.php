<div class="col-sm-10 col-md-11 main">
	<div class="row">
            <div class="col-sm-10 col-md-10" style="padding-left:0px;">
                <h1 class="page-header">Trips</h1>
            </div>
            
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
                      <input style="margin:6px 6px 6px 0px; width: 10%;float: left" type="text" class="form-control" id="supplier_search" name="booking_search" placeholder="Từ khóa">
                      <input style="margin:6px 6px 6px 0px;width: 20%;float: left" type="text" class="form-control" id="supplier_search" name="booking_search" placeholder="Từ khóa">
                      <input style="margin:6px 6px 6px 0px;width: 10%;float: left" type="text" class="form-control" id="supplier_search" name="booking_search" placeholder="Từ khóa">
                <input style="margin:6px 6px 6px 0px;width: 10%;float: left" type="text" class="form-control" id="booking_search" placeholder="Từ khóa">

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
						<th>Mã người dùng</th>
						<th>Mã hướng dẫn viên</th>
						<th>Mã host</th>
						<th>Ngày bắt đầu</th>
						<th>Ngày kết thúc</th>
						<th>Địa điểm</th>
						<th>Số người</th>
						<th>Trạng thái</th>
						<th>Ngày khởi hành</th>
						<th>Chức năng</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; foreach($trips as $trip): ?>
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $trip->id ?></td>
						<td><?php echo $trip->user_id ?></td>
						<td><?php echo $trip->guider_id ?></td>
						<td><?php echo $trip->host_id ?></td>
						<td><span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $trip->start_day))?>
						<td><span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $trip->end_day))?>
						<td><?php echo $trip->address ?></td>
						<td><?php echo $trip->peoples ?></td>
						<td><?php echo $trip->status ?></td>
						<td><span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $trip->created_at))?>
						
						
					<td style="text-align:center">
						<div class="btn-group" role="group">
							
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