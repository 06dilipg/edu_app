<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/30/19
 * Time: 4:16 PM
 */
?>
<!-- Add purchase START -->
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <h2 class="header-title">Edit Purchase</h2>
        </div>
         
          <div id="messages"></div>
        <?php $id = $_GET['id'];?>
        <div class="card">
           <form id="edit"  action="<?php echo base_url(); ?>index.php/admin/ManageInventory/edit_Product/<?php echo $id;?>" method="post" >
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8 offset-sm-2">
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Purchase Order / Reference</label>
                               
                                <input type="text" class="form-control form-control-sm" id="refno" name="refno" value="" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Buyer</label>
                                <input type="text" class="form-control form-control-sm" name="buyer" id="buyer" readonly >
                            </div>

                        </div>
                        <div class="form-row">
                         <div class="form-group col-md-6">
                            <label class="control-label text-dark">Purchase Status*</label>
                            <div class="input-group">
                                <select class="form-control form-control-sm" name="purchase_status" id="purchase_status"  required="required">
                                    <option value="">select</option>
                                   <option value="Received">Received</option>
                                    <option value="Partial">Partial</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Ordered">Ordered</option>
                                </select>
                            </div>
                         </div>
 

                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Purchase Date*</label>
                                <input type="date" class="form-control form-control-sm" name="purchase_date" id="purchase_date" required="required">
                            </div>


                        </div>
                        <div class="form-row">
                         <div class="form-group col-md-6">
                            <label class="control-label text-dark">Bill No</label>
                            <input type="text" class="form-control form-control-sm" name="Bill_no" id="Bill_no" readonly>
                         </div>


                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Voucher No</label>

                                <input type="text" class="form-control form-control-sm" name="Voucher_no" id="Voucher_no" readonly>
                            </div>


                        </div>
                        </div>
                        </div>
                       </div>

                   


            <div class="card input_fields_wrap">
                <div class="row m-h-0 align-items-stretch">
                    <div class="col-md-11 card-header border bottom">
                        <h4 class="card-title">Order Table</h4>
                    </div>
                     <div class="text-sm-center m-t-25 float-right">
                            <button type="button" id="addPurchase" data-toggle="modal" data-target="#modal-lg" class="btn btn-gradient-success add_field_button">Add</button>
                        </div>


                    <div class="card-body col-sm-12">
                        <div class="table-overflow">
                            <table id="dt-opt" class="table table-hover table-xl">
                                <thead>

                                </thead>
                                <tbody id="createPurchaseBody">
                                   <?php
                                    $data4 = $this->db->query("SELECT purchase_item.qty,purchase_item.price,purchase_item.purchase_item_id, product.product_code,product.product_name FROM product INNER JOIN purchase_item ON purchase_item.product_id=product.product_id WHERE purchase_item.purchase_id ='".$id."'");
                                      foreach($data4->result() as $row){ 
                                        
                                         $gtotal =    $row->qty*$row->price
                                        ?>
                                     <input type="hidden" name="purchase_item_id[]" value="<?php echo $row->purchase_item_id?>">
                               
                                 <tr id="dynamic">
                                  <td>
                                    <input type="hidden" name="productId[]"/ value="0">
                                    <label class="control-label text-dark">Product Name</label>
                                    <input  id="productName" name="productName[]" type="text" class="form-control form-control-sm productName" placeholder="Product Name"  value="<?php echo $row->product_name;?>" readonly />
                                    <input type="hidden" name="pname[]" value="0" >
                                  </td>
                                  <td>
                                    <label class="control-label text-dark">Product Code/SKU</label>
                                    <input id="pcode" name="productCode[]" type="text" class="form-control form-control-sm"   placeholder="Product Code"  readonly value="<?php echo $row->product_code;?>"/></td>
                                    <td>
                                      <label class="control-label text-dark">Quantity</label><input id="Quantity' + x + '" name="Quantity[]" type="number"  class="form-control form-control-sm qty"   value="<?php echo $row->qty;?>"/></td>
                                      <td><label class="control-label text-dark">Unit Price</label>
                                        <input name="Price[]" type="number" id="Price" class="form-control form-control-sm price"  placeholder="Enter Price Per Unit" value="<?php echo $row->price;?>"/>
                                        <input name="SubPrice[]" type="hidden" class="form-control form-control-sm Subprice"   value="<?php echo $gtotal;?>" />
                                      </td></td>
                                      </tr>
                                   <?php    }
                                  ?>
 

                                </tbody>
                                <tfoot id="gtotal" align="center">
                                  <tr id="total"> <td></td><td></td><td></td><td><label class="control-label text-dark">Grand Total </label><input type="number" id="grandtotalPrice" name="total_price" class="form-control form-control-sm" placeholder="Grand Total" readonly/></td></tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                  


                </div>
            </div>

            <div class="col-sm-12">
                <div class="text-sm-center m-t-25">
                    <button type="submit" class="btn btn-gradient-success"  id="save">Save</button>
                </div>
            </div>

   

  </form>

        </div>
    </div>
