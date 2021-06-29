
<div class="container">
<h1 class="h3 mb-2 text-gray-800">Chỉnh sửa danh mục </h1>
<br>
<form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1"> Danh mục</label>
    <input type="text" class="form-control" name="cate_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Danh mục" required value="<?=$categoryById[0]['name']?>">
  </div>
  <div class="form-group">
        <label for="exampleFormControlSelect1" >Danh mục cha</label>
        <select name="cate_parent" class="form-control" id="exampleFormControlSelect1">
            <option value="0">Danh mục gốc</option>
            <?php
               foreach($category as $cate){
                   if($cate['parent_id'] == 0 ){
                     $selected=($categoryById[0]['parent_id'] == $cate['id']) ? 'selected' : "";
                     echo '<option '.$selected.' value="'.$cate['id'].'">'.$cate['name'].'</option>';
                   }
               }
            ?>
        </select>
    </div>

    <div class="custom-control custom-checkbox">
                <input type="checkbox" class="form-control custom-control-input" id="active" name="active" value="0" <?=($categoryById[0]['status'] == 0) ? 'checked=""' : ''?>>
                <label class="custom-control-label" for="active">Active</label>
    </div>
  <button type="submit" name="btn_update" class="btn btn-primary mt-3">Submit</button>
</form>
</div>