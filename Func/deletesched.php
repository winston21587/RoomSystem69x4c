<?php

require_once "../class/adminClass.php";
require_once "clean.php";
session_start();
$Admin = new Admin();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $Admin->DeleteSchedule($id);
    header("location:".$_SERVER['PHP_SELF']);
    exit;   

}


?>