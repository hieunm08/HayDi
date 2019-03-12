<div class="col-sm-10 col-md-11 main">
	<div class="row">
            <div class="col-sm-10 col-md-10" style="padding-left:0px;">
                <h1 class="page-header">Hosts</h1>
            </div>
            <div class="col-sm-2 col-md-2">
                <a href="<?php echo base_url('admin/hosts/add_host'); ?>"><button type="button" class="btn btn-primary top_button"><span class="icon-plus-2"></span> Add host</button></a>
            </div>
             <div id="form-search1">
             	<h3 style="font-weight: 
             	300"> Tìm kiếm </h3>
              <form class="form-inline" method="POST" action="../admin/hosts" style="float:left;">
                  <div class="form-group">
                            <input type="text" style="width:6%; margin-right:5px" class="form-control"  name="id"
                            placeholder="Mã Host">
                            <input type="text" style="width:6%; margin-right:5px" class="form-control"  name="user_id"
                            placeholder="Mã người dùng">
                            <input type="text" style="width:8%; margin-right:5px"class="form-control"  name="name"
                            placeholder="Tên Host">
                            <input type="text" style="width:6%; margin-right:5px" class="form-control"  name="email"
                            placeholder="Email">
                            <input type="text" style="width:8%; margin-right:5px" class="form-control"  name="phone"
                            placeholder="Số điện thoại">
                            <input type="text" style="width:6%; margin-right:5px" class="form-control"  name="address"
                            placeholder="Địa chỉ">
                            <select class="form-control" name="status" style="margin:6px 6px 6px 0px;width: 12%;float: left; placeholder="Trạng thái">
                                <option value="">Trạng Thái hoạt động</option>
                                <option  value="0">Active</option>
                                <option  value="1">Inactive </option>
                            </select>
                            <select class="form-control" name="type" style="margin:6px 6px 6px 0px;width: 8%;float: left;placeholder="BookStatus">
                                <option value="">Loại phòng</option>
                                <option  value="host">Host</option>
                                <option  value="hotel">Hotel </option>
                            </select>
                             <select class="form-control" name="is_full" style="margin:6px 6px 6px 0px;width: 10%;float: left;placeholder="BookStatus">
                                <option value="">Trạng thái phòng</option>
                                <option  value="0">Còn phòng </option>
                                <option  value="1">Hết phòng</option>
                                
                            </select>
                            <button style="margin-right:5px;margin-bottom: 10px; margin-top:10px;" type="submit"
                            class="btn btn-primary"><?php echo lang('Search supplier'); ?>Search
                            </button>
                  </div>
              </form>
              </div>
          </div>
          <br>
        
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
						<th>Mã host</th>
						<th>Mã người dùng</th>
						<th>Tên</th>
						<th>Số điện thoại</th>
						<th>Email</th>
						<th>Giới thiệu</th>
						<th>Địa chỉ</th>
						<th>Mã quốc gia</th>
						<th>Giá</th>
						<th>Giá trẻ em</th>
						<th>Phụ phí</th>
						<th>Số phòng</th>
						<th>Loại</th>
						<th>Trạng thái hoạt động</th>
						<th>Trạng thái phòng</th>
						<th>Ngày tạo </th>
						<th>Ngày cập nhật </th>
						<th>Chức năng</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; foreach($hosts as $host): ?>
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $host->id ?></td>
						<td><?php echo $host->user_id ?></td>
						<td><?php echo $host->name ?></td>
						<td><?php echo $host->phone ?></td>
						<td><?php echo $host->email ?></td>
						<td><?php echo $host->intro ?></td>
						<td><?php echo $host->address ?></td>
						<td><?php echo $host->country_code ?></td>
						<td><?php echo $host->price ?></td>
						<td><?php echo $host->price_baby ?></td>
						<td><?php echo $host->surcharge ?></td>
						<td><?php echo $host->room_number ?></td>
						<td><?php echo $this->host->showType($host->type) ?></td>
						<td><?php echo $this->host->getHostStatus($host->status) ?></td>
						<td><?php echo $this->host->showIsFull($host->is_full) ?></td>
						<td>
                        <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $host->created_at))?>                    
                      	</td>
                      	<td>
                        <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $host->updated_at))?>
                      	</td>
						
						<td style="text-align:center">
                            <div class="btn-group" role="group">
                                <a href="<?php echo base_url('admin/hosts/list_host_by_id/'.$host->id); ?>" class="btn btn-default btn-xs"><span class="icon-pencil" style="color:green"></span> Chỉnh sửa</a>
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