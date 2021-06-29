
<div class="container">

        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Shoping Cart
            </span>
        </div>
    </div>
    <div class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">

                <form action="?controller=cart&action=update" method="post">

                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Image</th>
                                    <th class="column-2">Name</th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4">Quantity</th>
                                    <th class="column-5">Total</th>
                                    <th class="column-5">Del</th>

                                </tr>
                                <?php if($products): foreach($products as $pro): ?>
                                        <tr class="table_row">
                                        
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <img src="<?=STATIC_DIR.'uploads/'.$pro['thumbnail']?>" alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-2">
                                                 <a href="?controller=product&action=getDetail&id=<?=$pro['id']?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04" >
                                                    <?=$pro['name']?>-<?=$pro['size']?>
                                                </a>
                                            </td>
                                            <td class="column-3"><?= number_format($pro['price'],0)?></td>
                                            <td class="column-4">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                        name="qty[<?=$pro['id'].$pro['size']?>]" value="<?=$pro['qty']?>">

                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="column-5"><?=number_format(($pro['price'] * $pro['qty']),0)?></td>
                                            <td class="column-5">
                                                <a href="?controller=cart&action=delete&id=<?=$pro['id'].$pro['size']?>" ><span class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></span></a> </div>
                                            </td>
                                            
                                        </tr>
                                <?php endforeach; endif; ?>
                           
                            </table>
                           
                        </div>

                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                                    name="coupon" placeholder="Coupon Code">

                                <div
                                    class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    Apply coupon
                                </div>
                            </div>
                            <a href='?controller=cart&action=destroy' >Xoa all </a>
                            <button 
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                Update Cart
                            </button>
                            
                            
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Cart Totals
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Subtotal:
                                </span>
                            </div>

                            <div class="size-209">
                                
                                  <?php if(isset($_SESSION['cart'])):?>
                                    <span class="mtext-110 cl2">
                                       <?=number_format($_SESSION['totalPrice'],0)?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">
                                    Shipping:
                                </span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <div class="p-t-15">
                                    <div class="bor8 bg0 m-b-22">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                                <span class="mtext-101 cl2">
                                    Total:
                                </span>
                            </div>

                            <div class="size-209 p-t-1">
                                <span class="mtext-110 cl2">
                                    $79.65
                                </span>
                            </div>
                        </div>

                        <a href="<?= ($_SESSION['cart'] != null) ? '?controller=order&action=checkout' : '#' ?>" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Proceed to Checkout
                        </a>
                        <a href="?controller=home" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"> TIẾP TỤC MUA HÀNG </a>
                      
                       
                    </div>
                </div>
        </div>
    </div>
    <!--===============================================================================================-->