<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dirty Coin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;1,100;1,300&display=swap"
        rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?= STATIC_DIR ?>images/icons/favicon.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>vendor/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= STATIC_DIR ?>css/main.css">
    <!--===============================================================================================-->
</head>

<body class="animsition">
    <!-- ==================================HOME================================================ -->

    <header class="header-v4">
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <!-- Topbar -->
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <div class="left-top-bar">
                        Free shipping for standard order over $100
                    </div>

                    <div class="right-top-bar flex-w h-full">
                        <?php 
						    require_once ROOT.'/helpers/session.php';
						    $loginCheck= Session::get('userLogin');
						    if($loginCheck == false){
								echo '<a href="#" class="flex-c-m trans-04 p-lr-25 js-show-modal1">LOGIN</a>';
							}else{
								echo '
								<a  href="#" class="flex-c-m trans-04 p-lr-25">Hello ,'.Session::get('userName').'</a>
								<a href="?controller=login&action=logout&userid='.Session::get('userId').'" class="flex-c-m trans-04 p-lr-25 ">LOGOUT</a>
								';

							}
						 ?>

                        <a href="#" class="flex-c-m trans-04 p-lr-25">
                            EN
                        </a>

                        <a href="#" class="flex-c-m trans-04 p-lr-25">
                            USD
                        </a>
                    </div>
                </div>
            </div>

            <div class="wrap-menu-desktop how-shadow1">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="?controller=home" class="logo">
                        <img src="<?= STATIC_DIR ?>images/logo.png" alt="IMG-LOGO">
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <?php  foreach($category as $cate):?>
                            <?php  if($cate['parent_id'] == 0):?>
                            <li>
                                <a href="?controller=category&id=<?=$cate['id']?>"><?=$cate['name']?></a>
                                <ul class="sub-menu">

                                    <?php foreach($category as $cate2): ?>
                                    <?php if($cate2['parent_id'] == $cate['id']):?>
                                    <li><a href="?controller=category&id=<?=$cate2['id']?>"><?=$cate2['name']?></a></li>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                </ul>
                            </li>
                            <?php endif;?>
                            <?php endforeach;?>


                            <li class="label1" data-label1="hot">
                                <a href="shoping-cart.html">Features</a>
                            </li>

                            <li>
                                <a href="blog.html">Blog</a>
                            </li>

                            <li>
                                <a href="about.html">About</a>
                            </li>

                            <li>
                                <a href="contact.html">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>

                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                            data-notify="<?=$_SESSION['total'] ?? 0?>" id="getIndex">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>

                        <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                            data-notify="0">
                            <i class="zmdi zmdi-favorite-outline"></i>
                        </a>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="index.html"><img src="<?= STATIC_DIR ?>images/icons/logo-01.png" alt="IMG-LOGO"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                    data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
                    data-notify="0">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </a>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li>
                    <div class="left-top-bar">
                        Free shipping for standard order over $100
                    </div>
                </li>

                <li>
                    <div class="right-top-bar flex-w h-full">
                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            Help &amp; FAQs
                        </a>

                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            My Account
                        </a>

                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            EN
                        </a>

                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            USD
                        </a>
                    </div>
                </li>
            </ul>

            <ul class="main-menu-m">
                <li>
                    <a href="index.html">Home</a>
                    <ul class="sub-menu-m">
                        <li><a href="index.html">Homepage 1</a></li>
                        <li><a href="home-02.html">Homepage 2</a></li>
                        <li><a href="home-03.html">Homepage 3</a></li>
                    </ul>
                    <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>

                <li>
                    <a href="product.html">Shop</a>
                </li>

                <li>
                    <a href="shoping-cart.html" class="label1 rs1" data-label1="hot">Features</a>
                </li>

                <li>
                    <a href="blog.html">Blog</a>
                </li>

                <li>
                    <a href="about.html">About</a>
                </li>

                <li>
                    <a href="contact.html">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 ">
            <!-- <div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="<?= STATIC_DIR ?>images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" id="search_product" name="search" placeholder="Search...">
				</form>
				<table id="result">
			
			</table>
			</div> -->

            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="<?= STATIC_DIR ?>images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <div class="container" style="position: relative; z-index:10;">
                <div class="row">
                    <div class="col-md-8 col-lg-9 p-b-80">
                        <div class="p-r-45 p-r-0-lg">
                            <!--  -->
                            <div class="wrap-pic-w how-pos5-parent">
                                <img src="<?= STATIC_DIR.'images/blog-04.jpg'?>" alt="IMG-BLOG">

                                <div class="flex-col-c-m size-123 bg9 how-pos5">
                                    <span class="ltext-107 cl2 txt-center">
                                        22
                                    </span>

                                    <span class="stext-109 cl3 txt-center">
                                        Jan 2018
                                    </span>
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-3 p-b-80">
                        <div class="side-menu">
                            <div class="bor17 of-hidden pos-relative">
                                <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" id="search_product" name="search"
                                    placeholder="Search">

                                <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </div>

                            <div class="p-t-20">
                                <ul id="result" style="max-height:400px; overflow:hidden;">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </header>

    <!-- **************************************************************************** -->
    <!-- Modal Cart -->
    <div class="wrap-header-cart js-panel-cart" id="show_cart">
        <div class="s-full js-hide-cart"></div>

        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Your Cart
                </span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            <div class="header-cart-content flex-w js-pscroll" id="readerCart">
                <ul class="header-cart-wrapitem w-full">

                    <?php if(isset($_SESSION['cart'] )): foreach($_SESSION['cart'] as $cart): ?>
                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img  ">
                            <img src="<?= STATIC_DIR.'uploads/'.$cart['thumbnail'] ?>" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt p-t-8">
                            <a href="?controller=product&action=getDetail&id=<?=$cart['id']?>"
                                class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                <?=$cart['name']?>-<?=$cart['size']?>
                            </a>
                            <span class="header-cart-item-info">
                                <span class="text-danger font-weight-bold"><?=$cart['qty']?></span> x<?=$cart['price']?>
                            </span>
                        </div>
                    </li>
                    <?php endforeach; endif;?>
                </ul>

                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40  text-danger">
                        <span class="text-dark">Total:
                        </span><?=isset($_SESSION['totalPrice']) ? number_format($_SESSION['totalPrice'],0).'₫' : ""?>
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
            </div>
        </div>
    </div>

    <!-- LOGIN POP UP -->

    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20 ">
        <div class="overlay-modal1 js-hide-modal1"></div>

        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="<?=STATIC_DIR.'images/icons/icon-close.png'?>" alt="CLOSE">
                </button>

                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="wrap-pic-w pos-relative">
                            <img src="<?=STATIC_DIR.'images/login.png'?>">
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">


                            <h4 class="mtext-105 cl2 txt-center p-b-30">
                                LOGIN
                            </h4>
                            <span id="login_alert"></span>

                            <div class="bor8 m-b-20 how-pos4-parent">
                                <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="username"
                                    placeholder="Enter Username " value="<?= $_COOKIE['username'] ?? ""?>">

                            </div>
                            <div class="bor8 m-b-20 how-pos4-parent">
                                <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" id="password"
                                    placeholder="Enter Password " value="<?= $_COOKIE['password'] ?? ""?>">

                            </div>

                            <div class=" m-b-20 custom-control custom-checkbox small">
                                <input type="checkbox" class=" m-b-20" name="remember" id="login_remember">
                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                            </div>

                            <p class="stext-102 cl3 p-b-23">
                                You dont have account ?? <a href="?controller=register">Register</a>
                            </p>

                            <div name="login_btn" id="btn_submit"
                                class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                                Login
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {

        $('#search_product').keyup(function() {
            var product_name = $(this).val();
            if (product_name != "") {
                $.post('?controller=home&action=get', {
                        'product_name': product_name
                    },
                    function(data) {
                        $('#result').html(data);
                    });
            } else {
                $('#result').html('');
            }
        });

        //Login ACTION 


        $('#btn_submit').on('click', function() {

            let username = $('#username').val();
            let password = $('#password').val();
            let remember = $('#login_remember').prop("checked");


            if (username == "" || password == "") {
                // $('#username').addClass('is-invalid');
                // $('#password').addClass('is-invalid');
                $("#login_alert").append(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">Tài khoản và mật khẩu không được để rỗng<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                    );
                return false;
            }

            $.ajax({
                url: '?controller=login&action=post',
                type: 'POST',
                data: {
                    username: username,
                    password: password,
                    remember: remember
                },
                success: function(result) {


                    if (JSON.parse(result).status == 1) {
                        window.location.href = "";
                    } else {
                        // $('#username').addClass('is-invalid');
                        // $('#password').addClass('is-invalid');
                        if ($('.alert').length > 0) {
                            $('.alert').remove();
                            $("#login_alert").append(
                                '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                JSON.parse(result).message +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                                );
                        } else {
                            $("#login_alert").append(
                                '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                JSON.parse(result).message +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                                );
                        }

                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });





    });
    </script>