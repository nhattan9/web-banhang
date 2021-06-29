<?php
class CartController extends BaseController {
    
    private $categoryModel;
    private $productModel;

    public function __construct(){
        $this->loadModel('CategoryModel');
        $this->loadModel('ProductModel');

        $this->categoryModel = new CategoryModel;
        $this->productModel = new ProductModel;

    }

    public function index(){
      
        $category= $this->categoryModel->getAllCateActive();
        $products = $_SESSION['cart'] ?? null;
 
        $this->view('masterlayout',[
                     'page'     =>'cart',
                     'category'=>$category,
                     'products'=>$products
        ]);
    }
    public function store(){
      
       
        $productId = $_POST['id'] ?? null;
        $product = $this->productModel->findById($productId);
        $quanty = $_POST['quanty'] ?? 0 ;
        $size = $_POST['size'] ?? null;

   
        //tao ra 1 gio hang  = sessipn 
        //$_SESSION['cart'][$productId] = $product;
        
      
        // kiem gtra san pham  them da ton tai trong gio hang chua
        $newId=$productId.$size;
      

        if( empty($_SESSION['cart']) || !array_key_exists($newId,$_SESSION['cart']) ){
            $product['qty'] = $quanty;
            $product['size'] = $size;

            $_SESSION['cart'][$newId] = $product;
          
        } else {
            $product['qty'] = $_SESSION['cart'][$newId]['qty'] + $quanty;
            $product['size'] = $size;
            $_SESSION['cart'][$newId] = $product;
  
        }

        
        $total = 0;
        $totalPrice = 0 ;
        foreach($_SESSION['cart'] as $value ){
            $total +=$value['qty'] ;
            $totalPrice +=($value['qty']*$value['price']);
            $_SESSION['total']= $total;
            $_SESSION['totalPrice']= $totalPrice;

        }



        $data='<ul class="header-cart-wrapitem w-full" >';
        foreach($_SESSION['cart'] as $value){
            $data .= ' 
            
                    <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                    
                        <img src="'. STATIC_DIR.'uploads/'.$value['thumbnail'].'" alt="IMG">
                    </div>

                    <div class="header-cart-item-txt p-t-8">
                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                         '.$value['name'].'-'.$value['size'].'
                        </a>

                        <span class="header-cart-item-info">
                        <span class="text-danger font-weight-bold">'.$value['qty'].'</span>  x'.$value['price'].'
                        </span>
                    </div>
                    </li>
            
            
            ';
        }
        
        $data.='</ul>';
        $data .='<input  type="hidden" id="cartIndex" value=" '.$_SESSION['total'].'" >'; 
        $data .='
        <div class="w-full">
        <div class="header-cart-total w-full p-tb-40 text-danger">
        <span class="text-dark">Total: </span>'.number_format($_SESSION['totalPrice'] ?? "" ,0).'₫'.'
        </div>

        <div class="header-cart-buttons flex-w w-full">
            <a href="?controller=cart"
                class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                View Cart
            </a>

            <a href="?controller=order&action=checkout"
                class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                Check Out
            </a>
        </div>
    </div>
        ';
        echo $data;
      
       // header('location:index.php?controller=cart');

    }
    public function delete(){
        $productId = $_GET['id'] ?? null;
        $_SESSION['total'] -=$_SESSION['cart'][$productId]['qty'];

        $_SESSION['totalPrice'] -= ($_SESSION['cart'][$productId]['qty'] *$_SESSION['cart'][$productId]['price']);
        unset($_SESSION['cart'][$productId]);
        header('location:index.php?controller=cart');

    }
    public function update(){
 
          foreach($_POST['qty'] as $productId => $qty){
              if($qty < 0 || !is_numeric($qty)){
                  continue;
              }
              if($qty == 0 ){
                 $_SESSION['total'] -=$_SESSION['cart'][$productId]['qty'];
                 $_SESSION['totalPrice'] -= ($_SESSION['cart'][$productId]['qty'] *$_SESSION['cart'][$productId]['price']);

                  unset($_SESSION['cart'][$productId]);
              }else{
                $_SESSION['total'] += $qty -  $_SESSION['cart'][$productId]['qty'];
                $_SESSION['totalPrice'] += (($qty *$_SESSION['cart'][$productId]['price'])-($_SESSION['cart'][$productId]['qty'] *$_SESSION['cart'][$productId]['price']));


                $_SESSION['cart'][$productId]['qty'] = $qty;

              }
          }
        header('location:index.php?controller=cart');

    }
    public function destroy(){
        unset($_SESSION['cart']);
        header('location:index.php?controller=cart');

    }
}