<style type="text/css">
  .ui-autocomplete-input {
  border: none; 
  font-size: 14px;
  width: 300px;
  height: 24px;
  margin-bottom: 5px;
  padding-top: 2px;
  border: 1px solid #DDD !important;
  padding-top: 0px !important;
  z-index: 1511;
  position: relative;
}
.ui-menu .ui-menu-item a {
  font-size: 12px;
}
.ui-autocomplete {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1510 !important;
  float: left;
  display: none;
  min-width: 160px;
  width: 160px;
  padding: 4px 0;
  margin: 2px 0 0 0;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
}
.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}
.ui-state-hover, .ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
}
</style>
<div class="main-content">
   <div class="container-fluid">
     <div class="page-header">
        <h2 class="header-title">Stock Out List</h2>
     </div>
      <div id="messages"></div>
     <!--  <button class="btn btn-primary" style="float: right;margin-left: -150px;" data-toggle="modal" data-target="#addModal">Add Stock</button><br><br> -->
     <div class="card">

         <div class="card-body">
             <div class="table-overflow">
                 <table id="list" class="table table-hover table-xl">
                     <thead>
                         <tr>
                             <th>Sl No</th>
                             <th>Student Name</th> 
                             <th>Purpose</th>
                             <th>Comments</th>
                              <th>Status</th>
                             <th>Return</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                      <?php   
                           $counter = 0;
                           $data = $this->db->query("SELECT * FROM `outstock`"); 
                                  foreach($data->result() as $row){ 
                                   $id=$row->outstock_id; 
                                   $stdID = $row->user_id;
                           $data1 =  $this->db->query("SELECT * FROM `user` WHERE `user_id`='".$stdID."'")->row_array();
                           $data2 =  $this->db->query("SELECT * FROM `purpose` WHERE `purpose_id`='".$row->purpose_id."'")->row_array();       
                                 ?>
                        <tr>
                           <td><?php echo ++$counter; ?></td>
                           <td><?php echo $data1['first_name'].''.$data1['last_name'];?></td>
                           <td><?php echo $data2['purpose']; ?></td>
                           <td><?php echo $row->description; ?></td>
                           <td><?php echo $row->status; ?></td>
                           <td><?php echo $row->return_date; ?></td>

                         
                           <td class="text-center font-size-18">
                  <a href="<?php echo base_url(); ?>index.php/admin/ManageInventory/editStockOut?id=<?php echo $id;?>" class="text-gray m-r-15"><i class="ti-pencil"></i></a>
                                
                              <!--   <a name="delete"  id="<?php echo $id; ?>"  class="text-gray m-r-15 delete" >  <i class="ti-pencil"></i></a> -->
                           </td>
                       </tr>
                     <?php }?>
                       
                     </tbody>
                 </table>
                 
             </div>
         </div>
     </div>

   </div>
</div>

<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <script>
  $(function(){
     $("#list").dataTable();

    // $('#tableMain').on('click', 'tr.breakrow',function(){
    //             $(this).nextUntil('tr.breakrow').slideToggle(200);
    //         });

    $(document).on('click', '.delete', function(){  
           var user_id = $(this).attr("id");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>index.php/admin/ManageInventory/remove_stock",  
                     method:"POST",  
                     data:{user_id:user_id},
                      dataType: 'json',  
                     success:function(response)  
                     {  
                        

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

             setTimeout(function() {
                 window.location.reload(1);
                  $("#messages").hide()
              }, 3000);

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
                     }  
                });  
           }  
           else  
           {  
                return false;       
           }  
      });
  });
  </script>

         
         <script>
          $('#subCategoryDiv').hide();
  $("#category").on("change", function() {
    var id = $(this).find(':selected').attr("data-id");
    // alert(id);
    $("#subcategory").find('option:not(:first)').remove();
    if(id != '') {
          $.ajax({  
                url:"<?php echo base_url(); ?>index.php/admin/manageInventory/search_subCategory",  
                method:"POST",  
                data:{id:id},  
               // dataType:"json",  
                success:function(data)  
                
                { 
                   $('#subCategoryDiv').html(data);
                 
                 }
              });
      $('#subCategoryDiv').show();
    } else {
      $('#subCategoryDiv').hide();
      
    }
  });
   
</script>
<script>
  // submit the create from 
  $("#add_stock").unbind('submit').on('submit', function() {
    var form = $(this);

    // remove the text-danger
    $(".text-danger").remove();

    $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
         success:function(response) {
               if(response.success === true) {
                       $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                        '</div>');
                      $("#add_stock")[0].reset();
                      $("#add_stock .form-group").removeClass('has-error').removeClass('has-success');
                          setTimeout(function() {
                                               $("#messages").hide()
                                                }, 3000);
                } else {

               if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
              id.after(value);

            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      }
    }); 

    return false;
  });

  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type='text/javascript'>
    $(document).ready(function(){

     // Initialize 
     $( "#product_name" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?=base_url()?>index.php/admin/ManageInventory/autocomplete_product",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('#product_name').val(ui.item.label); // display the selected text
          $('#pPrice').val(ui.item.value);
           $('#productId').val(ui.item.id); // save selected id to input
         
          return false;
        }
      });
     $( "#product_name" ).autocomplete( "option", "appendTo", ".eventInsForm" );
     

    });
    </script>
