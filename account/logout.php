<?php
    session_start();
    if(empty($_SESSION["userid"])){
        header("location:../account/Login.php");
    }elseif(isset($_SESSION["userid"]) && $_SESSION["role"] == "Admin"){
        header("location:../admin/admin.php");
    }
    elseif(isset($_SESSION["userid"])){
        header("location:../main/temp.php");
    }else{
    session_unset();
    session_destroy();
    header("location:Login.php");
    exit();
}
?>