
<div class="container-fluid">
<?= $msg ?? ""?>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Quản lí sản phẩm </h1>
                    
                    <br>
                    <a href="?controller=product&action=add_product" class="btn btn-primary mb-3">Thêm sản phẩm </a>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Sản phẩm </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                <div class="col-sm-12 col-md-8"></div>
                                <div class="col-sm-12 col-md-4 mb-5">
                                        <form action="" method="get">
                                                    <div class="row">
                                                    <div class="col-sm-8 ">
                                                        <input type="text" name="product_name" value="<?=$_GET["product_name"] ?? "" ?>" class="form-control">
                                                    </div>
                                                        <div class="col-sm-4">
                                                        <?php if(!empty($_GET['controller']) && $_GET['controller'] == 'product'): ?>
                                                        <input type="hidden" name="controller" value="<?=$_GET['controller']?>">
                                                        <button class="btn btn-primary">Search</button>
                                                        <?php endif; ?>
                                                        </div>
                                                    </div>
                                        </form>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-12">
                                <table class="table table-bordered dataTable table-hover" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row" class="text-center">
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width:5%">STT</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width:20%">Tên sản phẩm</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%">Thumbnail</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 5%;">Gía</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width:5%;">Sale</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 5%;">Nổi bật</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 5%;">Best Seller</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 10%;">Danh mục sản phẩm </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 10%;">Ngày cập nhập </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 15%;">Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $index = 1;?>
                                    <?php foreach ($products as $pro):?>
                                    <tr class="odd text-center ">
                                            <td class="sorting_1"><?=$index++;?></td>
                                            <td><?= $pro['name']?></td>
                                            <td><img src="<?= STATIC_DIR."uploads/".$pro['thumbnail']?>" alt="" style="max-width:100px; max-height:100px; object-fit:cover;"></td>
                                            <td><?= number_format($pro['price'], 0)?>đ</td>
                                            <td style="color:red"><?= number_format($pro['sale_price'])?>đ</td>
                                            <td><?= ($pro['feature']==1) ? '<div class="badge badge-secondary badge-pill">Nổi bật</div>' : ''?></td>
                                            <td><?= ($pro['best_seller'] ==1 ) ? '<div class="badge badge-danger badge-pill">Best-seller</div>' : '' ?></td>
                                            <td><?php
                                            foreach($category as $cate)
                                            if($pro['cate_id'] == $cate['id']) {
                                                echo  $cate['name'];
                                            }
                                            
                                            ?></td>
                                            <td><?= $pro['updated_at']?></td>
                                            <td>
                                            <a href="?controller=product&action=edit&id=<?=$pro['id']?>" class="btn btn-primary">Sửa</a>
                                            <a href="" class="btn btn-danger" id="input" onClick="deleteCate(<?=$pro['id']?>)">Xóa</a>
                                            <a href="?controller=attribute&id=<?=$pro['id']?>" class="btn btn-info" id="input" >Add</a>

                                            </td>
                                            
                                        </tr>
                                        
                                 <?php endforeach;?>
                                    </tbody>
                                </table></div></div>
                              
                                <div class="d-flex justify-content-center">
                                     <?= $paging?>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
<script>
function deleteCate(id) {
        var options = confirm('Are you sure you want to delete');
        if(!options){
            return;
        }
        console.log(id);
        $.post('?controller=product&action=delete', { "id":id  }, 
        function(data){

            location.reload();
        }); 
    }

</script>
