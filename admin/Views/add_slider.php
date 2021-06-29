<div class="container">
    <h1 class="h3 mb-2 text-gray-800">Thêm Slider mới </h1>
    <br>
    <?= $msg ?>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" name="title" id="" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Sub_title </label>
            <input type="text" class="form-control" name="sub_title" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">href </label>
            <input type="text" class="form-control" name="href" required>
        </div>

        <div class="form-group">
            <input type="file" id="image" name="anh" required><br>
            <img src="<?=STATIC_DIR."uploads/"."no-images.png" ?>" id="preview_image"
                style="max-width:200px; margin-top:20px;">
        </div>

        <div class="form-group">
            <label for="">Sắp xếp</label>
            <select name="order" class="form-control" placeholder="Chọn Danh mục" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>

            </select>
        </div>


        <div class="row m-3">
            <div class="col-sm-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="form-control custom-control-input" id="status" name="status"
                        value="0">
                    <label class="custom-control-label" for="status">Active</label>
                </div>
            </div>
            <div class="col-sm-9"></div>
        </div>

        <button type="submit" name="add_slide" class="btn btn-primary mt-3" name="submit">Submit</button>
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
</script>