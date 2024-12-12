<?php

require_once "../class/adminClass.php";
include "../Func/clean.php";
session_start();
$Admin = new Admin();


if(isset($_GET['facultyID'])){
    $facultyID = clean($_GET['facultyID']);
    $sender = clean($_GET['sender']);
    $SchedID = clean($_GET['SchedID']);

    $Admin->SendRequest($facultyID,$sender,$SchedID);

}