<?php
 require_once ROOT.'/helpers/library.php';

class CategoryController extends BaseController{
    private $categoryModel;
    private $productModel;

    public function __construct(){
        $this->loadModel('CategoryModel');
        $this->loadModel('ProductModel');

        $this->categoryModel = new CategoryModel;
        $this->productModel = new ProductModel;



    }
     public function index(){

         $params = $_GET;
         $params['page'] = '{page}';
            
         $id=$_GET['id'];
         $product=$this->productModel->getByCategoryId($id);
         $category=$this->categoryModel->getAllCateActive();
         $categoryById = $this->categoryModel->findById($id);

         $link = Library::createLink("", $params);

         $page = isset($_GET['page'])? $_GET['page']:1;

         $paging = Library::paging($link, $product, $page, 20);
     
          $context=[];
          $context["paging"] = $paging["html"];
          $context["products"] = [];
         if (count($paging["data"]) >= $page) {
            $context["products"] = $paging["data"][$page-1];
          }


         $this->view('masterlayout',[
                    'page' =>"product_view",
                    'category' =>$category,
                    'products' =>$context["products"],
                    'categoryById' =>$categoryById,
                     "paging" =>$context['paging']

                ]);

        
     }
     // them moi 
     public function store(){
       
     }
  

    //  public function show(){

    //       $categoryId=$_GET['id'] ?? null; 
    //       // XU LU FILTER
    //       $params = $_GET;
    //       $params['category_id'] = $categoryId;
    //      $category=$this->categoryModel->getAll();
         
    // // $category = $this->categoryModel->findById($categoryId);
    //      $product = !$params ? $this->productModel->getByCategoryId($categoryId) : $this->productModel->search($params);

    //      //  echo '<pre>';
    //     //  print_r($category);
    //     //  echo '<pre>';
    //     $this->view('masterlayout',[
    //         'page' =>"product_view",
    //         'category' =>$category,
    //         'product' =>$product
    //     ]);
        
    //  }
}