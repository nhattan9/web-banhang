
<?php


class CategoryModel extends BaseModel{
    const TABLE="category";
    public function getAll($select=['*'], $orderBys = [],$limit=15){
      return $this->all(self::TABLE, $select,$orderBys, $limit);

    }
    public function getAllCateActive(){
        $sql ="SELECT * FROM ". self::TABLE ." WHERE status=0";
        return $this->getByQuery($sql);
    }
    public function findById($id){
        return  $this->find(self::TABLE, $id);
    }
    public function deleteById($id){
        $kq=$this->delete(self::TABLE, $id);
        if($kq==true){
            echo "Xóa thành công ";
        }else{   echo "Failed";}
       

        
    }
    public function store($data){
        $kq = $this->create(self::TABLE,$data);
        if($kq==true){
            return '<div class="alert alert-success" role="alert">Thêm thành công</div>';

        }else{ return '<div class="alert alert-danger" role="alert">Thất bại</div>'; }
      
    }
    public function updateData($id, $data){
        $kq=$this->update(self::TABLE,$id,$data);
        if($kq==true){
            return '<div class="alert alert-success" role="alert">Sửa thành công</div>';

        }else{ return '<div class="alert alert-danger" role="alert">Thất bại</div>'; }
    }
    public function getByCategoryId($categoryId){
        $sql ="SELECT * FROM ". self::TABLE ." WHERE id=${categoryId}";
        return $this->getByQuery($sql);
     }
     
     public function is_active($id){
        $sql ="UPDATE ". self::TABLE ." SET status=1 WHERE id=${id}";
        return $this->getByQuery($sql);
     }
     public function is_inactive($id){
        $sql ="UPDATE ". self::TABLE ." SET status=0 WHERE id=${id}";
        return $this->getByQuery($sql);
     }

     public function search ( array $input){
        $sql ="SELECT * FROM " . self::TABLE . " ";
        
        if(!empty($input['category_name'])){
            $whereName = " name LIKE '%".$input['category_name']."%'";
            $sql .= " WHERE $whereName";
       
        }
    //   echo $sql;
    //   die();
        return $this->getByQuery($sql);
    }
   
}
