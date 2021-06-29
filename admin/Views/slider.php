<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Slider </h1>
    <span id="msg"></span>
    <br>
    <a href=" ?controller=slider&action=add_slider" class="btn btn-primary mb-3 ">Thêm Slider </a>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="table">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12">
                        <table class="table dataTable table-hover" id="dataTable" width="100%" cellspacing="0"
                            role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                            <thead class="text-center bg-warning ">
                                <tr role="row">
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending" style="width: 5%;">STT
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Position: activate to sort column ascending" style="width: 10%;">Ảnh
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending" style="width: 20%;">Title
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending" style="width: 20%;">
                                        Sub_title</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Age: activate to sort column ascending" style="width: 10%;">Link
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Age: activate to sort column ascending" style="width: 10%;">Sắp xếp
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Age: activate to sort column ascending" style="width: 10%;">Trạng
                                        thái</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Age: activate to sort column ascending" style="width: 20%;">Hành
                                        động</th>



                                </tr>
                            </thead>
                            <tbody class="text-center">

                                <?php $count = 1;?>
                                <?php foreach ($slider as $slider):?>
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td><img src="<?= STATIC_DIR.'uploads/'.$slider['image']?>" alt=""
                                            style="width:150px;"></td>
                                    <td><?=$slider['title']?></td>
                                    <td><?=$slider['sub_title']?></td>
                                    <td><?=$slider['href']?></td>
                                    <td><?=$slider['order_slider']?></td>
                                    <td><?= ($slider['status'] == 0 ) ?'<div class="badge badge-info badge-pill" onclick="is_Active('.$slider['id'].')" style="cursor:pointer;"> Hiện </div>' : '<div class="badge badge-danger badge-pill" onclick="is_Inactive('.$slider['id'].')" style="cursor:pointer;"> Ân </div>' ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-circle"
                                            onclick="deleteSlider(<?=$slider['id']?>)">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <script>
    function deleteSlider(id) {
        var options = confirm('Are you sure you want to delete');
        if (!options) {
            return;
        }

        $.post('?controller=slider&action=delete', {
                "id": id
            },
            function(data) {

                location.reload();
                $('#msg').html(data);
            });
    }

    function is_Active(id) {

        console.log(id);
        $.post('?controller=slider&action=is_active', {
                "id": id
            },
            function(data) {

                location.reload();
            });
    }

    function is_Inactive(id) {

        console.log(id);
        $.post('?controller=slider&action=is_inactive', {
                "id": id
            },
            function(data) {
                location.reload();
            });
    }
    </script>