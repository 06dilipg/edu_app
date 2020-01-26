
<div class="main-content">
   <div class="container-fluid">
     <div class="page-header">
        <h2 class="header-title">Stock List</h2>
     </div>
      <div id="messages"></div>
     <div class="card">
         <div class="card-body">
             <div class="table-overflow">
                 <table id="list" class="table table-hover table-xl">
                     <thead>
                         <tr>
                             <th>Sl No</th>
                             <th>Product name</th>
                             <th>Initial stock</th>
                             <th>Stock out</th>
                             <th>Current stock</th>
                             
                             <th>Date</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php   
                               $counter = 0;
                              

                          ?>
                       <tr>
                           <td><?php echo ++$counter; ?></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                     
                           <td class="text-center font-size-18">
                              
                                <a href=""><i class="ti-pencil"></i></a>
                                
                              <!--   <a name="delete"  id="<?php echo $id; ?>"  class="text-gray m-r-15 delete" >  <i class="ti-pencil"></i></a> -->
                           </td>
                       </tr>
                       
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
     $("#list").dataTable();

    // $('#tableMain').on('click', 'tr.breakrow',function(){
    //             $(this).nextUntil('tr.breakrow').slideToggle(200);
    //         });

    $(document).on('click', '.delete', function(){  
           var user_id = $(this).attr("id");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>index.php/admin/ManageInventory/remove_stock",  
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
  });
  </script>
