<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/30/19
 * Time: 4:16 PM
 */
?>
<!-- Out stock START -->
   <div class="main-content">
       <div class="container-fluid">
           <div class="page-header">
               <h2 class="header-title">Add Stock</h2>
           </div>
            <div id="messages"></div>
          <form id="add_stock"  action="<?php echo base_url(); ?>index.php/admin/ManageInventory/createStock" method="post" >
           <div class="card">
               <div class="card-body">
                   <div class="row">
                       <div class="col-sm-8 offset-sm-2">
                           <div class="form-row">
                              
                               <div class="form-group col-md-6">
                                   <label class="control-label text-dark">Category</label>
                                     <select class="form-control form-control-sm" id="category" name="category" required="required">
                                            <option value="">Select Category</option>
                                            <?php  $data = $this->db->query("SELECT * FROM `category`");
                                             foreach($data->result() as $row)
                                               {              ?>
                                                <option class="form-control form-control-sm" id="<?php echo $row->category_id;?>" data-id="<?php echo $row->category_id;?>" value="<?php echo $row->category_name; ?>"><?php echo $row->category_name; ?></option>
                                            <?php  } ?>
                                       </select>
                               </div>
                                <div class="form-group col-md-6" id="subCategoryDiv">
                                  
                               </div>

                       </div>

                           <div class="form-row">
                                <div class="form-group col-md-6">
                                   <label class="control-label text-dark">Product</label>
                                   <input type="text" class="form-control form-control-sm" name="product_name" required="required" id="product_name">
                                  <!--  <input type="text" name="pPrice" id="pPrice"> -->
                               </div>
                               <div class="form-group col-md-6">
                                   <label class="control-label text-dark">Intitial Stock</label>
                                   <input type="number" class="form-control form-control-sm" name="intitial_stock" required="required">
                               </div>

                               </div>

                           </div>



                       </div>

                       <div class="col-sm-12">
                           <div class="text-sm-center m-t-25">
                               <button type="submit"  class="btn btn-gradient-success">Save</button>
                           </div>
                       </div>

                   </div>

               </div>
               </form>
       </div>
   </div>
  </div>
         <!--Add stock END -->

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
          $('#pPrice').val(ui.item.value); // save selected id to input
          console.log(ui.item.label);
          return false;
        }
      });
     

    });
    </script>
