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
          <form id="out_stock"  action="<?php echo base_url(); ?>index.php/admin/ManageInventory/out_stock" method="post" >
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8 offset-sm-2">
                        <div class="form-row">
                             <div class="form-group col-md-6">
                                <label class="control-label text-dark">Reference</label>
                                  <?php $this->load->helper('string');?>
                                 <input type="text" class="form-control form-control-sm" name="refno" value="<?php echo random_string('alnum',4);?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Student*</label>
                                <input type="text" class="form-control form-control-sm" id="Student" name="Student" required="required">
                                <input type="hidden" name="user_id" id="user_id">
                            </div>
                           

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Purpose*</label>
                                <div class="input-group">
                                    <select class="form-control form-control-sm" name="Clinical_vsit" required="required">
                                        <option value="">select</option>
                                        <?php $data = $this->db->query("SELECT * FROM `purpose`");
                                              foreach ($data->result() as $row) {
                                                $product_id = $row->product_id;   ?>
                                              <option value="<?php echo $row->purpose_id;?>"><?php echo $row->purpose;?></option>
                                            <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Status*</label>
                                <div class="input-group">
                                    <select class="form-control form-control-sm" name="Status" required="required">
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
                                <label class="control-label text-dark">Return Date</label>
                                <input type="date" class="form-control form-control-sm" name="Return_date">
                              </div>
                              <div class="form-group col-md-6">
                                <div class="form-row">
                                 <div class="form-group col-md-12">
                                   <label class="control-label text-dark">Description</label>
                                    <div class="form-row">
                                       <textarea rows="3" cols="50" name="description">
                                        </textarea>
                                     </div>
                               </div>
                           </div>
                              </div>
                        </div>




                    </div>

                  
                </div>

            </div>


            <div class="card input_fields_wrap">
                <div class="row m-h-0 align-items-stretch">
                    <div class="col-md-11 card-header border bottom">
                        <h4 class="card-title">Products</h4>
                    </div>
                    <div class="text-sm-center m-t-25 float-right">
                            <button type="button" id="addOutStock" data-toggle="modal" data-target="#modal-lg" class="btn btn-gradient-success add_field_button">Add</button>
                        </div>


                    <div class="card-body col-sm-12">
                        <div class="table-overflow">
                            <table id="dt-opt" class="table table-hover table-xl">
                                <thead>

                                </thead>
                                <tbody id="stockOutBody">


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
                '<td><label class="control-label text-dark">Quantity</label><input id="Quantity' + initCount + '" name="Quantity[]" type="number" class="form-control form-control-sm qty" /></td>' +
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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   <script type="text/javascript">
    $(document).ready(function() {

    var save = false;  
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count

    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $("#stockOutBody").append('<tr id="dynamic' + x + '"><td><label class="control-label text-dark">Product Name*</label><input  id="productName' + x + '" name="productName[]" type="text" class="form-control form-control-sm productName" placeholder="Product Name" required data-pm="productName"/></td><td><label class="control-label text-dark">Product Code/SKU</label><input id="pcode' + x + '" name="productCode[]" type="text" class="form-control form-control-sm"  placeholder="Product Code" required readonly/><input type="hidden" name="productId[]" id="productId' + x + '" class="productId" /></td><td><label class="control-label text-dark">Quantity*</label><input  name="Quantity[]" type="number" class="form-control form-control-sm qty"  required/><span id="error_qty"></span></td><td class="text-center font-size-18"><a class="text-gray  remove_field" href="#" data='+x+' ><i class="ti-trash"></i></td></tr>'); 
            
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
          $('#pcode'+ x).val(ui.item.value);
           $('#productId' + x).val(ui.item.id); // save selected id to input
          return false;
        }
            }); 
            //add input box
              
            //   console.log(pId);
            var user_id = $(this).attr("id");  
            var user_id = $(this).attr("id");  
              $("body").delegate(".qty","keyup",function(event){
             event.preventDefault();
           var row = $(this).parent().parent();
           var pId = row.find('.productId').val();
           //console.log(pId);
           var qty = row.find('.qty').val();
           var data = {pId:pId,qty:qty};
           $.ajax({
            url: "<?=base_url()?>index.php/admin/ManageInventory/search_qty",
            type: 'post',
            dataType: "json",
            data: data,
            success: function( res ) {
              var result = res.stock;
               //alert(res.db);
              // alert(result);

             // alert(res.total_qty);(integer)qty
           var q = parseInt(qty); 
              if ( q <= result) {
                ///alert("you entered else qty");

                $('.qty').css("border-color", "green");
                $("#error_qty").html("<p></p>");
                 save = true;
             
              }else if(q > result){
                $('.qty').css("border-color", "red");
                $("#error_qty").html("<p style='color:red'>Stock Exceed,Enter Quantity below:"+result+"</p>");
                save = false;
              }
            }
          });
        
        });
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
          $('#Student').val(ui.item.value);
          $('#user_id').val(ui.item.id); // save selected id to input
          return false;
        }
      });

    });
    </script>
