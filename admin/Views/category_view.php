<div class="container-fluid">
<?= $msg ?? "" ?>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Quản lí danh mục </h1>
                    <br>
                    <a href="?controller=category&action=add_category" class="btn btn-primary mb-3">Thêm danh mục </a>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Bảng danh mục sản phẩm</h6>
                        </div>
                        <div class="card-body">
                            <div class="table">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                <div class="col-sm-12 col-md-8"></div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                        <form action="" method="get">
                                                    <div class="row">
                                                    <div class="col-sm-8 ">
                                                        <input type="text" name="category_name" value="<?=$_GET["category_name"] ?? "" ?>" class="form-control">
                                                    </div>
                                                        <div class="col-sm-4">
                                                        <?php if(!empty($_GET['controller']) && $_GET['controller'] == 'category'): ?>
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
                                <table class="table dataTable table-hover" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <br>
                                    <thead class="text-center">
                                    <tr role="row"><th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 25%;">Danh mục</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 25%;">Danh mục cha</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Active</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 40%;">Action</th></tr>
                                    </thead>
                                    <tbody class="text-center">
                                    <?php foreach ($category as $cate):?>
                                        <tr class="odd">
                                            <td class="sorting_1"><?=$cate['name']?></td>
                                            <td>
                                                <?php if ($cate['parent_id'] == 0):?>
                                                   ------
                                                <?php else:?>
                                                      <?php foreach ($category as $cate2):?>
                                                             <?php if($cate['parent_id'] == $cate2['id']):?>
                                                                <?=$cate2['name'];?>
                                                             <?php endif;?>
                                                      <?php endforeach?>
                                                <?php endif; ?>
                                                </td>
                                            <td><?= ($cate['status']==0) ?'<div class="badge badge-info badge-pill" onclick="is_Active('.$cate['id'].')" style="cursor:pointer;" >active</div>' : '<div class="badge badge-danger badge-pill" onclick="is_Inactive('.$cate['id'].')"   style="cursor:pointer;">inactive</div>' ?></td>
                                            <td>
                                            <a href="?controller=category&action=edit&id=<?=$cate['id']?>" class="btn btn-primary">Sửa</a>
                                            <a href="" class="btn btn-danger" onclick="deleteCate(<?=$cate['id']?>)">Xóa</a>
                                            </td>
                                            </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table></div></div>
                            </div>
                        </div>
                    </div>

                </div>
                <script>
                        function deleteCate(id){
                            var options = confirm('Are you sure you want to delete');
                            if(!options){
                                return;
                            }
                            console.log(id);
                            $.post('?controller=category&action=delete', { "id":id }, 
                            function(data){
                            alert(data);
                            location.reload();
                            }); 
                        }
                        function is_Active(id){
                           
                            console.log(id);
                            $.post('?controller=category&action=is_active', { "id":id }, 
                            function(data){
                          
                            location.reload();
                            }); 
                        }
                        function is_Inactive(id){
                           
                           console.log(id);
                           $.post('?controller=category&action=is_inactive', { "id":id }, 
                           function(data){
                         
                           location.reload();
                           }); 
                       }
                        
</script>
