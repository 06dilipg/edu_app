
 
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
                          
                        
                        </tbody>
                    </table>
                   
                      

                </div>
            </div>

        </div>
    </div>
 
</div>
 
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <script>
    var manageTable;
    var base_url = "<?php echo base_url(); ?>index.php/admin/ManageInventory/fetchdata_PurchaseList";
    $(document).ready(function() {
      
       manageTable = $('#tableMain').DataTable({
         'ajax': base_url,
         'order': []
         });
      
   
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
 