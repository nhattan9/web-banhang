<?php
class CategoryController extends BaseController{
    private $categoryModel;
    private $productModel;

    public function __construct(){
        $this->loadModelInAdmin('CategoryModel');
        $this->loadModelInAdmin('ProductModel');

        $this->categoryModel = new CategoryModel;
        $this->productModel = new ProductModel;
    }

     public function index(){
         $params = $_GET;
     
         //neu khong nhap gias tri gif vao fileter se lay ra  all
         $category=!$params ? $this->categoryModel->getAll()
         : $this->categoryModel->search($params) ;


        $this->view('masterlayout',[
            'page' =>"category_view",
            'category' =>$category
        ]);  
     }

     public function delete(){
        $id=$_POST['id'];
        $this->categoryModel->deleteById($id);
        
     
    }
 // edit && add 

     public function add_category(){
         
         $status = isset($_POST['active']) ? ($_POST['active']) : '1' ;
         $data =[];
         $created_at = $updated_at = date('Y-m-d H:i:s');
         if(isset($_POST['add_cate'])){
             $data=[
                  "name"=>$_POST['cate_name'],
                  "parent_id"=>$_POST['cate_parent'],
                  "status"=> $status,
                  "created_at"=>$created_at,
                  "updated_at"=>$updated_at
             ];
         $msg=$this->categoryModel->store($data);

         }
         
         $category=$this->categoryModel->getAll();
         $this->view('masterlayout',[
            'page' =>"add_category",
            'category' =>$category,
            'msg' =>$msg ?? ""
         
        ]);  
       
     }
     public function edit(){
         $categoryId=$_GET['id'];
         $categoryById=$this->categoryModel->getByCategoryId($categoryId);
         $category=$this->categoryModel->getAll();


         $data =[];
         $status = isset($_POST['active']) ? ($_POST['active']) : '1' ;
         $created_at = $updated_at = date('Y-m-d H:i:s');

         if(isset($_POST['cate_name'])){
            $data=[
                "name"=>$_POST['cate_name'],
                "parent_id"=>$_POST['cate_parent'],
                "status"=>$status,
                "created_at"=>$created_at,
                "updated_at"=>$updated_at
           ];
        $msg=$this->categoryModel->updateData($categoryId,$data);
        header("Location:?controller=category");
        }
         $this->view('masterlayout',[
            'page' =>"edit_category",
            'category' =>$category,
            'categoryById'=>$categoryById
        ]);  
     }
     public function update(){
        $data =[];
        $id=$_POST['cate_id'];
        $status = isset($_POST['active']) ? ($_POST['active']) : '1' ;
        $created_at = $updated_at = date('Y-m-d H:i:s');
        if(isset($_POST['cate_name'])){
            $data=[
                "name"=>$_POST['cate_name'],
                "parent_id"=>$_POST['cate_parent'],
                "status"=>$status,
                "created_at"=>$created_at,
                "updated_at"=>$updated_at
           ];
        }
        $msg=$this->categoryModel->updateData($categoryId,$data);
        $category=$this->categoryModel->getAll();
        $this->view('masterlayout',[
           'page' =>"category_view",
           'category' =>$category,
           'msg' =>$msg
       ]);  
     }
     public function is_active(){
        $id=$_POST['id'];
        $this->categoryModel->is_active($id);
        
     }
     public function  is_inactive(){
        $id=$_POST['id'];
        $this->categoryModel->is_inactive($id);
        
     }
    
}