<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/30/19
 * Time: 4:16 PM
 */
?>
<!-- Out stock START -->
<style type="text/css">
  /*.ui-autocomplete-input {
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
}*/
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
            <h2 class="header-title">Out Stock</h2>
        </div>
         <div id="messages"></div>
          <form id="out_stock"  action="<?php echo base_url(); ?>index.php/admin/ManageInventory/edit_outstock/<?php echo $id;?>" method="post" >
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8 offset-sm-2">
                        <div class="form-row">
                             <div class="form-group col-md-6">
                                <label class="control-label text-dark">Reference</label>
                                 
                                 <input type="text" class="form-control form-control-sm" name="refno" id="refno" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Student</label>
                                <input type="text" class="form-control form-control-sm" id="Student" name="Student" required="required" readonly>
                            </div>
                           

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Purpose</label>
                                <div class="input-group">

                                   <select class="form-control form-control-sm" name="Clinical_vsit" id="Clinical_vsit" required="required" readonly >
                                     <?php $data  =   $this->Product_model->fetch_stockout($id);
                                   foreach($data as $row){ 
                                               $data2 =  $this->db->query("SELECT * FROM `purpose` WHERE `purpose_id`='".$row->purpose_id."'")->row_array();?>
                                        <option value="<?php echo $data2['purpose'];?>"><?php echo $data2['purpose'];?></option>
                                   <?php }?>
                                        

                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Status*</label>
                                <div class="input-group">
                                    <select class="form-control form-control-sm" name="Status" id="status" required="required">
                                         <option value="">select</option>
                                         <option value="Out Stock">Out Stock</option>
                                         <option value="Partial Returned">Partial Returned</option>
                                         <option value="Returned">Returned</option>
                                    </select>
                                </div>
                            </div>
                         </div>
                         <div class="form-row">
                              <div class="form-group col-md-6">
                                <label class="control-label text-dark">Return Date*</label>
                                <input type="date" class="form-control form-control-sm" id="Return_date" name="Return_date" required="required">
                              </div>
                              <div class="form-group col-md-6">
                                <div class="form-row">
                                 <div class="form-group col-md-12">
                                   <label class="control-label text-dark">Description</label>
                                    <div class="form-row">
                                       <textarea rows="3" cols="50" name="description" id="description" readonly>
                                        </textarea>
                                     </div>
                               </div>
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


            <div class="card input_fields_wrap">
                <div class="row m-h-0 align-items-stretch">
                    <div class="col-md-11 card-header border bottom">
                        <h4 class="card-title">Products</h4>
                    </div>
                    <!-- <div class="text-sm-center m-t-25 float-right">
                            <button type="button" id="addOutStock" data-toggle="modal" data-target="#modal-lg" class="btn btn-gradient-success add_field_button">Add</button>
                        </div> -->


                    <div class="card-body col-sm-12">
                        <div class="table-overflow">
                            <table id="dt-opt" class="table table-hover table-xl">
                                <thead>
                             

                                </thead>
                                <tbody id="stockOutBody">
                                       <?php
          $data4 = $this->db->query("SELECT outstock_item.outstock_id,outstock_item.product_id,outstock_item.qty,outstock_item.outstock_item_id,outstock_item.return_qty,product.product_code,product.product_name FROM product INNER JOIN outstock_item ON outstock_item.product_id = product.product_id WHERE outstock_item.outstock_id ='".$id."'");
                                      foreach($data4->result() as $row){  
                                        
                                  ?>
                                 <tr id="dynamic' + x + '"><td><input type="hidden" name="productId[]" id="productId' + x + '"  /><input type="hidden" value="<?php echo $row->outstock_item_id; ?>" name="outstock_item_id[]" id="outstock_item_id' + x + '"  /><label class="control-label text-dark">Product Name</label><input  id="productName' + x + '" name="productName[]" type="text" class="form-control form-control-sm productName" placeholder="Product Name" required data-pm="productName" value="<?php echo $row->product_name;?>" readonly /></td><td><label class="control-label text-dark">Product Code/SKU</label><input id="pcode' + x + '" name="productCode[]" type="text" class="form-control form-control-sm"  placeholder="Product Code" required readonly value="<?php echo $row->product_code;?>"/></td><td><label class="control-label text-dark">Quantity</label><input  name="Quantity[]" type="number" class="form-control form-control-sm qty"  required readonly value="<?php echo $row->qty;?>"/></td>
                                 <td><label class="control-label text-dark">Returned Quantity*</label><input  name="Returned_Quantity[]" type="number" class="form-control form-control-sm return_qty" value="<?php echo $row->return_qty;?>" required/><span id="error_qty"></span></td></tr>
                               <?php }?>

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

        //adding new row to stock.

        var initCount = 1;
        $("#addOutStock1").click(function () {

            var newStockRow = '<tr id="stockRow' + initCount + '">' +
//

                '<td><label class="control-label text-dark">Product Name</label><input id="productName' + initCount + '" name="productName[]" type="text" class="form-control form-control-sm" placeholder="Product Name" /></td>' +
                '<td><label class="control-label text-dark">Product Code/SKU</label><input id="productCode' + initCount + '" name="productCode[]" type="text" class="form-control form-control-sm"  placeholder="Product Code" /></td>' +
                '<td><label class="control-label text-dark">Quantity</label><input id="Quantity' + initCount + '" name="Quantity[]" type="number" class="form-control form-control-sm qty" /><span id="error_qty"></span></td>' +
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

        $("body").delegate(".return_qty","keyup",function(event){
             event.preventDefault();
           var row = $(this).parent().parent();
           var qty = row.find('.qty').val();
           var pRtn = row.find('.return_qty').val();
            var q = parseInt(pRtn); 

          if (q > qty) {
             $('.return_qty').css("border-color", "red");
             $("#error_qty").html("<p style='color:red'>Return Quantity Exceed</p>");
             $('#status').prop('disabled', false);
          }else{
            //alert("less");
            $('#status').prop('disabled', true);
             $("#error_qty").html("<p></p>");
             $('.return_qty').css("border-color", "");
          }
           
            
        
        });


    });


