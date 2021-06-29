<?php
 require_once ROOT.'/helpers/library.php';
 require_once ROOT.'/helpers/FlashMessages.php';
class ProductController extends BaseController{
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
       $params['page'] = '{page}';
	   	
		   $link = Library::createLink("", $params);
      
      //  die();
      // $productId=$_GET['id'] ?? null;
      // $category=$this->categoryModel->getAll();

       //neu khong nhap gias tri gif vao fileter se lay ra  all
       $product=!$params ? $this->productModel->getAllWithCategory() : 
       $this->productModel->search($params) ;

       $page = isset($_GET['page'])? $_GET['page']:1;

		   $paging = Library::paging($link, $product, $page, 5);
       
       $context=[];
       $context["paging"] = $paging["html"];
	   	 $context["products"] = [];
	   	if (count($paging["data"]) >= $page) {
	  		$context["products"] = $paging["data"][$page-1];
	    	}
     
       $category=$this->categoryModel->getAll();

      //  var_dump($context["products"]);


        $this->view('masterlayout',[
            'page' =>"product_view",
            'products' =>$context["products"],
            "category" =>$category,
            "paging" =>$context['paging']

            
        ]);  
     }
     public function delete(){
         $id=$_POST['id'];
         $product=$this->productModel->findById($id);
         $file=$product['thumbnail'];
         if(file_exists(UPLOAD_DIR.'/'.$file)){
          unlink(UPLOAD_DIR.'/'.$file);
         }

         if(isset($_POST['id'])){
             $this->productModel->destroy($id);
         }
    
     }
     public function add_product(){
    
      $selectColumn =['id','name','parent_id'];
      $category=$this->categoryModel->getAll( $selectColumn);

    

      //INSERT
      $data=[];
      $created_at = $updated_at = date('Y-m-d H:i:s');
      $feature = isset($_POST['feature']) ? $_POST['feature'] : "0";
      $bestseller = isset($_POST['bestseller']) ? $_POST['bestseller'] : "0";
     //  $img =$_FILES["anh"]["name"];
      
      if(isset($_POST['add_pro'])){
         // kiem gtra xem anh vua them da ton tai trong folder chua 
          $image=Library::uploadFiles($_FILES['anh'], UPLOAD_DIR);

          $data=[
           "name"=>$_POST["name"],
            "short_desc"=>$_POST["short-desc"],
            "thumbnail"=>$image,
            "cate_id "=>$_POST["cate"],
            "price"=>$_POST["price"],
            "sale_price"=>$_POST["sale"],
            "best_seller"=>$bestseller,
            "feature"=>$feature,
            "description"=>$_POST["desc"],
            "created_up"=> $created_at,
            "updated_at"=>$updated_at,
          ];

          if($image){
            $msg=$this->productModel->store($data);
          }
          
      }
           
           
           
            $selectColumn =['id','name','parent_id'];
            $category=$this->categoryModel->getAll( $selectColumn);
            $this->view('masterlayout',[
             'page' =>"add_product",
             'category' =>$category,
             'msg' => $msg ?? "",
            
         ]); 
     }

 

    //  public function insert(){
   
    //    $image=Library::uploadFiles($_FILES['anh'], UPLOAD_DIR);

    //    //INSERT
    //    $data=[];
    //    $created_at = $updated_at = date('Y-m-d H:i:s');
    //    $feature = isset($_POST['feature']) ? $_POST['feature'] : "0";
    //    $bestseller = isset($_POST['bestseller']) ? $_POST['bestseller'] : "0";
    //   //  $img =$_FILES["anh"]["name"];
       
    //    if(isset($_POST['submit'])){
    //        $data=[
    //         "name"=>$_POST["name"],
    //          "short_desc"=>$_POST["short-desc"],
    //          "thumbnail"=>$image,
    //          "cate_id "=>$_POST["cate"],
    //          "price"=>$_POST["price"],
    //          "sale_price"=>$_POST["sale"],
    //          "best_seller"=>$bestseller,
    //          "feature"=>$feature,
    //          "description"=>$_POST["desc"],
    //          "created_up"=> $created_at,
    //          "updated_at"=>$updated_at,
    //        ];
    //    }
            
    //         if($image){
    //           $msg=$this->productModel->store($data);
    //         }
            
    //          $selectColumn =['id','name','parent_id'];
    //          $category=$this->categoryModel->getAll( $selectColumn);
    //          $this->view('masterlayout',[
    //           'page' =>"add_product",
    //           'category' =>$category,
    //           'msg' => $msg
             
    //       ]); 
    //  }
    public function capnhat(){
      $path= $_SERVER['DOCUMENT_ROOT']."/PHP/web_banhang/public/uploads";
      $file=$_POST['thumbnail'];
      if(file_exists($path.$file)){
        chmod($path.$file, 0777);
         unlink($path.$file);
      }
    }
   

    public function edit(){
      $id=$_GET['id'];
      $productById=$this->productModel->getDetails($id);

      $selectColumn =['id','name','parent_id'];
      $category=$this->categoryModel->getAll( $selectColumn);

      $data=[];
      $created_at = $updated_at = date('Y-m-d H:i:s');
      $feature = isset($_POST['feature']) ? $_POST['feature'] : "0";
      $bestseller = isset($_POST['bestseller']) ? $_POST['bestseller'] : "0";

      if(isset($_POST['update_pro'])){
        if(!empty($_FILES["anh"]["name"])){

          $product=$this->productModel->findById($id);
          $file=$product['thumbnail'];
          if(file_exists(UPLOAD_DIR.'/'.$file)){
            unlink(UPLOAD_DIR.'/'.$file);
           // $file = post['thumbnail] thi se bi loi unlink nen file lay tu dâtabase
             }
    
           $image=Library::uploadFiles($_FILES['anh'], UPLOAD_DIR);
           if(isset($_POST) && !empty($_POST)){
            $data=[
             "name"=>$_POST["name"],
              "short_desc"=>$_POST["short-desc"],
              "thumbnail"=>$image,
              "cate_id "=>$_POST["cate"],
              "price"=>$_POST["price"],
              "sale_price"=>$_POST["sale"],
              "best_seller"=>$bestseller,
              "feature"=>$feature,
              "description"=>$_POST["desc"],
              "created_up"=> $created_at,
              "updated_at"=>$updated_at,
            ];
             $msg=$this->productModel->updateData($id,$data);
    
           }
    
        
            
      }//eidt ko chon anh 
      else{
          if(isset($_POST) && !empty($_POST) ){
              $data=[
              "name"=>$_POST["name"],
                "short_desc"=>$_POST["short-desc"],
                "cate_id "=>$_POST["cate"],
                "price"=>$_POST["price"],
                "sale_price"=>$_POST["sale"],
                "best_seller"=>$bestseller,
                "feature"=>$feature,
                "description"=>$_POST["desc"],
                "created_up"=> $created_at,
                "updated_at"=>$updated_at,
              ];
          }
          $msg=$this->productModel->updateData($id,$data);
        }
        
        header("Location: "."?controller=product");
      }
      
      $this->view('masterlayout',[
        'page' =>"edit_product",
        'category' =>$category,
        'productById' =>$productById
    ]);  
     }

  // public function update(){
  //   $id= $_GET['id'];
  //   $data=[];
  //   $created_at = $updated_at = date('Y-m-d H:i:s');
  //   $feature = isset($_POST['feature']) ? $_POST['feature'] : "0";
  //   $bestseller = isset($_POST['bestseller']) ? $_POST['bestseller'] : "0";
    


  //   if(!empty($_FILES["anh"]["name"])){

  //     $product=$this->productModel->findById($id);
  //     $file=$product['thumbnail'];
  //     if(file_exists(UPLOAD_DIR.'/'.$file)){
  //       unlink(UPLOAD_DIR.'/'.$file);
  //      // $file = post['thumbnail] thi se bi loi unlink nen file lay tu dâtabase
  //        }

  //      $image=Library::uploadFiles($_FILES['anh'], UPLOAD_DIR);
  //      if(isset($_POST) && !empty($_POST)){
  //       $data=[
  //        "name"=>$_POST["name"],
  //         "short_desc"=>$_POST["short-desc"],
  //         "thumbnail"=>$image,
  //         "cate_id "=>$_POST["cate"],
  //         "price"=>$_POST["price"],
  //         "sale_price"=>$_POST["sale"],
  //         "best_seller"=>$bestseller,
  //         "feature"=>$feature,
  //         "description"=>$_POST["desc"],
  //         "created_up"=> $created_at,
  //         "updated_at"=>$updated_at,
  //       ];
  //        $msg=$this->productModel->updateData($id,$data);

  //      }

    
        
  // }//eidt ko chon anh 
  // else{
  //     if(isset($_POST) && !empty($_POST) ){
  //         $data=[
  //         "name"=>$_POST["name"],
  //           "short_desc"=>$_POST["short-desc"],
  //           "cate_id "=>$_POST["cate"],
  //           "price"=>$_POST["price"],
  //           "sale_price"=>$_POST["sale"],
  //           "best_seller"=>$bestseller,
  //           "feature"=>$feature,
  //           "description"=>$_POST["desc"],
  //           "created_up"=> $created_at,
  //           "updated_at"=>$updated_at,
  //         ];
  //     }
  //     $msg=$this->productModel->updateData($id,$data);
      
  //   }
  //   header("Location: "."?controller=product"); 
  //   // $category = $this->categoryModel->getAll();
  //   // $products =$this->productModel->getAllWithCategory();
  //   // $this->view('masterlayout',[
  //   //     'page' =>"product_view",
  //   //     'products' =>$products,
  //   //     'category'=>$category,
  //   //     'msg' =>$msg
  //   //     ]);  
  // }

    
}