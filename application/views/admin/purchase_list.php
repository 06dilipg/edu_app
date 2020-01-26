
 
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
                              <td><?php echo $row->refno;?></td>
                              <td><?php echo $row->Bill_no;?></td>
                              <td><?php echo $row->Voucher_no;?></td>
                              <td><?php echo $row->buyer;?></td>
                              <td><?php echo $row->purchase_date;?></td>
                              <td><?php echo $row->purchase_status;?></td>
                              <td class="text-center font-size-18">
                                   <a href="<?php echo base_url(); ?>index.php/admin/ManageInventory/viewPurchase?id=<?php echo $id;?>"  class="text-gray m-r-15" >  <i class="mdi mdi-eye"></i></a>
                                  <a href="<?php echo base_url(); ?>index.php/admin/ManageInventory/editPurchase?id=<?php echo $id;?>" class="text-gray m-r-15"><i class="ti-pencil"></i></a>
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
 
</div>
 
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <script>
  $(function(){
    $("#tableMain").dataTable();
         fetch_data();
      function fetch_data()  
      {  
           
            $.ajax({
                
                  url:"<?php echo base_url(); ?>index.php/admin/ManageInventory/get_purchaseList", 
                  method:"POST",
                  success:function(data){
                      $('#table_data').html(data);
                  }
              });
        } 
    });
  </script>
 