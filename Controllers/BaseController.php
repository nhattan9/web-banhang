
<?php
 class BaseController {

    const VIEW_FORDER_NAME = 'Views';
    const MODEL_FORDER_NAME = 'Models';

   //load view ()
  /**
   * Decription::pathname = folder.file.name => giong laravel
   * lấy từ sau thư mục View get after view folder =>>vi khi return view('frontend.product.index)
   * 
   */
   protected function view($viewpath, array $data=[]) {
       
        foreach ($data as $key => $value){
            $$key = $value;
        }
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // die();
          
          //die($viewpath); //frontend.product.index
          //self : use const in class
         require ($viewpath= self::VIEW_FORDER_NAME .'/'
          .str_replace('.','/',$viewpath).'.php');//chuyen dau . =>/;
   }


   protected function loadModel($modelPath){
    require ($viewpath=self::MODEL_FORDER_NAME .'/'
    .$modelPath.'.php');//chuyen dau . =>/;
   }
 // trong admin khong co model nen khi loai model phai them ../ vào đường dẫn 
   protected function loadModelInAdmin($modelPath){
    require ($viewpath='../'.self::MODEL_FORDER_NAME .'/'
    .$modelPath.'.php');//chuyen dau . =>/;
   }

   public function get_prev_url() {
    return $_SERVER['HTTP_REFERER'];
  }
 }