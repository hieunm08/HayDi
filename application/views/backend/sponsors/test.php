<!DOCTYPE html>
<html>
<head>
    <title>codeigniter ajax request - itsolutionstuff.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
    <body>
        <table id="sampleTbl" border="1" width="515">
            <thead>
                <tr>
                    <th align="center" width="20"> Task No.</th>
                    <th width="150"> Date</th>
                    <th width="170"> Description</th>
                    <th width="170"> Task</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="center"> 1</td>
                    <td> December 24, 2012</td>
                    <td> Christmas Eve</td>
                    <td> Make dinner</td>
                </tr>
                <tr>
                    <td align="center"> 2</td>
                    <td> January 11, 2013</td>
                    <td> Anniversary</td>
                    <td> Pickup flowers</td>
                </tr>
                <tr>
                    <td align="center"> 3</td>
                    <td> March 7, 2013</td>
                    <td> Birthday</td>
                    <td> Get present</td>
                </tr>
            </tbody>
        </table>
        
        <textarea rows="10" name="tblValuesArray" id="tbTableValuesArray" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 400px; width: 515px;"></textarea>
        <br/><textarea rows="10" name="tblValuesArray2" id="tbTableValuesArray2" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 400px; width: 515px;"></textarea>
        <br/><button id="testb">test</button>

        
        <script>
                $("#testb").click(function(){
                    var TableData;
                    TableData = $.toJSON(storeTblValues());
                    $('#tbTableValuesArray').val('JSON array to send to server: \n\n' + TableData.replace(/},/g, "},\n"));

                  if(TableData){
                    alert("có");
                  }else{
                    alert("không");
                  }
                    $.ajax({
                    url: '<?php base_url(); ?>admin/sponsors/list_sponsors_by_id/1',
                    type: 'POST',
                    data: "pTableData=" + TableData,
                    success: function(msg){
                    // return value stored in msg variable
                    alert('Something is wrong');
                    },
                    error : function(){
                    alert('sai sai');
                    }
                    });
                });
        
            
            function readTblValues()
            {
                var TableData = '';
        
                $('#tbTableValuesArray').val('');    // clear textbox
                $('#sampleTbl tr').each(function(row, tr){
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
        
                $('#sampleTbl tr').each(function(row, tr){
                    TableData[row]={
                        "taskNo" : $(tr).find('td:eq(0)').text()
                        , "date" :$(tr).find('td:eq(1)').text()
                        , "description" : $(tr).find('td:eq(2)').text()
                        , "task" : $(tr).find('td:eq(3)').text()
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
                    url: '<?php base_url(); ?>admin/sponsors/list_sponsors_by_id/1',
                    type: 'POST',
                    data: "pTableData=" + TableData,

                    success: function(msg){
                        // return value stored in msg variable 
                       alert('Something is wrong');
                    },
                    error : function(){
                        alert('sai sai');
                    }
                });
            }
            
   
        </script>

    </body>
</html>