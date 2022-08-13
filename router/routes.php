<?php
require_once $_SERVER['DOCUMENT_ROOT']."/app/controllers/MainController.php";
require_once $_SERVER['DOCUMENT_ROOT']."/app/models/User.php";
$user = new MainController();
if(isset($_GET['action'])){
    $method=$_GET['action'];
    $user->$method();
}