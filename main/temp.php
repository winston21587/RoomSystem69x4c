<?php
include "../includes/header.php";
session_start();
if(empty($_SESSION["userid"])){
    header("location:../account/Login.php");
    exit;
}


?>



<!DOCTYPE html>
<html lang="en">
<body>
    <p>dummy web for <?= $_SESSION['username']  ?> with the course of <?= $_SESSION['course'] ?> </p>
    

    <a href="../account/logout.php">logout</a>
</body>
</html>