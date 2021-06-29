<?php
require_once ROOT.'/helpers/FlashMessages.php';

 class HomeController extends BaseController{
    private $categoryModel;
    private $productModel;
    private $userModel;



    public function __construct(){
        $this->loadModel('CategoryModel');
        $this->loadModel('ProductModel');
        $this->loadModel('UserModel');
        $this->loadModel('SliderModel');

        $this->sliderModel = new SliderModel;
        $this->categoryModel = new CategoryModel;
        $this->productModel = new ProductModel;
        $this->userModel = new UserModel;

        



    }
     public function index(){
      
        $category=$this->categoryModel->getAllCateActive();
        $products=$this->productModel->getAllWithCategory();
        $best_seller=$this->productModel->getBestSeller();

        
        
        $sliders = $this->sliderModel->getSlider();
          
       
        $this->view('masterlayout',[
            'page' =>"home",
            'category' =>$category,
            'products' =>$products,
            'sliders' =>$sliders,
            'best_seller'=>$best_seller
        ]);
        
     }
     public function get(){
        $params = $_POST;

        $product=$this->productModel->search($params) ;
      
        $result='';

        if(!empty($product)){
            foreach($product as $pro){
                $result .= '
                <li class="flex-w flex-t p-b-30">
                <a href="?controller=product&action=getDetail&id='.$pro['id'].'" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                    <img src="'.STATIC_DIR.'uploads/'.$pro['thumbnail'].'" alt="PRODUCT" style="width:80px;">
                </a>

                <div class="size-215 flex-col-t p-t-8">
                    <a href="?controller=product&action=getDetail&id='.$pro['id'].'" class="stext-116 cl8 hov-cl1 trans-04">
                     '.$pro['name'].'
                    </a>

                    <span class="stext-116 cl6 p-t-20">
                    '.$pro['price'].'
                    </span>
                </div>
            </li>
                        ';
                }
                echo $result;
            }else{
                    echo "No products";
                };
     
     }

    


     public function register(){
        $category=$this->categoryModel->getAllCateActive();
        $cities=$this->userModel->getCountry();

        $this->view('masterlayout',[
            'page' =>"register",
            'category' =>$category,
            'cities' =>$cities
        ]);
     }

    
    
 }