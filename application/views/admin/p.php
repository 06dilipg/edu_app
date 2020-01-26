
 
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <h2 class="header-title">Purchase List</h2>
        </div>
        <div id="messages"></div>
        <div class="card">
            <div class="card-body">
                <div class="table-overflow">
                    <table class="table table-hover table-responsive table-bordered table-xl display" id="tableMain" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Purchase Reference /Order</th>
                                <th>Bill No</th>
                                <th>Voucher No</th>
                                <th>Buyer</th>
                                <th>Purchase Date</th>
                                <th>Purchase status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php   
                            $counter = 0;
                           $data = $this->db->query("SELECT * FROM `purchase`"); 
                          foreach($data->result() as $row){  $id=$row->purchase_id; 
                           
                            ?>
                            

                        
                         <!--  <tr class="breakrow"> -->
                          <tr data-toggle="collapse" data-target=".demo1" class="accordion-toggle">
                              <td><?php echo ++$counter; ?></td>
                              <td><?php echo $row->purchase_id;?></td>
                              <td><?php echo $row->refno;?></td>
                              <td><?php echo $row->purchase_status;?></td>
                              <td  class="hiddenRow">
                               
                                <?php 
                                  $cd = explode(",", $row->productCode); 
                                  foreach($cd as $code) {
                                     echo   $code = trim($code).'<br>';
                                   }

                               ?>
                              
                             </td>
                              <td  class="hiddenRow">
                               
                                <?php 
                                  $q =  explode(",",$row->Quantity);
                                  foreach($q as $qty) {
                                     echo   $qty = trim($qty).'<br>';
                                   }
                              ?>
                            
                            </td>
                              <td class="hiddenRow">
                               
                                <?php $p = explode(",",$row->Price);
                                    foreach($p as $price) {
                                     echo   $price = trim($price).'<br>';
                                   }
                              ?>
                           
                            </td>
                              <td class="hiddenRow">
                             
                                <?php $tp = explode(",",$row->total_price);
                                  foreach($tp as $total) {
                                     echo   $total = trim($total).'<br>';
                                   }?>
                                
                                 </td>
                                 
                             

                              <td class="text-center font-size-18">
                                
                                  <a href="<?php echo base_url(); ?>index.php/admin/ManageInventory/editPurchase?id=<?php echo $id;?>" class="text-gray m-r-15"><i class="ti-pencil"></i></a>
                                
                                	<!-- <a name="delete"  id="<?php echo $id; ?>"  class="text-gray m-r-15 delete" >  <i class="ti-pencil"></i></a> -->
                              </td>
                         
                              
                                  
                              
                              
                              
                              
                             

                          </tr>
                          </div>
                           <?php  }

                          ?>
                        
                        </tbody>
                    </table>
                   
                      

                </div>
            </div>

        </div>
    </div>
    <!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <!-- <h4 class="modal-title">Remove table</h4> -->
      </div>

      <form role="form" action="<?php echo base_url('users/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
 <!-- <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script> -->
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <script>
  $(function(){
    $("#tableMain").dataTable();

    $('#tableMain').on('click', 'tr.breakrow',function(){
                $(this).nextUntil('tr.breakrow').slideToggle(200);
            });
    
    $(document).on('click', '.delete', function(){  
           var user_id = $(this).attr("id");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>index.php/admin/ManageInventory/remove_purchase",  
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

 
  })
  </script>
 