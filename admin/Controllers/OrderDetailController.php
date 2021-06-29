<?php
class OrderDetailController extends BaseController{

    private $productModel;
    private $orderModel;


    public function __construct(){
    
        $this->loadModelInAdmin('ProductModel');
        $this->loadModelInAdmin('OrderModel');
        // $this->loadModelInAdmin('OrderDetailModel');



        $this->productModel = new ProductModel;
        $this->orderModel = new OrderModel;
        // $this->orderDetailModel = new OrderDetailModel;

    }

    public function index(){
        $id = $_GET['order_id'];
        $product_list = $this->orderModel->getById($id);
        $orderInfo = $this->orderModel->findById($id);
        $city = $this->orderModel->getCity($orderInfo['matp']);
        $quanhuyen = $this->orderModel->getQuanHuyen($orderInfo['maqh']);
        $xa = $this->orderModel->getXa($orderInfo['xaid']);
        $status =$this->orderModel->getStatus();
          $data= [];
          $msg='';
          if(isset($_POST['order_submit'])){
            $data=[
                'status'=>$_POST['status'],
                'delivery_date'=>$_POST['delivery_date']
            ];
            $msg =$this->orderModel->updateData($id,$data);
          }


 
   
        
        $this->view('masterlayout',[
              'page' =>'order_detail',
              'product_list'=>$product_list,
              'orderInfo'=>$orderInfo,
              'city'=>$city,
              'quanhuyen'=>$quanhuyen,
              'xa'=>$xa,
              'status'=>$status,
              'msg'=>$msg 

              
        ]);


    }

     
   
}