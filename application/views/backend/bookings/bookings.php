
        <div class="col-sm-10 col-md-11 main">
          <div class="row" >
            <div class="col-sm-10 col-md-10" style="padding-left:0px;">
                <h1 class="page-header"><?php echo lang('Bookings');?></h1>
            </div>
              <button style="margin-right:10px; background:red" id="btn1"
                      class="btn btn-primary">Search Advance
              </button>
          <!--  <div class="col-sm-2 col-md-2">
               <a href="<?php /*echo base_url('admin/bookings/add_ticket'); */?>"><button type="button" class="btn btn-primary top_button"><span class="icon-plus-2"></span> <?php /*echo lang('Book a ticket');*/?></button></a>
            </div>-->
             <div id="form-search1" >
              <form  class="form-inline" method="POST" action="../admin/bookings" style="float:left;" >
                  <div class="form-group" style="width: 500px:">
                      <input type="text" class="form-control" id="booking_search" name="booking_search"
                             placeholder="Key Word">
                      <button style="margin-right:10px;" type="submit"
                              class="btn btn-primary"><?php echo lang('Search supplier'); ?>Search
                      </button>
                  </div>
              </form>
              </div>
          </div>
        </br>
            <div class="row" >
                <div id="form-search2" style="display: block">
                <h4> Search Detail</h4>
            <div class="form-2" style="float: left; padding-right: 40px;width: 100%; display: ">
                      <input style="margin:6px 6px 6px 0px; width: 10%;float: left" type="text" class="form-control"  id="supplier_search" name="supplier_search"
                             placeholder="Customer">
                      <input style="margin:6px 6px 6px 0px;width: 10%;float: left" type="text" class="form-control" id="supplier_search" name="supplier_search"
                             placeholder="Route">
                      <input style="margin:6px 6px 6px 0px;width: 10%;float: left" type="text" class="form-control" id="supplier_search" name="supplier_search"
                             placeholder="Phone">
                <input style="margin:6px 6px 6px 0px;width: 10%;float: left" type="text" class="form-control" id="supplier_search" name="supplier_search"
                             placeholder="Service">

                <select class="form-control" name="BookStatus" style="margin:6px 6px 6px 0px;width: 13%;float: left;placeholder="BookStatus">
                    <option  value="0" >Paid</option>
                    <option  value="1">Holding</option>
                    <option  value="2">Expired</option>
                </select>

                          <button style="margin-right:5px;margin-bottom: 5px; margin-top:5px;float: left" type="submit"
                                  class="btn btn-primary"><?php echo lang('Search supplier'); ?>Search
                          </button>
                      </div>
                </div>
            </div>
        </br>


                  <div class="row">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><?php echo $this->session->userdata['user_id']?></th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Trip No</th>
                    <th>Route</th>
                    <th>Service</th>
                    <th>FromDate</th>
                    <th>To Date</th>
                    <th>Price</th>
					<th>Amount</th>
                      <th>PIC</th>
                      <th>Detail Booking</th>
                      <th>Book Status</th>
                      <th>Pay Status</th>
                      <th ><?php echo lang('Options');?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $this->load->model('booking'); ?>

                  <?php
                    if ($this->pagination->per_page >= $this->pagination->total_rows) $i =1 ;
                    else $i = 1 + ($this->pagination->cur_page-1)*$this->pagination->per_page;
                    foreach($bookings as $booking):
                  ?>
                      <tr>
                      <td><?php echo $i?></td>
                      <td><?php echo $booking->customer ?></td>
                      <td><?php echo $booking->phone ?></td>
                      <td><?php echo $booking->trip_no ?></td>
                          <td><?php echo $booking->route ?></td>
                          <td><?php echo $this-> booking-> service_status ($booking->service) ?></td>
                      <td>
                        <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->fromdate))?>
                        <div class="pull-right"><span class="icon-clock" style="color:red;"></span> <?php echo date('H:i', strtotime( $booking->fromdate)) ?></div>
                      </td>
                      <td>
<!--                        --><?php /*if($booking->returning == '2') { //1 = one way; 2 = returning ticket */?>
                            <span class="icon-calendar" style="color:red;"></span> <?php echo date('d/m/Y',strtotime( $booking->todate))?>
                          <div class="pull-right"><span class="icon-clock" style="color:red;"></span> <?php echo date('H:i', strtotime( $booking->todate)) ?></div>
<!--                        --><?php /*} */?>
                      </td>
                          <td><?php echo $booking->price ?></td>
                          <td><?php echo $booking->price ?></td>

                          <!--                          <td><?php /*echo ($this->booking->get_amount($booking->from)) */?></td>
                          -->
                          <td><?php echo $booking->PIC ?></td>
                          <td><?php echo $booking->detail_booking ?></td>
                          <td><?php echo $this-> booking-> status ($booking->book_status) ?></td>
                          <td><?php echo $this-> booking-> payment_status ($booking->payment_status) ?></td>
                      <td style="text-align:center">
                        <div class="btn-group" role="group">
                          <a href="<?php echo base_url('admin/bookings/list_booking_byID/'. $booking->book_id) ?>" target="_blank" class="btn btn-default btn-xs"><span class="icon-file-pdf" style="color:red"></span> Update</a>
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
