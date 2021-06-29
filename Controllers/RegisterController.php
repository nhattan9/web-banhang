<?php
   require_once ROOT.'/helpers/library.php';
   require_once ROOT.'/helpers/session.php';

 class RegisterController extends BaseController{
    private $categoryModel;
    private $productModel;
    private $userModel;
    private $fm;




    public function __construct(){
        $this->loadModel('CategoryModel');
        $this->loadModel('ProductModel');
        $this->loadModel('UserModel');



        $this->categoryModel = new CategoryModel;
        $this->productModel = new ProductModel;
        $this->userModel = new UserModel;
        $this->fm = new Library();


    }
     public function index(){
        $input=[];
        $category=$this->categoryModel->getAllCateActive();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
       
            $input['username']=isset($_POST['username']) ? $this->fm->validation($_POST['username']) : "";
            $input['password']=isset($_POST['password']) ? $this->fm->validation($_POST['password']) : "";
            $input['email']=isset($_POST['email']) ? $this->fm->validation($_POST['email']) : "";
            $input['phone']=isset($_POST['phone']) ? $this->fm->validation($_POST['phone']) : "";

            if ($input['username'] == "" ||$input['password'] == "" || $input['email'] == "" || $input['phone'] == "") {
                $msg = '<div class="alert alert-danger" role="alert">Files must be not empty</div>';
        
             }else{
                $msg= $this->userModel->register($input);
             }

             if(isset($msg['username'])  && isset($msg['password'])){
               
                $result=$this->userModel->login($msg['username'],$msg['password']);
                Session::set('userLogin',true);
                Session::set('userId',$result['id']);
                Session::set('userName',$result['username']);
                Session::set('userEmail',$result['email']);
                header('Location:?controller=home');

            }

        }

      

        $this->view('masterlayout',[
            'page' =>"register",
            'category' =>$category,
            'msg' =>$msg ?? "",
         
        ]);
        
     }

    //  public function submit(){
	// 	$msg = new \Plasticbrain\FlashMessages\FlashMessages();

        
    //     $input=[];
    //     if(isset($_POST)){
    //         $input['username'] = trim($_POST['username'] ?? "");
    //         $input['password'] = trim($_POST['password'] ?? "");
    //         $input['email'] = trim($_POST['email'] ?? "");
    //         $input['phone'] = trim($_POST['phone'] ?? "");

    //     }
    //     if ($input['username'] == "" ||$input['password'] == "" || $input['email'] == "" || $input['phone'] == "") {
    //         $msg = '<div class="alert alert-danger" role="alert">Files must be not empty</div>';
    
    //      }
    //      else{
    //            $msg= $this->userModel->register($input);
  
    //      }
  
        
    //        $category=$this->categoryModel->getAllCateActive();

    //         $this->view('masterlayout',[
    //             'page' =>"register",
    //             'category' =>$category,
    //             'msg' =>$msg
    //         ]);
           
       
    //  }


    
     

    
    
 }