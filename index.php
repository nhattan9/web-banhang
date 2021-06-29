
<?php
session_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");
require './Config/config.php';
require './Core/Database.php';
require './Models/BaseModel.php';


// tat ca cac controller deu phai include basecontroller 
require './Controllers/BaseController.php';
//ucfirst vi name controller luon viet hoa chu cai dau neen dung ham ucfirts cguyen doi 
$controllerName=ucfirst((strtolower($_REQUEST['controller']  ?? 'Home')) . 'Controller');

$actionName=$_REQUEST['action'] ?? 'index';
require"./Controllers/${controllerName}.php";

$controllerObject = new  $controllerName;
//var_dump($controllerObject);
$controllerObject->$actionName();


