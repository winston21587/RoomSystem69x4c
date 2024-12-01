<?php
    session_start();
    session_unset();
    header("location:account/Login.php");
    exit;
