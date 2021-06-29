<div class="container-fluid">
    <div class="col-xl-5 col-lg-7">
        <div class="card shadow mb-4">
        <?=$msg?>
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin người nhận</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <h6 class="m-0 text-primary">Họ tên : <span class="text-dark"><?=$orderInfo['customer_name']?></span>
                </h6>
                <h6 class="m-0 text-primary">Email : <span class="text-dark"><?=$orderInfo['customer_email']?></h6>
                <h6 class="m-0 text-primary">Sđt : <span class="text-dark"><?=$orderInfo['customer_phone']?></h6>
                <h6 class="m-0 text-primary">Địa chỉ: <span class="text-dark"><?=$orderInfo['customer_address']?> ,
                        <?=$xa['name'].', '.$quanhuyen['name_quanhuyen'].', '.$city['name_city']?>
                </h6>



            </div>
        </div>
    </div>



    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Chi tiết đơn hàng </h1>
    <br>
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
                                        aria-label="Name: activate to sort column descending" style="width: 10%;">ID
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Position: activate to sort column ascending" style="width: 10%;">Ảnh
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending" style="width: 20%;">Tên
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending" style="width: 10%;">Size
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending" style="width: 10%;">Gía
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Age: activate to sort column ascending" style="width: 10%;">Số lượng
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Age: activate to sort column ascending" style="width: 10%;">Tổng
                                    </th>


                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach($product_list as $list):?>

                                <tr>
                                    <td><?= $list['product_id']?></td>
                                    <td><img src="<?= STATIC_DIR.'uploads/'.$list['product_thumbnail']?>" alt=""
                                            style="width:50px"></td>
                                    <td><?= $list['product_name']?></td>
                                    <td><?= $list['product_size']?></td>
                                    <td><?= $list['product_price']?></td>
                                    <td><?= $list['product_qty']?></td>
                                    <td><?= number_format(($list['product_qty']*$list['product_price']),0)?>đ</td>


                                </tr>

                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-9 col-md-6 mb-4"></div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">

                    <div class="row no-gutters align-items-center   ">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Đơn giá:</div>
                        </div>
                        <div class="col-auto">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?=number_format($orderInfo['total'],0).'.VND'?>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center  mt-3   ">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Phí vận chuyển: </div>
                        </div>
                        <div class="col-auto">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">FREE</div>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center  mt-3   ">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Tổng:</div>
                        </div>
                        <div class="col-auto">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?=number_format($orderInfo['total'],0).'.VND'?></div>
                        </div>
                    </div>

                  <form method="post" action="">
                    <div class="row no-gutters align-items-center  mt-3   ">
                            <div class="col ">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><label for="">Trạng Thái </label></div>
                            </div>
                            <div class="col-auto">
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <select class="custom-select" name="status">
                                        <?php 
                                            foreach($status as $status){
                                                if( $orderInfo['status'] == $status['id']){
                                                    echo ' <option selected value="'.$status['id'].'">'.$status['name'].'</option>';
                                                }else{
                                                    echo ' <option value="'.$status['id'].'">'.$status['name'].'</option>';
                                                }
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row no-gutters align-items-center  mt-3   ">
                            <div class="col-sm-4 ">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><label for="">Ngày giao: </label></div>
                            </div>
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-0 font-weight-bold text-gray-800">
                                    <input type="date" name="delivery_date">
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutters align-items-center  mt-3   ">
                            <button type="submit" name="order_submit" class="btn btn-primary"> Cập nhật </button>
                        </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function($) {
        $(".table-row").click(function() {
            window.document.location = $(this).data("href");
        });
    });
    </script>