</script>
<script>
  // submit the create from 
  $("#out_stock1").unbind('submit').on('submit', function() {
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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   <script type="text/javascript">
    $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count

    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $("#stockOutBody").append('<tr id="dynamic' + x + '"><td><label class="control-label text-dark">Product Name</label><input  id="productName' + x + '" name="productName[]" type="text" class="form-control form-control-sm productName" placeholder="Product Name" required data-pm="productName"/></td><td><label class="control-label text-dark">Product Code/SKU</label><input id="pcode' + x + '" name="productCode[]" type="text" class="form-control form-control-sm"  placeholder="Product Code" required readonly/></td><td><label class="control-label text-dark">Quantity</label><input  name="Quantity[]" type="number" class="form-control form-control-sm qty"  required/></td><td><label class="control-label text-dark">Returned Quantity</label><input  name="Returned_Quantity[]" type="number" class="form-control form-control-sm qty"  required/></td><td class="text-center font-size-18"><a class="text-gray  remove_field" href="#" data='+x+' ><i class="ti-trash"></i></td></tr>'); 
            
            $(wrapper).find("#productName"+ x).autocomplete({
               // source: availableAttributes
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
          //alert(ui.item.label);
          // Set selection
          $("#productName"+ x ).val(ui.item.label); // display the selected text
          $('#pcode'+ x).val(ui.item.value); // save selected id to input
          return false;
        }
            }); 
            //add input box
        }
    });
    
   
     $("#stockOutBody").on('click', '.remove_field', function (e) {
            e.preventDefault();
            var delete_row_id = $(this).attr('data');

            $("#dynamic" + delete_row_id).remove();

        });
    
 
    
});

// autocomplete enablement
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type='text/javascript'>
    $(document).ready(function(){

     // Initialize 
     $( "#Student" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?=base_url()?>index.php/admin/ManageInventory/autocomplete_Student",
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
          $('#Student').val(ui.item.label); // display the selected text
          $('#Student').val(ui.item.value); // save selected id to input
          return false;
        }
      });
      fetch_data();
        function fetch_data(){  
                 $.ajax({
                         url:"<?php echo base_url(); ?>index.php/admin/ManageInventory/fetch_stockout?id=<?php echo $id;?>",
                         method:"POST",
                         dataType:"json",
                         success:function(data){ 
                                         
                                         $('#refno').val(data.refno);
                                         $("#Student").val(data.user);
                                        
                                         $("#Return_date").val(data.return_date);
                                         $("#description").val(data.description);
                                         $("#status").val(data.status);
                                          $("#Clinical_vsit").val(data.purpose);
                                         //$("#grandtotalPrice").val(data.grand_total);
                                         //console.log(data.purpose);
                                       
                                        }
                       });
             } 

    });
    </script>
