<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Dialog - Modal form</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="jquery.json.js"></script>
  <script>
  $( function() {
    var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      name = $( "#name" ),
      access = $( "#access" ),
      cost = $( "#cost" ),
      unit = $( "#unit" ),
      allFields = $( [] ).add( name ).add( cost ).add( unit ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
 
    function addUser() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
 



 
     
 
      if ( valid ) {
        $( "#users tbody" ).append( "<tr>" +
          "<td>" + name.val() + "</td>" +
          "<td>" + access.val() + "</td>" +
          "<td>" + cost.val() + "</td>" +
          "<td>" + unit.val() + "</td>" +
        "</tr>" );
        dialog.dialog( "close" );
      }
      return valid;
    }
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 350,
      modal: true,
      buttons: {
        "Create an account": addUser,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form = dialog.find( "#form_service" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });
 
    $( "#create-user" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });



      function readTblValues()
      {
        var TableData = '';
    
        $('#tbTableValuesArray').val('');    // clear textbox
        $('#users tr').each(function(row, tr){
          TableData = TableData 
            + $(tr).find('td:eq(0)').text() + ' '  // Task No.
            + $(tr).find('td:eq(1)').text() + ' '  // Date
            + $(tr).find('td:eq(2)').text() + ' '  // Description
            + $(tr).find('td:eq(3)').text() + ' '  // Task
            + '\n';
        });
        $('#tbTableValuesArray').val(TableData);
      }
      
      
      function storeAndShowTableValues()
      {
        var TableData;
        TableData = storeTblValues();
        $('#tbTableValuesArray').val('TableData = \n' + print_r(TableData));
      }
      
      
      function storeTblValues()
      {
        var TableData = new Array();
    
        $('#users tr').each(function(row, tr){
          TableData[row]={
            "Dịch vụ" : $(tr).find('td:eq(0)').text()
            , "Access" :$(tr).find('td:eq(1)').text()
            , "Cost" : $(tr).find('td:eq(2)').text()
            , "Đơn vị" : $(tr).find('td:eq(3)').text()
          }
        }); 
        TableData.shift();  // first row will be empty - so remove
        return TableData;
      }
      
      
      
      function print_r(arr,level) {
        var dumped_text = "";
        if(!level) level = 0;

        //The padding given at the beginning of the line.
        var level_padding = "";
        for(var j=0;j<level+1;j++) level_padding += "    ";

        if(typeof(arr) == 'object') { //Array/Hashes/Objects 
          for(var item in arr) {
            var value = arr[item];

            if(typeof(value) == 'object') { //If it is an array,
              dumped_text += level_padding + "'" + item + "' \n";
              dumped_text += print_r(value,level+1);
            } else {
              dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
            }
          }
        } else { //Stings/Chars/Numbers etc.
          dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
        }
        return dumped_text;
      }
      
      
      function convertArrayToJSON()
      {
        var TableData;
        TableData = $.toJSON(storeTblValues());
        $('#tbTableValuesArray').val('JSON array: \n\n' + TableData.replace(/},/g, "},\n"));
      }
      
      
      function sendTblDataToServer()
      {
        var TableData;
        TableData = $.toJSON(storeTblValues());
        $('#tbTableValuesArray').val('JSON array to send to server: \n\n' + TableData.replace(/},/g, "},\n"));
          
        $.ajax({
          type: "POST",
          url: "<?php base_url(); ?>admin/hosts/add_host",
          data: "pTableData=" + TableData,

          success: function(msg){
            // return value stored in msg variable 
            $('#tbTableValuesArray2').val('Server Response:\n\n' + msg);
          },
          error : function(){
            $('#tbTableValuesArray2').val('got an error');
          }
        });
      }
        
      


  });
  </script>
