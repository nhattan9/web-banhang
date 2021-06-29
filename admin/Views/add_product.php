
<div class="container">
<?= $msg?>
<h1 class="h3 mb-2 text-gray-800">Sản phẩm mới </h1>
<br>
<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="exampleInputEmail1">Tên sản phẩm</label>
    <input type="text" class="form-control" name="name" id="" required >
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Title </label>
    <input type="text" class="form-control" name="short-desc"  required> 
  </div>

   <!-- <div class="form-group">
    <label for="thumbnail">thumbnail:</label>
    <input type="text" value=""  class="form-control" name="thumbnail" id="thumbnail" onchange="updateThumbnail()">   
    <img src="" style="max-width:200px;" id="img_thumbnail">
   </div> -->

   <div class="form-group">
       <input type="file" id="image" name="anh" required ><br>
       <img src="<?=STATIC_DIR."uploads/"."no-images.png" ?>" id="preview_image" style="max-width:200px; margin-top:20px;">  
    </div>

   <div class="form-group">
   <label for="">Danh mục</label>
   <select name="cate" class="form-control" placeholder="Chọn Danh mục" required >
   <option value="">Chọn danh mục</option>
            <?php 
            foreach($category as $cate){
                if($cate['parent_id']==0)
                   echo '<option value="'.$cate['id'].'">'.$cate['name'].'</option>';
                   foreach($category as $cate2){
                       if($cate2['parent_id'] != 0 && $cate['id']==$cate2['parent_id']){
                           echo '<option value="'.$cate2['id'].'">---------'.$cate2['name'].'---------</option>';
                       }
                   }
               }
            ?>
        </select>
  </div>

    <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <label for="exampleInputEmail1">Gía </label>
        <input type="text" class="form-control" name="price"  required >
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
        <label for="exampleInputEmail1">Giảm giá </label>
        <input type="text" class="form-control" name="sale" >
        </div>
    </div>
    </div>

    <div class="row m-3">
        <div class="col-sm-3">
            <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-control custom-control-input" id="bestseller" name="bestseller" value="1" >
                        <label class="custom-control-label" for="bestseller">Best Seller</label>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-control custom-control-input" id="feature" name="feature" value="1" >
                        <label class="custom-control-label" for="feature">Nổi bật</label>
            </div>
        </div>
        <div class="col-sm-6"></div>
    </div>


    <div class="form-group">
        <label for="desc">Mô tả:</label>
        <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
    </div>

  <button type="submit" name="add_pro" class="btn btn-primary mt-3" name="submit">Submit</button>
</form>
</div>



    <script>
      $("#image").on('change', function() {
        if (this.files && this.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            document.getElementById("preview_image").src = e.target.result;
          };
          reader.readAsDataURL(this.files[0]); 
        }
      });

      $('#desc').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                  // set focus to editable area after initializing summernote
      });
    </script>
    