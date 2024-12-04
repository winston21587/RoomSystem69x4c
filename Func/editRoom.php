
<?php
    require_once "../class/adminClass.php";
    require_once "../Func/clean.php";
    $admin = new Admin();
    if(isset($_GET['id'])){
        $id = clean($_GET['id']);
        $roomname = clean($_GET['roomname']);
        $department = clean($_GET['department']);
        $status = clean($_GET['status']);
        $admin->EditRooms($id,$roomname,$department,$status);
    }

?>