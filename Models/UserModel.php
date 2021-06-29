
<?php


class UserModel extends BaseModel{
    const TABLE="users";
    public function getAll($select=['*'], $orderBys = [],$limit=15){
      return $this->all(self::TABLE, $select,$orderBys, $limit);

    }

    public function register($input){
        $sql = "SELECT * FROM ". self::TABLE ." WHERE username = '".$input['username']."' OR email =  '".$input['email']."' ";
        $result = $this->getFirstByQuery($sql);
        
        // Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
         if ($result != NULL){
         
           $msg = '<div class="alert alert-info" role="alert">Bị trùng tên hoặc chưa nhập tên!</div>';
           return $msg;


            // Dừng chương trình
            die ();
            }
         else {
           $msg= $this->create(self::TABLE,$input);
            // $msg = '<div class="alert alert-success" role="alert">Đăng ký thành công!</div>';
            return $msg;
        
         }
        }

        public function login($adminUser,$adminPass){
        $sql = "SELECT * FROM ". self::TABLE ." WHERE username = '$adminUser' AND password =  '$adminPass'  LIMIT 1 ";
        $result = $this->getFirstByQuery($sql);
        return $result;
        }

        public function getCity(){
          $sql =  "SELECT * FROM tbl_tinhthanhpho  ORDER BY name_city ASC"; 
          return $this->getByQuery($sql);
        }
        public function getQuan($matp){
          $sql = "SELECT * FROM tbl_quanhuyen WHERE matp = ".$matp."  ORDER BY name_quanhuyen ASC"; 
          return  $this->getByQuery($sql);
        }
        public function getXa($maqh){
          $sql =  "SELECT * FROM tbl_xaphuongthitran WHERE maqh = ".$maqh."  ORDER BY name ASC"; 
          return $this->getByQuery($sql);
 
        }


}