
<?php


class AttributeModel extends BaseModel{
    const TABLE="attribute";
    public function getAll($select=['*'], $orderBys = [],$limit=15){
      return $this->all(self::TABLE, $select,$orderBys, $limit);

    }

    public function findById($id){
        return  $this->find(self::TABLE, $id);
    }

    public function findProId($productId){
        $sql = "SELECT * FROM ". self::TABLE ." WHERE product_id=$productId";
    
        return $this->getByQuery($sql);

    }

    public function getDetails($id){
        $sql = "SELECT attribute.* , product.name as product_name FROM ". self::TABLE ."
                JOIN product ON product.id = attribute.product_id
                WHERE attribute.product_id=${id}";
                return $this->getByQuery($sql);
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
       $sql ="SELECT * FROM ". self::TABLE ." WHERE id_category=${categoryId}";
    
       if($productId){

       $sql ="SELECT * FROM ". self::TABLE ." WHERE id_category=${categoryId} and id != ${productId}";
 
       }
       return $this->getByQuery($sql);
    }



}