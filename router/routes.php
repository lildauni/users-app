<?php
require_once "D:\OpenServer\domains\crud-app\app\controllers\MainController.php";
require_once "D:\OpenServer\domains\crud-app\app\models\User.php";
$user = new MainController();
$method=$_GET['action'];
if(isset($method)){
    $user->$method();
}