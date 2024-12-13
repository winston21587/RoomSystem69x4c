<?php
require_once "../class/adminClass.php";
include "../Func/clean.php";
session_start();
$Admin = new Admin();

if (isset($_GET['idRequest']) && isset($_GET['status'])) {
    $id = $_GET['idRequest'];
    $status = $_GET['status'];
    $result = $Admin->AcceptRequest($status, $id);
    
    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
}
?>

