<?php
class Product_model extends CI_Model{
      function __construct(){
      parent::__construct();
      $this->load->database();
      }
      public function search_Category($data = array()){
             $query = $this->db->get('product_category');
            return $query;
      }
      public function search_SubCategory($id){
             $this->db->select('*');
             $this->db->where("category_id",$id);
             $query = $this->db->get('product_subCategory');
             return $query;
      }
      public function get_autoProducts($postData){
             $response = array();
            if(isset($postData['search']) ){
            // Select record
            $this->db->select('*');
            $this->db->where("product_name like '%".$postData['search']."%' ");
            $records = $this->db->get('product')->result();
            foreach($records as $row ){
            $response[] = array("value"=>$row->product_code,"label"=>$row->product_name,"id"=>$row->product_id,"stock"=>$row->intitial_stock);
            }
            }
            return $response;
      }
      public function get_autoStudents($postData){
            $response = array();
            if(isset($postData['search']) ){
            // Select record
            $this->db->select('*');
            $this->db->where("first_name like '%".$postData['search']."%' OR last_name like '%".$postData['search']."%' ");
            $records = $this->db->get('user')->result();
            foreach($records as $row ){
            $fullname = $row->first_name.' '.$row->last_name;
            $response[] = array("value"=>$fullname,"label"=>$fullname,"id"=>$row->user_id);
            }
            }
            return $response;
      }
       // Inventory purchase
       public function create_product($data = array()){
             if($data) {
             $create = $this->db->insert('product', $data);
              return ($create == true) ? true : false;
      }
      }
      public function create_purchase($data = array()){
            if($data) {
            $create = $this->db->insert('purchase', $data);
            return ($create == true) ? true : false;
            }
      }
       function fetch_purchase($id){
        $this->db->where("purchase_id", $id);  
        $query=$this->db->get('purchase');  
        return $query->result(); 
    }
      public function fetch_purchaseID($refno){
             $this->db->select('purchase_id');
             $this->db->where("refno",$refno);
             $query = $this->db->get('purchase');
             return $query;
      }
       public function getData_PurchaseList(){
              $sql = "SELECT * FROM `purchase`";
              $query = $this->db->query($sql, array(1));
              return $query->result_array();
      }
       public function fetch_purchaseProduct($id){
        $this->db->where("purchase_id", $id);  
        $query=$this->db->get('purchase_item');  
        return $query->result(); 
       }
        
      // public function put_editPurchase($id,$pStatus,$pdate,$gPrice){
      //       $sql = "UPDATE `purchase` SET `purchase_status`='".$pStatus."',`purchase_date`='".$pdate."',`grand_total`='". $gPrice."' WHERE purchase_id='".$id."'";
      //       $query = $this->db->query($sql);
      //       return $query;
      // }
      // public function get_purchase_id($refno){
      //      $sql = "SELECT `purchase_id` FROM `purchase` WHERE `refno`='".$refno."'";
      //      $query = $this->db->query($sql)->row_array();
      //       return $query;
      // }

      public function fetchPro_editPurchase($id){
         $sql = $this->db->query("SELECT purchase_item.qty,purchase_item.price,purchase_item.purchase_item_id, product.product_code,product.product_name FROM product INNER JOIN purchase_item ON purchase_item.product_id=product.product_id WHERE purchase_item.purchase_id ='".$id."'");
         return $sql->result();
      }
     
      public function get_purchaseList(){
             $query = $this->db->get('purchase');
            return $query;
      } 
      public function insert_purchaseItem($data){
            $this->db->insert_batch('purchase_item', $data);
      }


      // 2 Inventory of Stock 
      
      public function outstock($data = array()){
      if($data) {
      $create = $this->db->insert('outstock', $data);
      return ($create == true) ? true : false;
      }
      }
       public function create_purchase1($data = array()){
      if($data) {
      $create1 = $this->db->insert('purchase_item', $data);
      return ($create1 == true) ? true : false;
      }
      }
      public function create_stock($data = array()){
      if($data) {
      $create = $this->db->insert('stock', $data);
      return ($create == true) ? true : false;
      }
      }
      public function create_outStock($data = array()){
      if($data) {
      $create = $this->db->insert('stock_history', $data);
      return ($create == true) ? true : false;
      }
      }
      function fetch_data($query)
      {
      $this->db->like('product_name', $query);
      $query = $this->db->get('product');
      if($query->num_rows() > 0)
      {
      foreach($query->result_array() as $row)
      {
      $output[] = array(
      'product_code'  => $row["product_code"],
      'product_name'  => $row["product_name"]
      );
      }
      echo json_encode($output);
      }
      }
      public function update($id = null, $data = array())
      {   
      $this->db->where('purchase_id', $id);
      $update = $this->db->update('purchase', $data);
      return ($update == true) ? true : false;
      }
      public function remove_purchase($id = null)
      {
      if($id) {
      $this->db->where('purchase_id', $id);
      $delete = $this->db->delete('purchase');
      return ($delete == true) ? true : false;
      }
      }
      public function update_stock($id = null, $data = array())
      {   
      $this->db->where('histroy_id', $id);
      $update = $this->db->update('stock_history', $data);
      return ($update == true) ? true : false;
      }
      public function remove_stock($id = null)
      {
      if($id) {
      $this->db->where('histroy_id', $id);
      $delete = $this->db->delete('stock_history');
      return ($delete == true) ? true : false;
      }
      }
      function getUsers($postData){
      $response = array();
      if(isset($postData['search']) ){
      // Select record
      $this->db->select('*');
      $this->db->where("username like '%".$postData['search']."%' ");
      $records = $this->db->get('users')->result();
      foreach($records as $row ){
      $response[] = array("value"=>$row->id,"label"=>$row->username);
      }
      }
      return $response;
      }
      

     
    
    function fetch_stockout($id){
        $this->db->where("outstock_id", $id);  
        $query=$this->db->get('outstock');  
        return $query->result(); 
    }
    public function Stocklist($id = null, $data = array())
      {           
            $this->db->where('product_id', $id);
            $update = $this->db->update('product', $data);

            return ($update == true) ? true : false;
      }
      public function getTableData_stockList()
      {
        $sql = "SELECT * FROM `product`";
        $query = $this->db->query($sql, array(1));
        return $query->result_array();
      }
     
      
}