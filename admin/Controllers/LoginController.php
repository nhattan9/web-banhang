<?php

require_once ROOT.'/helpers/library.php';
require_once ROOT.'/helpers/session.php';
Session::checkLogin();




class LoginController extends BaseController{
    private $categoryModel;
    private $productModel;
    private $userModel;


    private $fm;



    public function __construct(){
        $this->loadModelInAdmin('CategoryModel');
        $this->loadModelInAdmin('ProductModel');
        $this->loadModelInAdmin('UserModel');


        $this->categoryModel = new CategoryModel;
        $this->productModel = new ProductModel;
        $this->userModel = new UserModel;


        $this->fm = new Library();

    }
    // public function index(){
    //     $this->view('login');
    // }
    public function index(){
       
       
      
        
      
        // if($_SERVER['REQUEST_METHOD'] === 'POST'){
       
        //     $adminUser=$this->fm->validation($_POST['adminUser']);
        //     $adminPass=$this->fm->validation($_POST['adminPass']);


        //    if( empty($adminUser) || empty($adminPass)){
        //        $alert = '<div class="alert alert-danger" role="alert"> User and Pass must be not empty </div>';

               


        //    }else{


             
              
        //       $result=$this->userModel->login($adminUser,$adminPass);
        //       if($result != NULL){
        //           Session::set('adminLogin',true);
        //           Session::set('adminId',$result['id']);
        //           Session::set('adminUser',$result['username']);
        //           Session::set('adminEmail',$result['email']);

        //           if(!empty($_POST['remember'])){
                   
        //             setcookie("adminUser", $adminUser ,time() + (86400 * 30), "/");
        //             setcookie("adminPass", $adminPass ,time() + (86400 * 30), "/");
        //           }
                
              
        //           header('Location:?controller=home');

        //       }else{
        //         $alert = '<div class="alert alert-info" role="alert">Uesr and Pass not match  </div>';

        //       }
        //    }

        // }

        // if(isset($_COOKIE['adminUser']) && $_COOKIE['adminPass']){
        //     $adminUser=$_COOKIE['adminUser'];
        //     $adminPass=$_COOKIE['adminPass'];
        //     $checked= true;

        // }
 
        $this->view('login'); 
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
         


                  Session::set('adminLogin',true);
                  Session::set('adminId',$result['id']);
                  Session::set('adminUser',$result['username']);
                  Session::set('adminEmail',$result['email']);

                  
                  if(($_POST['remember']) == "true"){
                    setcookie("adminName", $username ,time() + (86400 * 30), "/");
                    setcookie("adminPass", $password ,time() + (86400 * 30), "/");
                  }


                  echo json_encode(['message' => 'success', 'status' => 1]);


              }else{
                echo json_encode(['message' => 'Tên đăng nhập hoặc mật khẩu sai', 'status' => 0]);
              }
           }

        }

        // if(isset($_COOKIE['adminUser']) && $_COOKIE['adminPass']){
        //     $adminUser=$_COOKIE['adminUser'];
        //     $adminPass=$_COOKIE['adminPass'];
        //     $checked= true;

        // }

		// if (!empty($username) && !empty($password)) {
		// 	// $model = new Authentication();
		// 	// $user = $model->login($username, $password, $remember);
		// 	if (isset($user) && isset($user->id)) {
		// 		echo json_encode(['message' => 'success', 'status' => 1]);
		// 	} else {
		// 		echo json_encode(['message' => 'Tên đăng nhập hoặc mật khẩu sai', 'status' => 0]);
		// 	}
		// } else {
		// 	echo json_encode(['message' => 'Tên đăng nhập và mật khẩu trống', 'status' => 0]);
		// }
	}
    public function logout(){
         if(isset($_GET['action']) && $_GET['action']=='logout'){
             Session::destroy();
         }
    }
     
   
}