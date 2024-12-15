<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once "../class/adminClass.php";
include "../Func/clean.php";
session_start();
$Admin = new Admin();




        $RequestedBy = clean($_GET['requestBy']);
    $RespondedBy = clean($_GET['requestTo']);
    $schedID = clean($_GET['SchedID']);
    $DateRequested = date('Y-m-d H:i:s');
    $DateOfUse = clean($_GET['dateOfUse']);
    $Admin->SendRequest($RequestedBy,$RespondedBy,$schedID,$DateRequested,$DateOfUse);

