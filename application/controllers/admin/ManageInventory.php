      <?php
      /**
      * Created by PhpStorm.
      * User: user
      * Date: 12/30/19
      * Time: 3:12 PM
      */
      class ManageInventory extends CI_Controller{ 
            public function __construct()
            { 
            parent::__construct();
            //check for session
            if($_SESSION['logged_in']==false){
            return redirect('welocme');
            }
            $this->load->helper ( array (
            'form',
            'url', 
            'html',
            'security'
            ));
            $this->load->library ( array (
            'form_validation',
            'email',
            'upload'
            ));
            $this->load->model ('Product_model');
            // $this->load->model('User_model1');
            }
            public function index(){
            $this->load->view("admin/header");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/add_product");
            $this->load->view("admin/footer");
            }
            public function addPurchase(){
            $this->load->view("admin/header");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/add_purchase");
            $this->load->view("admin/footer");
            }
            public function listPurchase(){
            $this->load->view("admin/header");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/purchase_list",$_GET);
            $this->load->view("admin/footer");
            }
            public function addStock(){
            $this->load->view("admin/header");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/add_stock",$_GET);
            $this->load->view("admin/footer");
            }
            public function listStock(){
            $this->load->view("admin/header");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/stock_list",$_GET);
            $this->load->view("admin/footer");
            }
            public function outStock(){
            $this->load->view("admin/header");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/out_stock",$_GET);
            $this->load->view("admin/footer");
            }
            public function outstockList(){
            $this->load->view("admin/header");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/outStock_list");
            $this->load->view("admin/footer");
            }
            public function editPurchase(){
            $this->load->view("admin/header");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/Edit_Purchase",$_GET);
            $this->load->view("admin/footer");
            }
            public function viewPurchase(){
            $this->load->view("admin/header");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/viewPurchase",$_GET);
            $this->load->view("admin/footer");
            }
            public function editStock(){
            $this->load->view("admin/header");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/Edit_Stock",$_GET);
            $this->load->view("admin/footer");
            } 
            public function editStockOut(){
            $this->load->view("admin/header");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/Edit_stockout",$_GET);
            $this->load->view("admin/footer");
            } 
            public function addPurchase1(){
            $this->load->view("admin/header");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/add_purchase1");
            $this->load->view("admin/footer");
            }
            //category dropdown
            public function search_Category (){
                   $data  =    $this->Product_model->search_Category();
                   $output = ' <option value="">Select Category</option>';
                          foreach($data->result() as $row)
                          {
                           $output .= ' 
                           <option class="form-control form-control-sm" id="'.$row->category_id.'" data-id="'. $row->category_id.'" value="'.$row->category_id.'">'.$row->category_name.'</option>';
                           }
                 
                   echo $output;
           
            }
            //Sub Category Deopdown
            public function search_subCategory (){
                  $id = $_POST["id"];
                  $data  =    $this->Product_model->search_SubCategory($id);
                  $output = "";
                  if ($data->num_rows() > 0)
                  {
                  $output .= '  <label class="control-label text-dark">Sub Category</label> 
                  <select class="form-control form-control-sm" id="subcategor" name="subcategory" required>
                     ';
                     $output .= '  
                     <option value="">Select Sub Category</option>
                     ';
                     foreach($data->result() as $row)
                     {
                     $output .= ' 
                     <option value="'.$row->sub_category_id.'">'.$row->sub_category_name.'</option>
                     ';
                     }
                     $output .= '  
                  </select>
                  ';
                  }else{
                  $output .= '';
                  }
                  echo $output;
            }
             //Autocomplete of Product
          public function autocomplete_product(){
                $postData = $this->input->post();
                $data = $this->Product_model->get_autoProducts($postData);
                echo json_encode($data);
            }
             //Autocomplete of User
            public function autocomplete_Student(){
                   $postData = $this->input->post();
                   $data = $this->Product_model->get_autoStudents($postData);
                   echo json_encode($data);
            }


           // Inventory purchase
            
            public function createProduct(){
                  $response = array();
                  $data = array(
                  'product_code' => $this->input->post('product_code'),
                  'product_name' => $this->input->post('product_name'),
                  'category' => $this->input->post('category'),
                  'sub_category' => $this->input->post('subcategory'),   
                  'product_size' => $this->input->post('size'),   
                  'product_capacity' => $this->input->post('capacity'), 
                  'product_unit' => $this->input->post('unit'), 
                  'product_description' => $this->input->post('description')
                 
                  );
                  $create = $this->Product_model->create_product($data);
                  //  echo $this->db->last_query(); 
                  if($create == true) {
                  $response['success'] = true;
                  $response['messages'] = 'Succesfully Added';
                  }
                  else {
                  $response['success'] = false;
                  $response['messages'] = 'Error in the database while creating';            
                  }
                  echo json_encode($response);
            }
            //add purchase
            public function createPruchase(){
                   $response = array();
                   $data = array(
                        'refno' => $this->input->post('refno'),
                        'buyer' => $this->input->post('buyer'),
                        'Bill_no' => $this->input->post('Bill_no'),
                        'Voucher_no' => $this->input->post('Voucher_no'),
                        'purchase_status' => $this->input->post('purchase_status'),
                        'purchase_date' => $this->input->post('purchase_date'),   
                         'grand_total' =>  $this->input->post('total_price')
                
                   );
                  $create = $this->Product_model->create_purchase($data);
                  if($create == true) {
                  $response['success'] = true;
                  $response['messages'] = 'Succesfully Added Product';
                  }
                  else {
                  $response['success'] = false;
                  $response['messages'] = 'Error in the database while creating the Product';            
                  }
                  $refno = $this->input->post('refno');
                  $purchaseid = $this->Product_model->fetch_purchaseID($refno);
                  $purchase_id = $purchaseid->row_array();
                  $prcID = $purchase_id['purchase_id'];
                 $productId =    implode(',',$this->input->post('productId')); 
                 $Quantity =     implode(',',$this->input->post('Quantity'));
                 $Price =       implode(',',$this->input->post('Price'));
                 $pro_id = explode(",",$productId);
                 $pro_qty = explode(",",$Quantity);
                 $pro_price = explode(",",$Price);

                 $total_proId = count($pro_id);
                 for($y=0;$y<$total_proId;$y++){
                  $dat1 = $this->db->query("INSERT INTO `purchase_item`(`purchase_id`, `product_id`, `qty`, `price`) VALUES ('".$prcID."','".$pro_id[$y]."','".$pro_qty[$y]."','".$pro_price[$y]."')");
                  }
                  echo json_encode($response);
           }
          public  function fetchdata_PurchaseList(){
                $counter = 0;
                $result = array('data' => array());
                $data = $this->Product_model->getData_PurchaseList();
                foreach ($data as $key => $value) {
                 $buttons = '';
                 $buttons = '<a href="'.base_url().'index.php/admin/ManageInventory/viewPurchase?id='.$value['purchase_id'].'" type="button" class="text-gray m-r-15"><i class="mdi mdi-eye"></i></a>';
                $buttons .= '<a href="'.base_url().'index.php/admin/ManageInventory/editPurchase?id='.$value['purchase_id'].'" class="text-gray m-r-15"><i class="ti-pencil"></i></a>';
                 $result['data'][$key] = array(
                 
                  $value['refno'],
                  $value['Bill_no'],
                  $value['Voucher_no'],
                  $value['buyer'],
                  $value['purchase_date'],
                  $value['purchase_status'],
                   $buttons
                 );
              } 
            echo json_encode($result);

        }
       public function fetch_purchase(){
                     $id = $_GET['id'];     
                     $data  =   $this->Product_model->fetch_purchase($id);
                   
                     foreach($data as $row){ 

                                      
                                      $output['refno'] = $row->refno;  
                                      $output['buyer'] = $row->buyer;
                                      $output['Bill_no'] = $row->Bill_no;
                                      $output['Voucher_no'] = $row->Voucher_no;
                                      $output['purchase_status'] = $row->purchase_status;
                                      $output['purchase_date'] = $row->purchase_date;
                                       $output['grand_total'] = $row->grand_total;
                                    }  
                                   echo json_encode($output);  
        }
       public function fetch_purchaseProduct(){
                     $id = $_GET['id'];     
                     $data  =   $this->Product_model->fetch_purchaseProduct($id);
                     foreach($data as $row){ 
                                      $output['product_id'] = $row->product_id;  
                                      $output['qty'] = $row->qty;
                                      $output['price'] = $row->price;
                                    
                                    }  
                                   echo json_encode($output);  
            }
             function get_viewPurchase(){
                 $id = $_GET['id'];  
                $data4 = $this->Product_model->get_viewPurchase($id);
                foreach($data4->result() as $row){ 
                            $output ='<tr id="dynamic"><td><label class="control-label text-dark">Product Name</label><input  id="productName" name="productName[]" type="text" class="form-control form-control-sm productName" placeholder="Product Name"  data-pm="productName" value="'.$row->product_name.'" readonly /></td><td><label class="control-label text-dark">Product Code/SKU</label><input id="pcode" name="productCode" type="text" class="form-control form-control-sm"  placeholder="Product Code"  readonly value="'.$row->product_code.'" readonly/></td><td><label class="control-label text-dark">Quantity</label><input id="Quantity" name="Quantity[]" type="number"  class="form-control form-control-sm qty"   value="'.$row->qty.'" readonly/></td><td><label class="control-label text-dark">Price Per Unit </label><input name="Price[]" type="number" id="Price" class="form-control form-control-sm price"  placeholder="Price Per Unit" value="'.$row->price.'" readonly/></td><td style="display:none;"><label class="control-label text-dark">S Price</label><input name="SubPrice[]" type="text" class="form-control form-control-sm Subprice"  /></td></tr>';
                             }

                             echo $output;
                    }
         function get_viewPurchase1(){
                 $id = $_GET['id'];  
                $data4 = $this->Product_model->get_viewPurchase($id);
                foreach($data4->result() as $row){ 
                            $output ='<tr id="dynamic"><td><label class="control-label text-dark">Product Name</label><input  id="productName" name="productName[]" type="text" class="form-control form-control-sm productName" placeholder="Product Name"  data-pm="productName" value="'.$row->product_name.'" readonly /></td><td><label class="control-label text-dark">Product Code/SKU</label><input id="pcode" name="productCode" type="text" class="form-control form-control-sm"  placeholder="Product Code"  readonly value="'.$row->product_code.'" readonly/></td><td><label class="control-label text-dark">Quantity</label><input id="Quantity" name="Quantity[]" type="number"  class="form-control form-control-sm qty"   value="'.$row->qty.'" /></td><td><label class="control-label text-dark">Price Per Unit </label><input name="Price[]" type="number" id="Price" class="form-control form-control-sm price"  placeholder="Price Per Unit" value="'.$row->price.'"/></td><td style="display:none;"><label class="control-label text-dark">S Price</label><input name="SubPrice[]" type="text" class="form-control form-control-sm Subprice"  /></td></tr>';
                             }

                             echo $output;
                    }         

          
           
            public function Stocklist(){
             $id= $this->input->post('productId');      
            $response = array();
            $data = array(
            'category' => $this->input->post('category'),
            'sub_category' => $this->input->post('subcategory'),
            'product_name' => $this->input->post('product_name'),
            'intitial_stock' => $this->input->post('intitial_stock') 
            );
            $update = $this->Product_model->Stocklist($id,$data);
            if($update == true) {
            $response['success'] = true;
            $response['messages'] = 'Succesfully Added Stock';
            }
            else {
            $response['success'] = false;
            $response['messages'] = 'Error in the database while creating the Stock';            
            }
            echo json_encode($response);
            }
            public function out_stock1(){
            $response = array();
            $data = array(
            'student' => $this->input->post('Student'),
            'refno' => $this->input->post('refno'),
            'return_date' => $this->input->post('Return_date'),
            'clinical_visit' => $this->input->post('Clinical_vsit'),   
            'product_name' => implode(',',$this->input->post('productName')),   
            'product_code' => implode(',',$this->input->post('productCode')), 
            'Quantity' => implode(',',$this->input->post('Quantity'))
            );
            $create = $this->Product_model->create_outStock($data);
            //  echo $this->db->last_query(); 
            if($create == true) {
            $response['success'] = true;
            $response['messages'] = 'Succesfully Added';
            }
            else {
            $response['success'] = false;
            $response['messages'] = 'Error in the database while creating';            
            }
            echo json_encode($response);
            }
            public function editPruchase($id)
            {
            $response = array();
            if($id) {
            $data = array(

            'refno' => $this->input->post('refno'),
            'buyer' => $this->input->post('buyer'),
            'Bill_no' => $this->input->post('Bill_no'),
            'Voucher_no' => $this->input->post('Voucher_no'),
            'purchase_status' => $this->input->post('purchase_status'),
            'purchase_date' => $this->input->post('purchase_date'),   
            'productName' => implode(',',$this->input->post('productName')),   
            'productCode' => implode(',',$this->input->post('productCode')), 
            'Quantity' => implode(',',$this->input->post('Quantity')), 
            'Price' => implode(',',$this->input->post('Price')), 
            'total_price' => $this->input->post('total_price'),
            );
            $update = $this->Product_model->update($id, $data);
            if($update == true) {
            $response['success'] = true;
            $response['messages'] = 'Succesfully updated';
            }
            else {
            $response['success'] = false;
            $response['messages'] = 'Error in the database while updated the brand information';          
            }
            }
            else {
            $response['success'] = false;
            $response['messages'] = 'Error please refresh the page again!!';
            }
            //$response['success'] = $id;
            echo json_encode($response);
            }
            
            public function edit_Stock($id)
            {
            $response = array();
            if($id) {
            $data = array(
            'student' => $this->input->post('Student'),
            'refno' => $this->input->post('refno'),
            'return_date' => $this->input->post('Return_date'),
            'clinical_visit' => $this->input->post('Clinical_vsit'),   
            'product_name' => implode(',',$this->input->post('productName')),   
            'product_code' => implode(',',$this->input->post('productCode')), 
            'Quantity' => implode(',',$this->input->post('Quantity')),
            'return_qty' => implode(',',$this->input->post('return_qty'))
            );
            $update = $this->Product_model->update_stock($id, $data);
            if($update == true) {
            $response['success'] = true;
            $response['messages'] = 'Succesfully updated';
            }
            else {
            $response['success'] = false;
            $response['messages'] = 'Error in the database while updated the brand information';          
            }
            }
            else {
            $response['success'] = false;
            $response['messages'] = 'Error please refresh the page again!!';
            }
            echo json_encode($response);
            }
            
            public function userList1(){
            $this->load->view('admin/user_view');
            // POST data
            $postData = $this->input->post();
            // Get data
            $data = $this->User_model1->getUsers($postData);
            // echo $this->db->last_query(); 
            echo json_encode($data);
            }
            public function userList(){
            // POST data
            $postData = $this->input->post();
            // Get data
            $data = $this->Product_model->getUsers($postData);
            echo json_encode($data);
            }
           

            
             function fetch_stockout(){
                     $id = $_GET['id'];     
                     $data  =   $this->Product_model->fetch_stockout($id);
                     foreach($data as $row){ 
               $data1 =  $this->db->query("SELECT * FROM `user` WHERE `user_id`='".$row->user_id."'")->row_array();
               $data2 =  $this->db->query("SELECT * FROM `purpose` WHERE `purpose_id`='".$row->purpose_id."'")->row_array();       
               $user =$data1['first_name'].''.$data1['last_name'];

                                      $output['refno'] = $row->refno;  
                                      $output['status'] = $row->status;
                                      $output['return_date'] = $row->return_date;
                                      $output['description'] = $row->description;
                                      $output['user'] = $user;
                                      $output['purpose'] = $data2['purpose'];
                                    
                                    }  
                                   echo json_encode($output);  
            }


              public function edit_Product($id){
                 
                $response = array();
                $refno =  $this->input->post('refno');
                $pStatus =  $this->input->post('purchase_status');
                $pdate = $this->input->post('purchase_date');   
                $gPrice = $this->input->post('total_price');
                $create = $this->db->query("UPDATE `purchase` SET `purchase_status`='".$pStatus."',`purchase_date`='".$pdate."',`grand_total`='". $gPrice."' WHERE purchase_id='".$id."'");
            

               $purchase_id = $this->db->query("SELECT `purchase_id` FROM `purchase` WHERE `refno`='".$refno."'")->row_array();
               $prcID = $purchase_id['purchase_id'];
               $purchase_item_id =    implode(',',$this->input->post('purchase_item_id')); 
               $productId =    implode(',',$this->input->post('productId')); 
               $Quantity =     implode(',',$this->input->post('Quantity'));
               $Price =       implode(',',$this->input->post('Price'));
               $pname =       implode(',',$this->input->post('pname'));
               
               $pro_id = explode(",",$productId);
               $pro_qty = explode(",",$Quantity);
               $pro_price = explode(",",$Price);
               $pro_name = explode(",",$pname);
               $purchase_id =  explode(",",$purchase_item_id);

                 $total_proId = count($pro_id);
                 for($y=0;$y<$total_proId;$y++){
                      if ($pro_name[$y] == 0) {
                       $data = $this->db->query("UPDATE `purchase_item` SET `qty`='".$pro_qty[$y]."',`price`='".$pro_price[$y]."' WHERE purchase_item_id = '".$purchase_id[$y]."'");
                      }elseif($pro_name[$y] == 1){
                 $dat1 = $this->db->query("INSERT INTO `purchase_item`(`purchase_id`, `product_id`, `qty`, `price`) VALUES ('".$prcID."','".$pro_id[$y]."','".$pro_qty[$y]."','".$pro_price[$y]."')");
                  }
                 }
           if($create == true){
            $response['success'] = true;
            $response['messages'] = 'Succesfully updated';
           }
       
              echo json_encode($response);
             }
            public function edit_outstock($id){
                 

                $refno =  $this->input->post('refno');
               // $  $this->input->post('buyer');
               // $ $this->input->post('Bill_no');
             // $ $this->input->post('Voucher_no');
              $pStatus =  $this->input->post('Status');
             $pdate = $this->input->post('Return_date');   
             //$re= $this->input->post('Returned_Quantity');
             
           $create = $this->db->query("UPDATE `outstock` SET `status`='".$pStatus."',`return_date`='".$pdate."' WHERE outstock_id='".$id."'");
            // $response = array();
            // $data = array(
            // 'refno' => $this->input->post('refno'),
            // 'buyer' => $this->input->post('buyer'),
            // 'Bill_no' => $this->input->post('Bill_no'),
            // 'Voucher_no' => $this->input->post('Voucher_no'),
            // 'purchase_status' => $this->input->post('purchase_status'),
            // 'purchase_date' => $this->input->post('purchase_date'),   
            //  'grand_total' =>  $this->input->post('total_price')
            
            // );
            // $create = $this->Product_model->create_purchase($data);
            // if($create == true) {
            // $response['success'] = true;
            // $response['messages'] = 'Succesfully Added Product';
            // }
            // else {
            // $response['success'] = false;
            // $response['messages'] = 'Error in the database while creating the Product';            
            // }
           // $refno = $this->input->post('refno');
            //echo json_encode($response);
         //     echo   $refno = $this->input->post('refno');
         //   echo $buyer = $this->input->post('buyer');
         //  echo  $Bill_no = $this->input->post('Bill_no');
         //  echo  $Voucher_no = $this->input->post('Voucher_no');
         // echo   $purchase_status = $this->input->post('purchase_status');
         //  echo  $purchase_date = $this->input->post('purchase_date');  
         //       $total_price =  $this->input->post('total_price');

             $outstock_id = $this->db->query("SELECT `outstock_id` FROM `outstock` WHERE `refno`='".$refno."'")->row_array();
                   $oID = $outstock_id['outstock_id'];
               echo    $return =    implode(',',$this->input->post('Returned_Quantity')); 
              echo     $oItemId =     implode(',',$this->input->post('outstock_item_id'));
               
               
                    $out_rtn= explode(",",$return);
                 $out_itemID = explode(",",$oItemId);
              

                  $total = count($out_itemID);
              for($y=0;$y<$total;$y++){
             
       $dat1 = $this->db->query("UPDATE `outstock_item` SET `return_qty`='".$out_rtn[$y]."' WHERE `outstock_item_id`='".$out_itemID[$y]."'");


                }
       




            }
      //       public function fetchTableData1()
      //      {
      //       $result = array('data' => array());
            
      //       $data = $this->Product_model->getTableData_stockList();
      //            foreach ($data as $key => $value) {
      //                    $buttons = '';
                        
      //                   //$status = $value['status'];
               
      //                   $buttons = '<button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
                  

                  
      //                   $buttons .= ' <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
      //                   $result['data'][$key] = array(
      //                   $value['product_id'], 
      //                   $value['product_name'],
      //                   $value['intitial_stock'],
      //                   $value['w'],
      //                   $value['we'],

                       
      //                   $buttons
                        
      //             );
      //       } // /foreach

      //       echo json_encode($result);
      // }
          public function fetchTableData1(){
             $result = array('data' => array());
            $data = $this->db->query("SELECT * FROM `product`");
            foreach ($data->result() as $row) {
                                      $output['product_id'] = $row->product_id;  
                                      $output['product_name'] = $row->product_name;
                                      $output['intitial_stock'] = $row->intitial_stock;
                                    
            }
             echo json_encode($output);
            
          }  
            public function out_stock(){
            $response = array();
            $data = array(
            'refno' => $this->input->post('refno'),
            'user_id' => $this->input->post('user_id'),
            'purpose_id' => $this->input->post('Clinical_vsit'),
            'status' => $this->input->post('Status'),
            'return_date' => $this->input->post('Return_date'),
            'description' => $this->input->post('description') 
            );
            $create = $this->Product_model->outstock($data);
            if($create == true) {
            $response['success'] = true;
            $response['messages'] = 'Succesfully Added';
            }
            else {
            $response['success'] = false;
            $response['messages'] = 'Error in the database while creating';            
            }
            $refno = $this->input->post('refno');
          

            $outstock_id = $this->db->query("SELECT `outstock_id` FROM `outstock` WHERE `refno`='".$refno."'")->row_array();
               $oStockID = $outstock_id['outstock_id'];

               $productId =    implode(',',$this->input->post('productId')); 
               $Quantity =     implode(',',$this->input->post('Quantity'));
               
               
               $pro_id = explode(",",$productId);
               $pro_qty = explode(",",$Quantity);
              

                 $total_proId = count($pro_id);
               for($y=0;$y<$total_proId;$y++){
                                 
                  $dat1 = $this->db->query("INSERT INTO `outstock_item`(`outstock_id`, `product_id`, `qty`) VALUES ('".$oStockID."','".$pro_id[$y]."','".$pro_qty[$y]."')");


               }
               echo json_encode($response);
           }
           function search_qty(){
            $output = array();  
            $a =  $_POST["qty"];
            $b = $_POST["pId"];
          //  SELECT sum(`qty`)-SUM(`return_qty`) AS 'return' FROM `outstock_item` WHERE `product_id`=2
         // SELECT intitial_stock, `intitial_stock`-(SELECT sum(`qty`)-SUM(`return_qty`)   FROM `outstock_item` GROUP BY product_id) AS 'stock' FROM `product` 

            //SELECT  sum(`qty`)-SUM(`return_qty`)   FROM `outstock_item` GROUP BY product_id
          $data=  $this->db->query("SELECT `intitial_stock`-(SELECT sum(`qty`)-SUM(`return_qty`)   FROM `outstock_item` WHERE `product_id`='".$b."') AS 'stock' FROM `product` WHERE `product_id`='".$b."'")->row_array();
            $output['stock'] = $data['stock'];
           // $output['db'] = $this->db->last_query();
            echo json_encode($output);  
           }


       

                   
           
           
       }