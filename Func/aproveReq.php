
<?php

require_once "../class/adminClass.php";
include "../Func/clean.php";
session_start();
$Admin = new Admin();

if(isset($_GET['idRequest'])){
    $id = $_GET['idRequest'];
    $status = $_GET['status'];
    
    $Admin->AcceptRequest($id,$status);

}
