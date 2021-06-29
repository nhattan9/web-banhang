<?php
class OrderController extends BaseController{
    private $categoryModel;
    private $productModel;
    private $userModel;
    private $orderModel;
    // private $orderDetailModel;


    public function __construct(){
        $this->loadModelInAdmin('CategoryModel');
        $this->loadModelInAdmin('ProductModel');
        $this->loadModelInAdmin('UserModel');
        $this->loadModelInAdmin('OrderModel');
        // $this->loadModelInAdmin('OrderDetailModel');



        $this->categoryModel = new CategoryModel;
        $this->productModel = new ProductModel;
        $this->userModel = new UserModel;
        $this->orderModel = new OrderModel;
        // $this->orderDetailModel = new OrderDetailModel;

    }

    public function index(){
        
        $selectColumn =['id','code','payment_method','delivery_date','status','total','created_at'];
        $orderby = ['column' => 'created_at', 'type' =>"desc"];

        $order_list=$this->orderModel->getAll($selectColumn,$orderby);
        // echo '<pre>';
        // print_r($order_list);

        $this->view('masterlayout',[
              'page' =>'order_view',
              'order_list' =>$order_list
        ]);


    }
    public function delete(){
        $id=$_POST['id'];
        // xóa bnagr order detail truoc
        $this->orderModel->deleteOrderDetails($id);
        $this->orderModel->deleteById($id);
    }

     
   
}