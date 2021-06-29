<?php 
 require_once ROOT.'/helpers/library.php';

   class AttributeController extends BaseController{
      private $productModel;
      private $categoryModel;
      private $attributeModel;



    public function __construct(){
        $this->loadModelInAdmin('CategoryModel');
        $this->loadModelInAdmin('ProductModel');
        $this->loadModelInAdmin('AttributeModel');


        $this->categoryModel = new CategoryModel;
        $this->productModel = new ProductModel;
        $this->attributeModel = new AttributeModel;

    }
   
     public function index(){
         $id=$_GET['id'];
         $attr=$this->attributeModel->getDetails($id);
         $product=$this->productModel->findById($id);
         $this->view('masterlayout',[
             "page"=>"attribute",
             "product"=>$product,
              "attr"=>$attr
          ]);
     }
     public function add(){
        
       $data=[];
       $image=[];
       $size=$_POST['size'];
       $id= $_POST['pro_id'];
    //    foreach($_FILES['image']['name'] as $key => $value){
    //     $created_at = $updated_at = date('Y-m-d H:i:s');
    //     $image=[
    //         "name"=>$_FILES['image']['name'][$key],
    //         "tmp_name"=>$_FILES['image']['tmp_name'][$key],
    //         "error"=>$_FILES['image']['error'][$key],
    //         "size"=>$_FILES['image']['size'][$key]
    //       ];
    //     // var_dump($image);echo $key;
        
    //      $upload=Library::uploadFiles($image, UPLOAD_DIR);
         
    //    }
     
      
      
        foreach($size as $key => $value){

            if($_POST['size'][$key]=="" || $_POST['color'][$key] =="" || $_FILES['image']['name'][$key] =="" || $_POST['stock'][$key]==""){
                echo " Vui lòng điền đầy đủ ";
                
            }else{
                $created_at = $updated_at = date('Y-m-d H:i:s');
                $image=[
                    "name"=>$_FILES['image']['name'][$key],
                    "tmp_name"=>$_FILES['image']['tmp_name'][$key],
                    "error"=>$_FILES['image']['error'][$key],
                    "size"=>$_FILES['image']['size'][$key]
                  ];
                  var_dump($image);echo $key;
                   $upload=Library::uploadFiles($image, UPLOAD_DIR);
             
                if(isset($_POST)){
                    $data=[
                      "color"=>$_POST["color"][$key],
                      "image"=>$upload,
                      "size"=>$value,
                      "stock "=>$_POST["stock"][$key],
                      "product_id"=>$id,
                      "created_at"=> $created_at,
                      "updated_at"=>$updated_at,
                    ];
                }
                var_dump($data);
            
               $kq= $this->attributeModel->store($data);
               echo $kq;
                
            }
           
       }
  
     }
    

   public function delete(){
       $id=$_POST['id'];
       $attri=$this->attributeModel->findById($id);
       $file=$attri['image'];
       if(file_exists(UPLOAD_DIR.'/'.$file)){
        unlink(UPLOAD_DIR.'/'.$file);
       }


       $this->attributeModel->destroy($id);
       echo " xoa thanh cong ";
   }


   }