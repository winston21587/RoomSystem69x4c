<?php
    session_start();

    if(empty($_SESSION["userid"])){
        header("location:../account/Login.php");
    }
    if(isset($_SESSION["userid"]) && $_SESSION["role"] == "Admin"){
        header("location:../admin/admin.php");
    }
    if(isset($_SESSION["userid"]) && $_SESSION["role"] == "Student"){
        header("location:../main/temp.php");

    }
    
    session_unset();
    session_destroy();
    header("location:Login.php");
    exit();

?>