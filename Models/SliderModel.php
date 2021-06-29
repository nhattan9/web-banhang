<?php


class SliderModel extends BaseModel{
    const TABLE="slider";
  

    public function getAll($select=['*'], $orderBys = [],$limit=15){
        return $this->all(self::TABLE, $select,$orderBys, $limit);
  
      }
      public function getSlider(){
          $sql = "SELECT * FROM ".self::TABLE." WHERE status = 0 ORDER BY order_slider ASC";
          $result = $this->getByQuery($sql);
          return $result;

      }
      public function store($data){
        $kq= $this->create(self::TABLE,$data);
         if($kq==true){
             return '<div class="alert alert-success" role="alert">Thêm thành công</div>';
 
         }else{ return '<div class="alert alert-danger" role="alert">Thất bại</div>'; }
     }

     public function findById($id){
      return  $this->find(self::TABLE, $id);
    }
     public function deleteById($id){
      $kq=$this->delete(self::TABLE, $id);
      if($kq==true){
        return '<div class="alert alert-success" role="alert">Xóa thành công</div>';
      }else{  
         return '<div class="alert alert-danger" role="alert">Xóa thất bại</div>';
         }    
     }

      public function getById($id){
        $sql="SELECT order_details.*, product.thumbnail as product_thumbnail FROM order_details 
        JOIN product ON product.id = order_details.product_id
        WHERE order_id=$id";
        $result = $this->getByQuery($sql);
     
        return $result;
      }

      public function is_active($id){
        $sql ="UPDATE ". self::TABLE ." SET status=1 WHERE id=${id}";
        return $this->getByQuery($sql);

      }
      public function is_inactive($id){
        $sql ="UPDATE ". self::TABLE ." SET status=0 WHERE id=${id}";
        return $this->getByQuery($sql);
     }



  
    
    

     
}