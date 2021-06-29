<div class="container-fluid">
    <span id="msg2"></span>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lí đơn hàng </h1>
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
                                        aria-label="Name: activate to sort column descending" style="width: 10%;">Mã Đơn
                                        Hàng</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Position: activate to sort column ascending" style="width: 10%;">
                                        Phương thức thanh toán</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending" style="width: 20%;">Ngày
                                        đặt hàng</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending" style="width: 20%;">Ngày
                                        giao hàng</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Age: activate to sort column ascending" style="width: 10%;">Tình
                                        trạng</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Age: activate to sort column ascending" style="width: 10%;">Tổng
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Age: activate to sort column ascending" style="width: 20%;">Hành
                                        động </th>


                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach($order_list as $list):?>

                                <tr class="table-row" data-href="?controller=orderDetail&order_id=<?= $list['id']?>"
                                    style="cursor: pointer ; z-index:1">
                                    <td><?= $list['code']?></td>
                                    <td><?= ($list['payment_method']== 0) ? 'Cash' : 'Banking'?></td>
                                    <td><?= $list['created_at']?></td>
                                    <td><?= $list['delivery_date']?></td>
                                    <td>
                                        <?php if($list['status'] == 0): ?>
                                        <div class="badge badge-danger badge-pill"> Proccess </div>
                                        <?php elseif($list['status'] == 1):?>
                                        <div class="badge badge-info badge-pill"> Shipping </div>
                                        <?php elseif($list['status'] == 2):?>
                                        <div class="badge badge-success badge-pill"> Delivered </div>
                                        <?php else:?>
                                        <div class="badge badge-warning badge-pill"> Cancel </div>
                                        <?php endif?>
                                    </td>
                                    <td><?= number_format($list['total'],0)?>đ</td>
                                    <td style=" z-index: 10000000 !important;"> <a href="#"
                                            class="btn btn-danger btn-circle" onclick="deleteOrder(<?=$list['id']?>)">
                                            <i class="fas fa-trash"></i>
                                        </a></td>

                                </tr>

                                <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
    function deleteOrder(id) {

        $.post('?controller=order&action=delete', {
                "id": id
            },
            function(data) {
                location.reload();
                $('#msg2').html(data);

            });
    }
    $(document).ready(function($) {
        $(".table-row").click(function() {
            window.document.location = $(this).data("href");
        });



    });
    </script>