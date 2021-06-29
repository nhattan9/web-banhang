<?php


class OrderModel extends BaseModel{
    const TABLE="orders";
  

    public function getAll($select=['*'], $orderBys = [],$limit=15){
        return $this->all(self::TABLE, $select,$orderBys, $limit);
  
      }
   
      public function findById($id){
       return $this->find(self::TABLE,$id);
      }
 



    public function store($input){
        // echo "<pre>";
        // var_dump($input);
        // die();
        return $orderId= $this->create(self::TABLE,[
              'code'         =>rand(100,10000000),
              'user_id'=>$input['user_id'],
              'total'=>$input['total_price'],
              'customer_name'=>$input['customer_name'],
              'customer_email'=>$input['customer_email'],
              'customer_phone'=>$input['customer_phone'],
              'customer_address'=>$input['customer_address'],
              'matp'=>$input['matp'],
              'maqh'=>$input['maqh'],
              'xaid'=>$input['xaid'],


              'created_at'=> date('Y-m-d H:i:s')

         ]);
       
    }

    public function storeOrderDetails($input){
        $this->create('order_details',[
            'order_id'         =>$input['order_id'],
            'product_id'=>$input['product_id'],
            'product_name'=>$input['product_name'],
            'product_price'=>$input['product_price'],
            'product_qty'=>$input['product_qty'],
            'product_size'=>$input['product_size']

       ]);
    }

//TABLE = ORDER_DETAIL
public function getById($id){
  $sql="SELECT order_details.*, product.thumbnail as product_thumbnail FROM order_details 
  JOIN product ON product.id = order_details.product_id
  WHERE order_id=$id";
  $result = $this->getByQuery($sql);

  return $result;
}
   
// GET ADDRESSS
 public function getCity($matp){
         $sql = "SELECT * FROM tbl_tinhthanhpho WHERE matp = ${matp} LIMIT 1";
         return $this->getFirstByQuery( $sql);

 }
 public function getQuanHuyen($maqh){
          $sql = "SELECT * FROM tbl_quanhuyen WHERE maqh = ${maqh} LIMIT 1";
          return $this->getFirstByQuery( $sql);
 }
 public function getXa($xaid){
  $sql = "SELECT * FROM tbl_xaphuongthitran WHERE xaid = ${xaid} LIMIT 1";
  return $this->getFirstByQuery( $sql);
}
 public function getStatus(){
  $sql="SELECT *  FROM status ";
  $result = $this->getByQuery($sql);
  return $result;
  }

  public function updateData($id, $data){
    $kq=$this->update(self::TABLE,$id,$data);
    if($kq==true){
        return '<div class="alert alert-success" role="alert">Cập nhật thành công</div>';

    }else{ return '<div class="alert alert-danger" role="alert">Thất bại</div>'; }
}


  public function deleteById($id){
  $kq=$this->delete(self::TABLE, $id);
  if($kq==true){
    echo '<div class="alert alert-success" role="alert">Xóa thành công</div>';
  }else{  
     echo '<div class="alert alert-danger" role="alert">Xóa thất bại</div>';
     }
}
public function deleteOrderDetails($id){
  $sql ="DELETE FROM order_details WHERE order_id =${id}";
  $this->_query($sql);
  
}

public function getPendingOrder(){
   $sql="SELECT *  FROM ".SELF::TABLE." WHERE status = 0 ";
    return $this->getByQuery( $sql);
  
}

public function getCancelledOrder(){
  $sql="SELECT * FROM ".SELF::TABLE." WHERE status = 3 ";
   return $this->getByQuery( $sql);
 
}
public function getProcessOrder(){
   $sql="SELECT * FROM ".SELF::TABLE." WHERE status = 1 ";
    return $this->getByQuery( $sql);
  
}
public function getDeliveriedOrder(){
  $sql="SELECT * FROM ".SELF::TABLE." WHERE status = 2 ";
   return $this->getByQuery( $sql);
 
}

public function getCounters(){
  $index = array('process'=>0,'shipping'=>1,'delivered'=>2,'cancel'=>3);
  $count=[];
  foreach ($index as $key=>$value) {
    $sql="SELECT COUNT(id) AS numberOfOrder FROM ".SELF::TABLE." where status = $value";
    $count[$key]=$this->getFirstByQuery( $sql);
    }
    return $count;

}
    

     
}