</head>
<body>
<div class="col-sm-10 col-md-11 main">
  <div class="row" >
    <div class="col-sm-12 col-md-12" style="padding-left:0px;">
      <h1 class="page-header"><a href="<?php echo base_url().'admin/hosts' ?>"><i class="icon-arrow-left-3"></i></a> Tạo host</h1>
    </div>
  </div>
  <div class="row">
    <?php
    if ($this->session->flashdata('message') != '') echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('message') . '</div>';
    ?>
  </div>
  <div class="row" >
    <div class="col-sm-4 col-md-4">
      <?php echo form_open('admin/hosts/add_host') ?>
      <div class="form-group">
        <label for="company_name">Họ tên</label>
        <input type="text" class="form-control" id="company_name" name="name" value="">
      </div>
      <div class="form-group">
        <label for="company_name">SĐT</label>
        <input type="text" class="form-control" id="company_name" name="phone" value="">
      </div>
      <div class="form-group">
        <label for="company_name">Email</label>
        <input type="text" class="form-control" id="company_name" name="email" value="">
      </div>
      <div class="form-group">
        <label for="company_name">Ảnh</label>
        <input type="file" class="form-control" placeholder="uploaded image" name="images[]" multiple >
      </div>
      <div class="form-group">
        <label for="company_name">Video</label>
        <input type="text" class="form-control" id="company_name" name="video" value="">
      </div>
      <div class="form-group">
        <label for="company_name">Giới thiệu</label>
        <input type="text" class="form-control" id="company_name" name="intro" value="">
      </div>
      
      
      
    </div>
    <div class="col-sm-4 col-md-4">
      <div class="form-group">
        <label for="company_name">Địa chỉ</label>
        <input type="text" class="form-control" id="company_name" name="address" value="">
      </div>
      <div class="form-group">
        <label for="company_street">Mã Quốc Gia</label>
        <select class="form-control"  id="cmbMake" name="country_code"  >
          <?php foreach ($city_code as $city_code ){ ?>
          <option value=<?php echo $city_code->code  ?> ><?php echo $city_code->code ?></option>
          <?php } ?>
        </select>
        
      </div>
      
      <div class="form-group">
        <label for="company_street">Giá</label>
        <input type="text" class="form-control" id="company_street" name="price" value="" >
        <?php echo form_error('company_street'); ?>
      </div>
      <div class="form-group">
        <label for="company_street">Giá trẻ em</label>
        <input type="text" class="form-control" id="country_input" name="price_baby" value="" >
      </div>
      <div class="form-group">
        <label for="company_street">Đơn vị giá</label>
        <select class="form-control"  id="cmbMake" name="unit"  >
          <option value="USD" >USD</option>
          <option value="VND">VND</option>
        </select>
      </div>
      


    </div>
    <div class="col-sm-4 col-md-4">
      <div class="form-group">
        <label for="company_street">Phụ phí</label>
        <input type="text" class="form-control" id="company_street" name="surcharge" value=" ">
        <?php echo form_error('company_street'); ?>
      </div>
      <div class="form-group">
        <label for="company_street">Tổng phòng</label>
        <input type="text" class="form-control" id="company_street" name="room_number" value=" ">
        <?php echo form_error('company_street'); ?>
      </div>
      <div class="form-group">
        <label for="company_street">Tổng số khách cùng thời điểm</label>
        <input type="text" class="form-control" id="company_street" name="customers_same_time" value=" ">
        <?php echo form_error('company_street'); ?>
      </div>
      <div class="form-group">
        <label for="company_street">Ở cùng chủ</label>
        <select class="form-control"  id="cmbMake" name="with_boss"  >
          <option value="1" >Có</option>
          <option value="0">Không</option>
        </select>
      </div>
      <div class="form-group">
        <label for="company_street">Loại</label>
        <select class="form-control" id="type" name="type"  >
          <option  value="host" >Host</option>
          <option  value="hotel">Hotel</option>
        </select>
      </div>
    </div>




    <div class="form-group">
      <button style="width:100px; margin-top:20px" name="create" type="submit" class="btn btn-primary" ><span
      class="icon-checkmark"></span>Tạo</button>
    </div>
<div class="form-group hidden" >
    <div id="users-contain" class="ui-widget">
      <h1>Dịch vụ:</h1>
      <table id="users" class="ui-widget ui-widget-content">
        <thead>
          <tr class="ui-widget-header ">
            <th>Dịch vụ</th>
            <th>Access</th>
            <th>Cost</th>
            <th>Đơn vị</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <inpt type="button" id="create-user">Thêm</input>
    </div>
  </div>
    

  </form>


<div>
  <div id="dialog-form" title="Create new user">
  <p class="validateTips">All form fields are required.</p>
  <form id="form_service">
    <fieldset>
       <div class="form-group">
        <label for="company_street">Dịch vụ</label>
        <select class="form-control" id="name" name="name"  >
          <?php foreach ($host_service as $host_service): ?>
              <option  value="<?php echo $host_service->id ?>" ><?php echo $host_service->name  ?></option>
          <?php endforeach ?>
          
        </select>
      </div>
       <div class="form-group">
        <label for="company_street">Access</label>
        <select class="form-control" id="access" name="access"  >
              <option  value="yes" >Yes</option>
              <option  value="no" >No</option>
              <option  value="option" >Option</option>
        </select>
      </div>
      
      <label >Cost </label>
      <input type="text" name="cost" id="cost"  class="text ui-widget-content ui-corner-all">
      <div class="form-group">
        <label for="company_street">Đơn vị</label>
        <select class="form-control" id="unit" name="unit"  >
              <option  value="USD" >USD</option>
              <option  value="VND" >VNĐ</option>
        </select>
      </div>
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
 


</div>
</div>
</div>

</body>
</html>
