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
            <h2 class="header-title">Edit Stock</h2>
        </div>
         <div id="messages"></div>
          <form id="out_stock"  action="<?php echo base_url(); ?>index.php/admin/ManageInventory/edit_Stock/<?php echo $id?>" method="post" >
             <?php 

             $data = $this->db->query("SELECT * FROM `stock_history` WHERE `histroy_id`='$id'")->row_array();; 
             //echo $this->db->last_query();
            ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8 offset-sm-2">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Student</label>
                                <input type="text" class="form-control form-control-sm" name="Student" required="required" value="<?php echo $data['student'];?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Reference</label>
                                  <?php $this->load->helper('string');?>
                                 <input type="text" class="form-control form-control-sm" name="refno" value="<?php echo $data['refno'];?>" readonly>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Return Date</label>
                                <input type="date" class="form-control form-control-sm" name="Return_date" required="required" value="<?php echo $data['return_date'];?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Clinical Visit</label>
                                <div class="input-group">
                                    <select class="form-control form-control-sm" name="Clinical_vsit" required="required">
                                 <option value="<?php echo $data['clinical_visit']; ?>" selected="selected"><?php echo $data['clinical_visit']; ?></option>
                                         <option value="">select</option>
                                        <option value="Demo1">Demo1</option>
                                        <option value="Demo2">Demo2</option>
                                    </select>
                                </div>
                            </div>

                        </div>



                    </div>

                    <!-- <div class="col-sm-12">
                        <div class="text-sm-center m-t-25 float-right">
                            <button type="button" id="addOutStock" data-toggle="modal" data-target="#modal-lg" class="btn btn-gradient-success">Add</button>
                        </div>
                    </div> -->

                </div>

            </div>


            <div class="card">
                <div class="row m-h-0 align-items-stretch">
                    <div class="col-md-11 card-header border bottom">
                        <h4 class="card-title">Products</h4>
                    </div>
                 <!--    <div class="text-sm-center m-t-25 float-right">
                            <button type="button" id="addOutStock" data-toggle="modal" data-target="#modal-lg" class="btn btn-gradient-success">Add</button>
                        </div> -->


                    <div class="card-body col-sm-12">
                        <div class="table-overflow">
                            <table id="dt-opt" class="table table-hover table-xl">
                                <thead>

                                </thead>
                                <tbody id="stockOutBody">
                               <tr id="">
                                <td>
                                  <?php 
                                  $pm = explode(",",  $data['product_name']); 
                                  foreach($pm as $pname) {
                                   $pname = trim($pname); ?>
                                  <label class="control-label text-dark">Product Name</label>
                                  <input  name="productName[]" type="text" class="form-control form-control-sm" placeholder="Product Name"  value="<?php echo $pname; ?>"/><br>
                                 <?php   } ?>
                                </td>
                <td>
                   <?php 
                                  $pc = explode(",",  $data['product_code']); 
                                  foreach($pc as $pcode) {
                                   $pcode = trim($pcode); ?>
                  <label class="control-label text-dark">Product Code/SKU</label><input id="productCode' + initCount + '" name="productCode[]' + initCount + '" type="text" class="form-control form-control-sm"  placeholder="Product Code" value="<?php echo $pcode;?>" readonly /><br>
                 <?php   } ?>
                </td>
                  
                <td>
                      <?php 
                          $q = explode(",",  $data['Quantity']); 
                          foreach($q as $qty) {
                          $qty = trim($qty); ?>
                  <label class="control-label text-dark">Quantity</label><input  name="Quantity[]" type="number" class="form-control form-control-sm" value="<?php echo $qty;?>" required/><br>
                   <?php   } ?>
                </td>
                <td>
                    <?php 
                    if($data['return_qty'] != ""){ 
                          $rtq = explode(",",  $data['return_qty']); 
                          foreach($rtq as $rtn_qty) {
                          $rtn_qty = trim($rtn_qty); 
                     ?> 
                        <label>Returned Quantity</label>
                        <input type="number" name="return_qty[]" class="form-control form-control-sm rtn" value="<?php echo $rtn_qty;?>" required ><br>

                   <?php } }else{ 
                       foreach($q as $qty) { ?>
                           <label>Returned Quantity</label>
                        <input type="number" name="return_qty[]" class="form-control form-control-sm rtn" value="" required class="return_qty" ><br>

                    <?php    }
                     

                 } ?>

                         

               
                     
                   
                </td>

               
                </tr>

                                </tbody>
                            </table>
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
<!--Out stock END -->

<script type="text/javascript">
    /* Jquery for change in add stock field.*/
    $(document).ready(function () {
         var initCount = 1;
        $("#addOutStock").click(function () {

            var newStockRow = '<tr id="stockRow' + initCount + '">' +
//

                '<td><label class="control-label text-dark">Product Name</label><input id="productName' + initCount + '" name="productName[]'  + initCount + '" type="text" class="form-control form-control-sm" placeholder="Product Name" /></td>' +
                '<td><label class="control-label text-dark">Product Code/SKU</label><input id="productCode' + initCount + '" name="productCode[]' + initCount + '" type="text" class="form-control form-control-sm"  placeholder="Product Code" readonly /></td>' +
                '<td><label class="control-label text-dark">Quantity</label><input id="Quantity' + initCount + '" name="Quantity[]' + initCount + '" type="number" class="form-control form-control-sm" /></td>' +
                '<td class="text-center font-size-18"><a class="text-gray delete-products-row" href="#" data=' + initCount + ' ><i class="ti-trash"></i></td>' +
                '</tr>';



            $("#stockOutBody").append(newStockRow);
            initCount++;
        });

        //binding the event to delete_button_by_row.
        $("#stockOutBody").on('click', '.delete-products-row', function (e) {
            e.preventDefault();
            var delete_row_id = $(this).attr('data');

            $("#stockRow" + delete_row_id).remove();

        });

        
    });


</script>
<script>
  // submit the create from 
  $("#out_stock").unbind('submit').on('submit', function() {
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
                      $("#out_stock")[0].reset();
                      $("#out_stock .form-group").removeClass('has-error').removeClass('has-success');
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
