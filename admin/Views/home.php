<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4" style="cursor:pointer;">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body" id="pendingOrder">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                ORDER PENDING</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?=$counters['process']['numberOfOrder']?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4" style="cursor:pointer;">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body" id="cancelOrder">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">
                                ORDER CANCEL</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?=$counters['cancel']['numberOfOrder']?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments  fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4" style="cursor:pointer;">
            <div class="card border-left-info shadow h-100 py-2" id="orderProcess">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-info text-uppercase mb-1">
                                ORDER SHIPPING</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?=$counters['shipping']['numberOfOrder']?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4" style="cursor:pointer;">
            <div class="card border-left-success shadow h-100 py-2" id="deliveredOrder">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-success text-uppercase mb-1">
                                TODAY INCOME</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                    $income = 0;
                                    foreach ($delivered_order as $order){
                                        $income += $order['total'];
                                    }
                                    echo number_format($income,0).'VND';
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ***********************Table**************************** -->
    <section id="result">
    </section>

</div>
<script>
$("#pendingOrder").click(function() {
    $.post('?controller=home&action=getOrder', {},
        function(data) {
            $('#result').html(data);
        });
});
$("#cancelOrder").click(function() {
    $.post('?controller=home&action=getCancel', {},
        function(data) {
            $('#result').html(data);
        });
});
$("#orderProcess").click(function() {
    $.post('?controller=home&action=getProcess', {},
        function(data) {
            $('#result').html(data);
        });
});
$("#deliveredOrder").click(function() {
    $.post('?controller=home&action=getDelivered', {},
        function(data) {
            $('#result').html(data);
        });
});

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