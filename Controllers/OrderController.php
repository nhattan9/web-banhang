<?php
class OrderController extends BaseController{
    private $categoryModel;
    protected $orderModel;
    private $userModel;


    public function __construct(){
        $this->loadModel('OrderModel');
        $this->loadModel('CategoryModel');
        $this->loadModel('UserModel');


        $this->categoryModel = new CategoryModel;
        $this->orderModel = new OrderModel;
        $this->userModel = new UserModel;

    }
    public function index(){
        echo __METHOD__;
    }
    // public function store(){
    //     if(!empty($_SESSION['cart'])){
    //         $order = $this->orderModel->store($_POST);
    //         foreach($_SESSION['cart'] as $product){
    //          $this->orderModel->storeOrderDetails([
    //             'order_id'         =>$order['id'],
    //             'product_id'=>$product['id'],
    //             'product_name'=>$product['name'],
    //             'product_price'=>$product['price'],
    //             'product_qty'=>$product['qty'],

    //          ]);

    //         }
    //         unset($_SESSION['cart']);
    //         header('location:index.php?controller=cart');

    //     }
        
    // }

    public function checkout(){

        if(!empty($_SESSION['cart'])){
        $category=$this->categoryModel->getAllCateActive();
        $products = $_SESSION['cart'] ?? null;
        $cities=$this->userModel->getCity();
        

        if(isset($_POST['checkout'])){
            // if(!empty($_POST['customer_email']) || !empty($_POST['customer_phone']) || !empty($_POST['customer_name']) || !empty($_POST['customer_address']) || !empty($_POST['matp']) || !empty($_POST['maqh']) || !empty($_POST['xaid'])){
            //     $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">The fileds must not empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            //     return $msg;
            // }
             $order = $this->orderModel->store($_POST);
            foreach($_SESSION['cart'] as $product){
             $this->orderModel->storeOrderDetails([
                'order_id'         =>$order['id'],
                'product_id'=>$product['id'],
                'product_name'=>$product['name'],
                'product_price'=>$product['price'],
                'product_qty'=>$product['qty'],
                'product_size'=>$product['size']


             ]);

            }
            unset($_SESSION['cart']);
            unset($_SESSION['total']);

            header('location:index.php?controller=cart');


        }


        $this->view('masterlayout',[
            'page' =>"checkout",
            'category' =>$category,
            'cities' =>$cities,
            'products'=>$products

        ]);
    }else{
        header('Location:?controller=cart');
    }
        
     }


     public function getAddress(){
       

        if(!empty($_POST["matp"])){ 
            $matp=$_POST["matp"];
            // Fetch state data based on the specific country 
           $quan=$this->userModel->getQuan($matp);
    
            // Generate HTML of state options list 
            if($quan != NULL ){ 
                echo '<option value="">Quận/Huyện </option>'; 
                 foreach($quan as $quan){
                    echo '<option value="'.$quan['maqh'].'">'.$quan['name_quanhuyen'].'</option>'; 
                 }
                
            }else{ 
                echo '<option value="">Không có quận/huyện nào</option>'; 
            } 
        }elseif(!empty($_POST["maqh"])){ 
            $maqh=$_POST["maqh"];

            // Fetch city data based on the specific state 
            $xa=$this->userModel->getXa($maqh);

            // Generate HTML of city options list 
            if($xa != NULL ){ 
                echo '<option value=""> Xã/Phường/Thị Trấn </option>'; 
                 foreach($xa as $xa){
                    echo '<option value="'.$xa['xaid'].'">'.$xa['name'].'</option>'; 
                 }
                
            }else{ 
                echo '<option value="">Không có xã/thị trấn nào</option>'; 
            } 
        } 


     
     }
}