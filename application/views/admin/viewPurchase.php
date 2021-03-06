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
            <h2 class="header-title">View Purchase</h2>
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
                                
                                <input type="text" class="form-control form-control-sm" id="refno" name="refno" value="" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Buyer</label>
                                <input type="text" class="form-control form-control-sm" name="buyer" id="buyer" readonly >
                            </div>

                        </div>
                        <div class="form-row">
                         <div class="form-group col-md-6">
                            <label class="control-label text-dark">Purchase Status</label>
                            <div class="input-group">
                                <select class="form-control form-control-sm" name="purchase_status" id="purchase_status"  readonly>
                                    <option value="">select</option>
                                   <option value="Received">Received</option>
                                    <option value="Partial">Partial</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Ordered">Ordered</option>
                                </select>
                            </div>
                         </div>
 

                            <div class="form-group col-md-6">
                                <label class="control-label text-dark">Purchase Date</label>
                                <input type="date" class="form-control form-control-sm" name="purchase_date" id="purchase_date" readonly>
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
                     <!-- <div class="text-sm-center m-t-25 float-right">
                            <button type="button" id="addPurchase" data-toggle="modal" data-target="#modal-lg" class="btn btn-gradient-success add_field_button">Add</button>
                        </div> -->


                    <div class="card-body col-sm-12">
                        <div class="table-overflow">
                            <table id="dt-opt" class="table table-hover table-xl">
                                
                                <tbody id="createPurchaseBody">

                                  <?php
                                    $data4 = $this->db->query("SELECT purchase_item.qty,purchase_item.price,product.product_code,product.product_name FROM product INNER JOIN purchase_item ON purchase_item.product_id=product.product_id WHERE purchase_item.purchase_id ='".$id."'");
                                      foreach($data4->result() as $row){ ?>
                                     
                               
                                 <tr id="dynamic"><td><label class="control-label text-dark">Product Name</label><input  id="productName' + x + '" name="productName[]" type="text" class="form-control form-control-sm productName" placeholder="Product Name"  data-pm="productName" value="<?php echo $row->product_name;?>" readonly /></td><td><label class="control-label text-dark">Product Code/SKU</label><input id="pcode' + x + '" name="productCode" type="text" class="form-control form-control-sm"  placeholder="Product Code"  readonly value="<?php echo $row->product_code;?>" readonly/></td><td><label class="control-label text-dark">Quantity</label><input id="Quantity' + x + '" name="Quantity[]" type="number"  class="form-control form-control-sm qty"   value="<?php echo $row->qty;?>" readonly/></td><td><label class="control-label text-dark">Price Per Unit </label><input name="Price[]" type="number" id="Price'+x+'" class="form-control form-control-sm price"  placeholder=" Price Per Unit" value="<?php echo $row->price;?>" readonly/></td><td style="display:none;"><label class="control-label text-dark">S Price</label><input name="SubPrice[]" type="number" class="form-control form-control-sm Subprice" required /></td><td class="text-center font-size-18"><a class="text-gray  remove_field" href="#" data='+x+' ><i class="ti-trash"></i></td></tr>
                                   <?php    }
                                  ?>
 

                                </tbody>
                                <tfoot id="gtotal" align="center">
                                  <tr id="total"> <td></td><td></td><td></td><td></td><td><label class="control-label text-dark">Grand Total </label><input type="number" id="grandtotalPrice" name="total_price" class="form-control form-control-sm" placeholder="Grand Total" readonly/></td></tr>
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
                                         $('#product_idd').val(data.product_id);
                                         
                                        }
                       });
             } 
    });

  </script>
