<?php 
require_once ROOT.'/helpers/session.php';

?> 
 <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-70 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form method="post" action="">
                    <div class="stext-116 cl8 trans-04 mb-2 text-center text-danger ">
                        THÔNG TIN LIÊN HỆ 
                    </div>
                    <input type="hidden" value="<?=Session::get('userId') ?? '0'?>" name="user_id">
                    <input type="hidden" value="<?=$_SESSION['totalPrice'] ?? '0'?>" name="total_price">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input  type="email" class="form-control" name="customer_email" value="<?=Session::get('userEmail') ?? ""?>">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="Phone">Phone</label>
                        <input type="tel" class="form-control" name="customer_phone" value="<?=Session::get('userPhone') ?? ""?>">
                        </div>
                    </div>

                <div class="stext-116 cl8 trans-04 mt-3 text-center text-danger ">THÔNG TIN GIAO HÀNG </div>
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" placeholder="" name="customer_name" value="<?=Session::get('userName') ?? ""?>">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Address</label>
                        <input type="text" class="form-control" id="inputAddress2"  name="customer_address" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputState">Tỉnh/Thành Phố <span style="color:red;">*</span></label>
                            <select id="inputCity" class="form-control" name="matp" required>
                                <option selected="">Tỉnh/Thành Phố</option>
                                <?php foreach ( $cities as $city):?>
                                <option value="<?=$city['matp']?>"><?=$city['name_city']?></option>
                                <?php endforeach;?>              
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputQuan">Quận/Huyện <span style="color:red;">*</span></label>
                            <select id="inputQuan" class="form-control"  name="maqh" required> 

                                <!-- <option value="" >Quận/Huyện </option> -->

                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputXa">Xã/Phường/Thị Trấn</label>
                            <select id="inputXa" class="form-control"  name="xaid" required>

                                <!-- <option value=""> Xã/Thị Trấn </option> -->
                                
                            </select>
                        </div>
                    </div>
            
                    <button type="submit" name="checkout" class="  flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-4 m-tb-10  ">Submit</button>
               </form>
            </div>

                <div class="size-30 bor10 flex-w flex-col-m p-lr-40 p-tb-30 p-lr-15-lg w-full-md">
                <span class="mtext-103 cl2 mb-5">
                    Your Cart
                </span>
                <ul class="header-cart-wrapitem w-full">
                <?php foreach($products as $pro):?>
                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="<?= STATIC_DIR.'uploads/'.$pro['thumbnail']?>" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            <?=$pro['name']?>-<?=$pro['size']?>
                            </a>

                            <span class="header-cart-item-info">
                            <?= $pro['qty'].'x'. $pro['price']?>  
                            </span>
                        </div>
                    </li>
             <?php endforeach?>


                </ul>

                <div class="w-full">
                <div class="header-cart-total w-full p-tb-40 text-danger">
                    <span class="text-dark">Total: </span><?=number_format($_SESSION['totalPrice'] ?? "" ,0).'₫'?> 
                    </div>

                   
                </div>
               <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div>
                </div>
</section>

<script>
$(document).ready(function(){
    $('#inputCity').on('change', function(){
        var matp = $(this).val();
     
        if(matp){
            $.ajax({
                type:'POST',
                url:'?controller=order&action=getAddress',
                data:'matp='+matp,
                success:function(html){

                    $('#inputQuan').html(html);
                    $('#inputXa').html('<option value="">Chọn Quận Huyện trước</option>'); 
                }
            }); 
        }else{
            $('#inputQuan').html('<option value="">Chọn Thành Phố trước</option>');
            $('#inputXa').html('<option value="">Chọn Quận Huyện trước</option>'); 
        }
    });
    
    $('#inputQuan').on('change', function(){
        var maqh = $(this).val();
        if(maqh){
            $.ajax({
                type:'POST',
                url:'?controller=order&action=getAddress',
                data:'maqh='+maqh,
                success:function(html){
                    $('#inputXa').html(html);
                }
            }); 
        }else{
            $('#inputXa').html('<option value="">Chọn Quận Huyện trước</option>'); 
        }
    });
});
</script>
