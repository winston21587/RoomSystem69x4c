<?php
include "../includes/header.php";
session_start();
if(empty($_SESSION["userid"]) || $_SESSION['role'] != "Admin"){
    header("location:../account/Login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
<a href="../account/logout.php">logout</a>
</body>
</html>