<?php

require_once ROOT.'/helpers/library.php';
require_once ROOT.'/helpers/session.php';

class LoginController extends BaseController{
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
  
    public function post() {
		$username = isset($_POST['username'])? $_POST['username']: "";
		$password = isset($_POST['password'])? $_POST['password']: "";
		$remember = isset($_POST['remember'])? $_POST['remember'] == "true": false;



              
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
       
            $username=$this->fm->validation($_POST['username']);
            $password=$this->fm->validation($_POST['password']);


           if( empty($username) || empty($password)){
                 echo json_encode(['message' => 'Tên đăng nhập và mật khẩu trống', 'status' => 0]);

           }else{
              
              $result=$this->userModel->login($username,$password);
              if($result != NULL){
         

                  Session::set('userLogin',true);
                  Session::set('userId',$result['id']);
                  Session::set('userName',$result['username']);
                  Session::set('userEmail',$result['email']);
                  Session::set('userPhone',$result['phone']);


                  
                  if(($_POST['remember']) == "true"){
                    setcookie("username", $username ,time() + (86400 * 30), "/");
                    setcookie("password", $password ,time() + (86400 * 30), "/");
                  }


                  echo json_encode(['message' => 'success', 'status' => 1]);


              }else{
                echo json_encode(['message' => 'Tên đăng nhập hoặc mật khẩu sai', 'status' => 0]);
              }
           }

        }


	}
    public function logout(){
         if(isset($_GET['userid'])){
             Session::destroy();
             header("Location:?controller=home");
         }
    }
     
   
}