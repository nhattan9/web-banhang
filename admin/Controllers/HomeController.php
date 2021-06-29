<?php
        require_once ROOT.'/helpers/library.php';
        require_once ROOT.'/helpers/FlashMessages.php'; 


 class HomeController extends BaseController{


    private $orderModel;


    public function __construct(){
        $this->loadModelInAdmin('OrderModel');
        $this->orderModel = new OrderModel;
    }
   
    public function index(){
      
        $counters = $this->orderModel->getCounters();
        
        $pending_order = $this->orderModel->getPendingOrder();
        $cancel_order = $this->orderModel->getCancelledOrder();
        $process_order = $this->orderModel->getProcessOrder();
        $delivered_order = $this->orderModel->getDeliveriedOrder();
      
        // echo '<pre>';
        // print_r($pending_order);
        $this->view('masterlayout',[
            'page' =>"home",
            'pending_order'=>$pending_order,
            'cancel_order'=>$cancel_order,
            'process_order'=>$process_order,
            'counters'=>$counters,
            'delivered_order'=>$delivered_order

            
    
        ]);
        
    }

    public function getOrder(){
       
        $pending_order = $this->orderModel->getPendingOrder();
     
      if(!empty($pending_order)){
        $str = ' 
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
        
        ';

        foreach($pending_order as $list){
            $method=($list['payment_method']== 0) ? 'Cash' : 'Banking';
            $str .= '
            <tr class="table-row" data-href="?controller=orderDetail&order_id='.$list['id'].'" style="cursor: pointer ; z-index:1">
                <td>'. $list['code'].'</td>
                <td>'. $method.'</td>
                <td>'. $list['created_at'].'</td>
                <td>'. $list['delivery_date'].'</td>
                <td><div class="badge badge-danger badge-pill"> Proccess </div></td>
                <td>'. number_format($list['total'],0).'đ</td>
                <td style=" z-index: 10000000 !important;"> 
                    <a href="?controller=orderDetail&order_id='.$list['id'].'" class="btn btn-primary btn-circle">
                       <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-circle"
                        onclick="deleteOrder('.$list['id'].')">
                        <i class="fas fa-trash"></i>
                    </a></td>
            </tr>
            ';
            }
        $str.= ' </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>
        </div>';

echo $str;
      }
}

public function getCancel(){
    $cancel_order = $this->orderModel->getCancelledOrder();
  
    if(!empty($cancel_order)){
        $str = ' 
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
        
        ';
        
        foreach($cancel_order as $list){
            $method=($list['payment_method']== 0) ? 'Cash' : 'Banking';
            $str .= '
            <tr class="table-row" data-href="?controller=orderDetail&order_id='.$list['id'].'" style="cursor: pointer ; z-index:1">
                <td>'. $list['code'].'</td>
                <td>'. $method.'</td>
                <td>'. $list['created_at'].'</td>
                <td>'. $list['delivery_date'].'</td>
                <td> <div class="badge badge-warning badge-pill"> Cancel </div></td>
                <td>'. number_format($list['total'],0).'đ</td>
                <td style=" z-index: 10000000 !important;"> 
                    <a href="?controller=orderDetail&order_id='.$list['id'].'" class="btn btn-primary btn-circle">
                    <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-circle"
                        onclick="deleteOrder('.$list['id'].')">
                        <i class="fas fa-trash"></i>
                    </a>
                    
                </td>
            </tr>
            ';
            }
    
        
        $str.= ' </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>
        </div>';
    
    echo $str;
    }
  
}
public function getProcess(){
$process_order = $this->orderModel->getProcessOrder();
if(!empty($process_order)){
    $str = ' 
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
    
    ';

    foreach($process_order as $list){
        $method=($list['payment_method']== 0) ? 'Cash' : 'Banking';
        $str .= '
        <tr class="table-row" data-href="?controller=orderDetail&order_id='.$list['id'].'" style="cursor: pointer ; z-index:1">
            <td>'. $list['code'].'</td>
            <td>'. $method.'</td>
            <td>'. $list['created_at'].'</td>
            <td>'. $list['delivery_date'].'</td>
            <td>  <div class="badge badge-info badge-pill"> Shipping </div>
            </td>
            <td>'. number_format($list['total'],0).'đ</td>
            <td style=" z-index: 10000000 !important;"> 
                <a href="?controller=orderDetail&order_id='.$list['id'].'" class="btn btn-primary btn-circle">
                   <i class="fas fa-eye"></i>
                </a>
                <a href="#" class="btn btn-danger btn-circle"
                    onclick="deleteOrder('.$list['id'].')">
                    <i class="fas fa-trash"></i>
                </a></td>
        </tr>
        ';
        }

    
    $str.= ' </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    </div>';

echo $str;
}
    
}

public function getDelivered(){

    $delivered_order = $this->orderModel->getDeliveriedOrder();

if(!empty($delivered_order)){
    $str = ' 
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
    
    ';

    foreach($delivered_order as $list){
        $method=($list['payment_method']== 0) ? 'Cash' : 'Banking';
        $str .= '
        <tr class="table-row" data-href="?controller=orderDetail&order_id='.$list['id'].'" style="cursor: pointer ; z-index:1">
            <td>'. $list['code'].'</td>
            <td>'. $method.'</td>
            <td>'. $list['created_at'].'</td>
            <td>'. $list['delivery_date'].'</td>
            <td>  <div class="badge badge-success badge-pill"> Delivered </div>
            </td>
            <td>'. number_format($list['total'],0).'đ</td>
            <td style=" z-index: 10000000 !important;"> 
                <a href="?controller=orderDetail&order_id='.$list['id'].'" class="btn btn-primary btn-circle">
                   <i class="fas fa-eye"></i>
                </a>
                <a href="#" class="btn btn-danger btn-circle"
                    onclick="deleteOrder('.$list['id'].')">
                    <i class="fas fa-trash"></i>
                </a></td>
        </tr>
        ';
        }

    
    $str.= ' </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    </div>';

echo $str;
}
}

}