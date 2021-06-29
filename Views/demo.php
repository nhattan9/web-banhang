<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('<?=STATIC_DIR.'images/bg-01.jpg'?>');">
        <h2 class="ltext-105 cl0 txt-center">
            Register
        </h2>
    </section>

    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form method="post" action="">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Email</label>
              <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Password</label>
              <input type="password" class="form-control" id="inputPassword4">
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
          </div>
          <div class="form-group">
            <label for="inputAddress2">Address 2</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
          </div>
          <div class="form-row">
            
            <div class="form-group col-md-4">
              <label for="inputState">Tỉnh/Thành Phố <span style="color:red;">*</span></label>
              <select id="inputCity" class="form-control">
                <option selected>Tỉnh/Thành Phố</option>
                <?php foreach ( $cities as $city):?>
                  <option value="<?=$city['matp']?>"><?=$city['name_city']?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="inputQuan">Quận/Huyện <span style="color:red;">*</span></label>
              <select id="inputQuan" class="form-control">

                 <!-- <option value="" >Quận/Huyện </option> -->

              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="inputXa">Xã/Phường/Thị Trấn</label>
              <select id="inputXa" class="form-control">

                 <!-- <option value=""> Xã/Thị Trấn </option> -->
                 
              </select>
            </div>
           
          </div>
         
          <button type="submit" class="btn btn-primary">Sign in</button>
        </form>

                    </form>
                </div>

                <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-map-marker"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Address
                            </span>

                            <p class="stext-115 cl6 size-213 p-t-18">
                                Coza Store Center 8th floor, 379 Hudson St, New York, NY 10018 US
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-phone-handset"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Lets Talk
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                +1 800 1236879
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-envelope"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Sale Support
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                contact@example.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="container">
        


</div>

<!-- ***************************************************************************** ********************************-->
<script>
$(document).ready(function(){
    $('#inputCity').on('change', function(){
        var matp = $(this).val();
     
        if(matp){
            $.ajax({
                type:'POST',
                url:'?controller=register&action=getAddress',
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
                url:'?controller=register&action=getAddress',
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
