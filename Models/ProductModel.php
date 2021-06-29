<?php


class ProductModel extends BaseModel{
    const TABLE="product";
    public function getAll($select=['*'], $orderBys = [],$limit=15){
      return $this->all(self::TABLE, $select,$orderBys, $limit);

    }

    public function findById($id){
        return  $this->find(self::TABLE, $id);
    }

    public function getDetails($id){
        $sql = "SELECT product.* , category.name as category_name FROM ". self::TABLE ."
                JOIN category ON category.id = product.cate_id
                WHERE product.id=${id}";
                return $this->getFirstByQuery($sql);
    }
    public function getAllWithCategory(){
        $sql = "SELECT product.* , category.name as category_name FROM ". self::TABLE ."
                JOIN category ON category.id = product.cate_id";
                return $this->getByQuery($sql);
    }
    
    

    public function store($data){
       $kq= $this->create(self::TABLE,$data);
        if($kq==true){
            return '<div class="alert alert-success" role="alert">Thêm thành công</div>';

        }else{ return '<div class="alert alert-danger" role="alert">Thất bại</div>'; }
    }

    public function updateData($id, $data){
        $kq=$this->update(self::TABLE,$id,$data);
        if($kq==true){
            return '<div class="alert alert-success" role="alert">Thêm thành công</div>';

        }else{ return '<div class="alert alert-danger" role="alert">Thất bại</div>'; }
    }

    //xoa 
    public function destroy($id){
        $this->delete(self::TABLE,$id);
    }

    public function getByCategoryId($categoryId,$productId=null){
       $sql ="SELECT * FROM ". self::TABLE ." WHERE cate_id=${categoryId}";
    
       if($productId){
// khi lay nhung spham lien quan thi bo cai san pham đa show ra
       $sql ="SELECT * FROM ". self::TABLE ." WHERE cate_id=${categoryId} and id != ${productId}";
 
       }
       return $this->getByQuery($sql);
    }

    public function search ( array $input){
        $sql ="SELECT * FROM " . self::TABLE . " ";
        
        if(!empty($input['product_name'])){
            $whereName = " name LIKE '%".$input['product_name']."%'";
            $sql .= " WHERE $whereName";
       
        }

        $wherePriceCheck = false;
        if(!empty($input['start_price']) && !empty($input['end_price'])){
            
            $wherePriceCheck = true;

            $wherePrice = 'price >= '.$input['start_price']. ' AND price <='.$input['end_price'];
            if (empty($input['product_name'])){
                $sql .= " WHERE ${wherePrice}";
            }else{
                $sql .= " AND ${wherePrice}" ;}
        }
        if(!empty($input['category_id']))
        {
            $whereCategory = "id_category = ".$input['category_id'];
            
            if(!empty($input['product_name']) || $wherePriceCheck ){
                $sql .= " AND $whereCategory";
            };

            if(empty($input['product_name']) && !$wherePriceCheck){
                $sql .= " WHERE $whereCategory";
            }
        
        }
    //   echo $sql;
    //   die();
       
        return $this->getByQuery($sql);
    }

    public function getBestSeller(){
        $sql = "SELECT * FROM ". self::TABLE ."  WHERE best_seller = 1 LIMIT 8";
        return $this->getByQuery($sql);
    }

    
}