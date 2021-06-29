<?php
 require_once ROOT.'/helpers/library.php';

  class SliderController extends BaseController{
   
        private $sliderModel;
        public function __construct(){
        
            $this->loadModelInAdmin('SliderModel');
            $this->sliderModel = new SliderModel;
        }
        public function index(){
            $selectColumn =['*'];
            $orderby = ['column' => 'order_slider', 'type' =>"asc"];
            $slider = $this->sliderModel->getAll($selectColumn,$orderby);
           
            $this->view('masterlayout',[
                  'page' =>'slider',
                  'slider'=>$slider
            ]);
        }
        public function add_slider(){
          //INSERT
          $data=[]; 
          $msg=""  ;
          if(isset($_POST['add_slide'])){
             // kiem gtra xem anh vua them da ton tai trong folder chua 
              $image=Library::uploadFiles($_FILES['anh'], UPLOAD_DIR);
    
              $data=[
                "title"=>$_POST["title"],
                "sub_title"=>$_POST["sub_title"],
                "image"=>$image,
                "href"=>$_POST["href"],
                "order_slider"=>$_POST["order"],
                "status"=>$_POST["status"],
              ];
              if($image){
                $msg=$this->sliderModel->store($data);
              }
          }
          $this->view('masterlayout',[
            'page' =>'add_slider',
             'msg' => $msg 
           
            ]);

        }

        public function delete(){

          $id=$_POST['id'];
          $product=$this->sliderModel->findById($id);
          $file=$product['image'];
          if(file_exists(UPLOAD_DIR.'/'.$file)){
           unlink(UPLOAD_DIR.'/'.$file);
          }
          $msg = $this->sliderModel->deleteById($id);
          echo $msg;
        }
        public function is_active(){
            $id=$_POST['id'];
            $this->sliderModel->is_active($id);


        }
        public function is_inactive(){
          $id=$_POST['id'];
          $this->sliderModel->is_inactive($id);


        }
    
         
       

  }