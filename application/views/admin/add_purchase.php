<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/30/19
 * Time: 4:16 PM
 */
?>
<style type="text/css">
 
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
<!-- Add purchase START -->
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <h2 class="header-title">Create Purchase</h2>
        </div>
         
          <div id="messages"></div>
        
        <div class="card">

           <form id="add_pruchase"  action="<?php echo base_url(); ?>index.php/admin/ManageInventory/createPruchase" method="post" >
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8 offset-sm-2">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Purchase Order / Reference</label>
                                <?php  $this->load->helper('string'); ?>
                                <input type="text" class="form-control form-control-sm" name="refno" value="<?php echo random_string('alnum',4);?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Buyer*</label>
                                <input type="text" class="form-control form-control-sm" name="buyer" required="required" >
                            </div>

                        </div>
                        <div class="form-row">
                         <div class="form-group col-md-6">
                            <label class="control-label text-dark">Purchase Status*</label>
                            <div class="input-group">
                                <select class="form-control form-control-sm" name="purchase_status" required="required">
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
                                <input type="date" class="form-control form-control-sm" name="purchase_date" required="required">
                            </div>


                        </div>
                        <div class="form-row">
                         <div class="form-group col-md-6">
                            <label class="control-label text-dark">Bill No</label>
                            <input type="text" class="form-control form-control-sm" name="Bill_no">
                         </div>


                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Voucher No</label>
                                <input type="text" class="form-control form-control-sm" name="Voucher_no">
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


                                </tbody>
                                <tfoot id="gtotal" align="center">
                                  
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
       $("#gtotal").hide();
         var initCount = 1;
         $("#addPurchase1").click(function () {
               var newPurchaseRow = '<tr id="purchaseRow' + initCount + '">' +
//
                '<td><label class="control-label text-dark">Product Name</label><input  id="productName[]" name="productName[]" type="text" class="form-control form-control-sm productName" placeholder="Product Name" required data-pm="productName"/></td>' +
                '<td><label class="control-label text-dark">Product Code/SKU</label><input id="productCode' + initCount + '" name="productCode[]" type="number" class="form-control form-control-sm"  placeholder="Product Code" required/></td>' +
                '<td><label class="control-label text-dark">Quantity</label><input id="Quantity' + initCount + '" name="Quantity[]" type="number" class="form-control form-control-sm qty"  required/></td>' +
                '<td><label class="control-label text-dark">Sub Total</label><input id="Price' + initCount + '" name="Price[]" type="number" class="form-control form-control-sm price" required placeholder="" /></td>' +
                '<td><label class="control-label text-dark">Suv pric</label><input id="Price' + initCount + '" name="Price[]" type="number" class="form-control form-control-sm price" required /></td>' +
                '<td class="text-center font-size-18"><a class="text-gray delete-products-row" href="#" data=' + initCount + ' ><i class="ti-trash"></i></td>' +
                '</tr>';

             $("#createPurchaseBody").append(newPurchaseRow);
                initCount++;
          });
           //grandtoatl
           $( "#addPurchase" ).one( "click", function() {
 
            $("#gtotal").show();
             var grandtotal = '<tr id="total"> <td></td><td></td><td></td><td></td><td><label class="control-label text-dark">Grand Total </label><input type="number" id="grandtotalPrice" name="total_price" class="form-control form-control-sm" placeholder="Grand Total" readonly/></td></tr>';
            $("#gtotal").append(grandtotal);
          });
      });
 </script>
 <script>
  
  $("#add_pruchase").unbind('submit').on('submit', function() {
     var form = $(this);
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
            $("#createPurchaseBody").append('<tr id="dynamic' + x + '"><td><label class="control-label text-dark">Product Name*</label><input  id="productName' + x + '" name="productName[]" type="text" class="form-control form-control-sm productName" placeholder="Product Name"  data-pm="productName" required="required"/></td><td><label class="control-label text-dark">Product Code/SKU*</label><input id="pcode' + x + '" name="productCode" type="text" class="form-control form-control-sm"  placeholder="Product Code"  readonly/><input type="hidden" name="productId[]" id="productId' + x + '"  /></td><td><label class="control-label text-dark">Quantity*</label><input id="Quantity' + x + '" name="Quantity[]" type="number"  class="form-control form-control-sm qty"   value="" required="required"/></td><td><label class="control-label text-dark">Price Per Unit*</label><input name="Price[]" type="number" id="Price'+x+'" class="form-control form-control-sm price"  placeholder="Price Per Unit" required="required"/></td><td style="display:none;"><label class="control-label text-dark">S Price</label><input name="SubPrice[]" type="number" class="form-control form-control-sm Subprice" required /></td><td class="text-center font-size-18"><a class="text-gray  remove_field" href="#" data='+x+' ><i class="ti-trash"></i></td></tr>'); 
            
             

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
