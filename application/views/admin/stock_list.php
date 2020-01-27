
<div class="main-content">
   <div class="container-fluid">
     <div class="page-header">
        <h2 class="header-title">Stock List</h2>
     </div>
      <div id="messages"></div>
      <button class="btn btn-primary" style="float: right;margin-left: -150px;" data-toggle="modal" data-target="#addModal">Add Stock</button><br><br>
     <div class="card">

         <div class="card-body">
             <div class="table-overflow">
                 <table id="list" class="table table-hover table-xl">
                     <thead>
                         <tr>
                             <th>Sl No</th>
                             <th>Product name</th>
                             <th>Initial stock</th>
                             <th>Current stock</th>
                             <th>Stock out</th>
                            
                         </tr>
                     </thead>
                     <tbody>
                        <?php  $counter = 0;  foreach ($res as $row): $product_id =    $row->product_id;?>
                           <tr>
                               <td><?php echo ++$counter; ?></td>
                               <td><?php echo $row->product_name;?></td>
                               <td><?php echo $row->intitial_stock;?></td>
                               <td><?php  echo $row->intitial_stock-$sql['stock'];?> </td>
                               <td> <?php echo $sql['stock'];?> </td>
                         </tr>
                       <?php endforeach;?>
                     </tbody>
                 </table>
                 
             </div>
         </div>
     </div>

   </div>
</div>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <!-- <h4 class="modal-title">Add User</h4> -->
      </div>

       <form id="add_stock"  action="<?php echo base_url(); ?>index.php/admin/ManageInventory/Stocklist" method="post" class="eventInsForm" >

        <div class="modal-body">
          <h4 style="text-align: center;">Add Stock</h4>
           
          <div class="form-group">
              <label>Category*</label>
              <select class="form-control form-control-sm" id="category" name="category" required="required">
                      
              </select>
          </div>
          <div class="form-group" id="subCategoryDiv"></div>
          <div class="form-group">
               <label class="control-label text-dark">Product*</label>
               <input type="text" class="form-control form-control-sm" name="product_name" required="required" id="product_name">
                <input type="hidden" name="productId" id="productId">
          </div>
          <div class="form-group">
               <label class="control-label text-dark">Intitial Stock*</label>
               <input type="number" class="form-control form-control-sm" name="intitial_stock" required="required" id="intitialstock">
          </div>
            
               


        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit"   class="btn btn-gradient-success">Save</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  
  <script>
           $(function(){
           var table = $("#list").dataTable();
          $('#subCategoryDiv').hide();
             fetch_category();
            function fetch_category()  
            {  
               // alert('s');
                  $.ajax({
                  
                     url:"<?php echo base_url(); ?>index.php/admin/manageInventory/search_Category",
                     method:"POST",
                     success:function(data){
                        $('#category').html(data);
                        
                     }
                  });
            } 
         $("#category").on("change", function() {
                  var id = $(this).find(':selected').attr("data-id");
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
          });
   </script>
<script>
  // submit the create from 
  $("#add_stock").unbind('submit').on('submit', function() {
    var form = $(this);
    $(".text-danger").remove();
    $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: form.serialize(), 
          dataType: 'json',
         success:function(response) {
               if(response.success === true) {
                       $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                        '</div>');
                        $("#addModal").modal('hide');
                       // $("#list").ajax.reload();
                        setInterval( function () {
                                   location.reload();
                                }, 1000 );
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
          $('#intitialstock').val(ui.item.stock);
           $('#productId').val(ui.item.id);
           // $('#pPrice').val(ui.item.value);
            // save selected id to input
           // console.log(ui.item.stock);
         
          return false;
        }
      });
     $( "#product_name" ).autocomplete( "option", "appendTo", ".eventInsForm" );
     
     



    });
    </script>
   