</div>
<!--Out stock END -->
 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
    /* Jquery for change in add purchase field.*/
    $(document).ready(function () {
       get_viewPurchase1();    
       function get_viewPurchase1(){
                $.ajax({
                     url:"<?php echo base_url(); ?>index.php/admin/ManageInventory/get_viewPurchase1?id=<?php echo $id;?>",
                     method:"POST",
                     success:function(data){ 
                                  $('#createPurchaseBody').html(data);
                                         
                                        }
                       });
              } 
        fetch_data();
        function fetch_data(){  
                 $.ajax({
                         url:"<?php echo base_url(); ?>index.php/admin/ManageInventory/fetch_purchase?id=<?php echo $id;?>",
                         method:"POST",
                         dataType:"json",
                         success:function(data){ 
                                         
                                         $('#refno').val(data.refno);
                                         $("#buyer").val(data.buyer);
                                         $("#purchase_status").val(data.purchase_status);
                                         $("#purchase_date").val(data.purchase_date);
                                         $("#Bill_no").val(data.Bill_no);
                                         $("#Voucher_no").val(data.Voucher_no);
                                         $("#grandtotalPrice").val(data.grand_total);

                                        
                                        }
                       });
             } 
         fetch_data1();
        function fetch_data1(){  
                 $.ajax({
                         url:"<?php echo base_url(); ?>index.php/admin/ManageInventory/fetch_purchaseProduct?id=<?php echo $id;?>",
                         method:"POST",
                         dataType:"json",
                         success:function(data){ 
                                         $('#purchase_item_id').val(data.purchase_item_id);
                                         
                                        }
                       });
             } 

     $("#edit").unbind('submit').on('submit', function() {
        var form = $(this);
       $(".text-danger").remove();
        $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {
               //  alert(response);
                 if(response.success === true) {
                       $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                        '</div>');
                      $("#add_pruchase")[0].reset();
                      $("#add_pruchase .form-group").removeClass('has-error').removeClass('has-success');
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
    });

  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      var max_fields      = 30; 
      var wrapper         = $(".input_fields_wrap"); 
      var add_button      = $(".add_field_button"); 
      var x = 1; 
      $(add_button).click(function(e){ 
         e.preventDefault();
         if(x < max_fields){ 
            x++; //text box increment
            $("#createPurchaseBody").append('<tr id="dynamic' + x + '"><td><label class="control-label text-dark">Product Name*</label><input  id="productName' + x + '" name="productName[]" type="text" class="form-control form-control-sm productName" placeholder="Product Name"  data-pm="productName" required="required"/><input type="hidden" name="pname[]" value="1"/></td><td><label class="control-label text-dark">Product Code/SKU*</label><input id="pcode' + x + '" name="productCode" type="text" class="form-control form-control-sm"  placeholder="Product Code"  readonly required="required"/><input type="hidden" name="productId[]" id="productId' + x + '"  /></td><td><label class="control-label text-dark">Quantity*</label><input id="Quantity' + x + '" name="Quantity[]" type="number"  class="form-control form-control-sm qty"   value="" required="required"/></td><td><label class="control-label text-dark">Price Per Unit* </label><input name="Price[]" type="number" id="Price'+x+'" class="form-control form-control-sm price"  placeholder="Price Per Unit" required="required"/></td><td style="display:none"><label class="control-label text-dark">S Price</label><input name="SubPrice[]" type="number" class="form-control form-control-sm Subprice" required /></td></tr>'); 
            
             //var quantity_in = $("Quantity" + x ).val();
            // console.log(quantity_in);
            // alert(quantity_in);

            $(wrapper).find("#productName"+ x).autocomplete({
                       source: function( request, response ) {
          
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
                    $('#pcode'+ x).val(ui.item.value); 
                    $('#productId' + x).val(ui.item.id);// save selected id to input
                    return false;
                  }
                }); 
               }


           
           });
         
    
   
     $("#createPurchaseBody").on('click', '.remove_field', function (e) {
            e.preventDefault();
            var delete_row_id = $(this).attr('data');

            $("#dynamic" + delete_row_id).remove();

        });

          var net_total = 0;
          $("body").delegate(".price,.qty","keyup",function(event){
            event.preventDefault();
            var row = $(this).parent().parent();
            var price = row.find('.price').val();
            var qty = row.find('.qty').val();
           if (isNaN(qty)) {
            qty = 1;
            };
            if (qty < 1) {
             qty = 1;
            };
          var total = price * qty;
          row.find('.Subprice').val(total);
          var net_total=0;
          $('.Subprice').each(function(){
            net_total += ($(this).val()-0);
          })
          $("#grandtotalPrice").val(net_total);
          });


       
 
 
    
});
 

  </script>
