<?php
class ProductController extends BaseController{
  
   private $categoryModel;
    private $productModel;
    private $attributeModel;


    public function __construct(){
        $this->loadModel('CategoryModel');
        $this->loadModel('ProductModel');
        $this->loadModel('AttributeModel');



        $this->categoryModel = new CategoryModel;
        $this->productModel = new ProductModel;
        $this->attributeModel = new AttributeModel;




    }
  public function getDetail(){
   $productId=$_GET['id'] ?? null;
   $product = $this->productModel->getDetails($productId);
   //related pro
   $productById = $this->productModel->getByCategoryId($product['cate_id'],$productId);
   $category= $this->categoryModel->getAllCateActive();

   $attr=$this->attributeModel->findProId($productId);

     
   $this->view('masterlayout',[
      'page' =>"product_detail",
      'category' =>$category,
      'product' =>$product,
      'productById' =>$productById,
      'attr' =>$attr
  ]);
      

  }
     public function show(){


       $productId=$_GET['id'] ?? null;
       
       $product = $this->productModel->getDetails($productId);
       //truyen id de lay ra san pham lien quan thi loại bo sp trung id đi
       $productById = $this->productModel->getByCategoryId($product['id_category'],$productId);
       $category= $this->categoryModel->getAll();
      //var_dump($product);

    
       $this->view('masterlayout',[
         'page' =>"product_detail",
         'category' =>$category,
         'product' =>$product,
         'productById' =>$productById
     ]);
         
     }
    
}