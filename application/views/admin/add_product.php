
   <!-- Add product START -->
   <div class="main-content">
       <div class="container-fluid">
           <div class="page-header">
               <h2 class="header-title">Add Product</h2>
           </div>
           <div id="messages"></div>
          <form id="add_product"  action="<?php echo base_url(); ?>index.php/admin/ManageInventory/createProduct" method="post" >
           <div class="card"> 
               <div class="card-body">
                   <div class="row">
                       <div class="col-sm-12">
                           <div class="form-row">
                            <?php  $this->load->helper('string');?>

                               <div class="form-group col-md-3">
                                   <label class="control-label text-dark">Product code/SKU</label>
                                   <input type="text" class="form-control form-control-sm" name="product_code" required="required" value="<?php echo random_string('alnum',6);?>" readonly>
                               </div>
                               <div class="form-group col-md-3">
                                   <label class="control-label text-dark">Product Name*</label>
                                   <input type="text" class="form-control form-control-sm" name="product_name" required="required">
                               </div>
                               <div class="form-group col-md-3">
                                   <label class="control-label text-dark">Category*</label>
                                   <div class="input-group">
                                       <select class="form-control form-control-sm" id="category" name="category" required="required">
                                          
                                       </select>
                                   </div>
                               </div>

                               <div class="form-group col-md-3" id="subCategoryDiv"> </div>
                           </div>


                           <div class="form-row">
                               <div class="form-group col-md-4">
                                   <label class="control-label text-dark">Size</label>
                                   <input type="text" class="form-control form-control-sm" name="size">
                               </div>
                               <div class="form-group col-md-4">
                                   <label class="control-label text-dark">Capacity</label>
                                   <input type="text" class="form-control form-control-sm" name="capacity">
                               </div>
                               <div class="form-group col-md-4">
                                   <label class="control-label text-dark">Unit</label>
                                   <input type="text" class="form-control form-control-sm" name="unit">
                               </div>
                           </div>

                           <div class="form-row">
                               <div class="form-group col-md-12">
                                   <label class="control-label text-dark">Description</label>
                                    <div class="form-row">
                                       <textarea rows="5" cols="500" name="description">
                                        </textarea>
                                     </div>
                               </div>
                           </div>

                       </div>

                       <div class="col-sm-12">
                           <div class="text-sm-center m-t-25">
                               <button type="submit" class="btn btn-gradient-success">Save</button>
                           </div>
                       </div>
                   </div>

               </div>
           </div>
           </form>
       </div>
   </div>
         <!--Add product END -->
            

    <script>
          $('#subCategoryDiv').hide();
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
   
   $("#add_product").unbind('submit').on('submit', function() {
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
                      $("#add_product")[0].reset();
                      $("#add_product .form-group").removeClass('has-error').removeClass('has-success');
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
   <script type="text/javascript">
         $(function() {
           
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

            });
</script>
    