<?php
 class BaseModel extends Database{
     private $connect;
      public function __construct(){
         $this->connect = $this->connect();
      }
 
    public function all($table, $select=['*'], $orderBys = [], $limit=15){
 
        $columns =implode(',',$select);
        $orderByString = implode(' ',$orderBys);
        //die($orderByString);
        if($orderByString){
        $sql = "SELECT ${columns} FROM ${table} ORDER BY ${orderByString} LIMIT ${limit}";
        
        }else{

        $sql = "SELECT ${columns} FROM ${table} LIMIT ${limit}";

        }
        //chuyen tu mang sang chuoi   
        $query = $this->_query($sql);
        $data = [];
        while($row = mysqli_fetch_assoc($query)){
            array_push($data,$row);
           
        }
        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';
        return $data;
    }
    //lấy ra nhiều bản ghi
    public function getByQuery($sql){
        $query = $this->_query($sql);
        $data = [];
        while($row = mysqli_fetch_assoc($query)){
            array_push($data,$row);
           
        }
        return $data;
    }
    //lấy ra 1 bản ghi

    public function getFirstByQuery($sql){
       
        $query = $this->_query($sql);
        return mysqli_fetch_assoc($query);
    }


    //Lay ra 1 ban ghi trong bang 
     public function find($table,$id){
         $sql = "SELECT * FROM ${table} WHERE id = ${id} LIMIT 1";
         $query = $this->_query($sql);
         return mysqli_fetch_assoc($query);
    }
    /**
     * Them du lieu vao bang
     */
    public function create($table,$data =[]){
          //chuyen key thanh mang 
          $columns = implode(',',array_keys($data)) ;
 
          
          // chuyen 'title', 'price' de them vao value sql;
          $newValue = array_map(function ($values){
              return "'".$values."'";
          }, array_values($data));
          $valueString = implode(',',array_values($newValue)) ;

          $sql ="INSERT INTO ${table}(${columns}) VALUES(${valueString})";
           $this->_query($sql);
          
           return $this->getFirstByQuery("SELECT * FROM ${table} ORDER BY ID DESC LIMIT 1");
          
         
    }

    public function update($table, $id,$data){
          $dataSets = [];
          foreach($data as $key => $val){
           array_push($dataSets,"${key} = '".$val."'");
          }
          $dataString=implode(",",$dataSets);
          $sql ="UPDATE ${table} SET ${dataString} WHERE id = ${id}";
          return $this->_query($sql);
         
    }
    public function delete($table,$id){
          $sql ="DELETE FROM ${table} WHERE id=${id}";
          return $this->_query($sql);
    }
    //thuc hien cau query
    // private function _query($sql){
    //    return mysqli_query($this->connect, $sql);
    // }
    public function _query($sql){
        return mysqli_query($this->connect, $sql);
     }
 }