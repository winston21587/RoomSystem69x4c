<?php

require_once "../class/adminClass.php";
require_once "../Func/clean.php";

$admin = new Admin();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $roomname = clean($_GET['roomname']);

}

if(isset($_POST['submit'])){
    $action = $_POST['submit'];
    switch ($action) {
        case 'yes':
            $admin->DeleteRooms($id);   
            header("location:". $_SERVER['PHP_SELF']); 
            break;

        case 'no':
            header("location:". $_SERVER['PHP_SELF']); 
            break;

    }

}

?>


<div>
    <h2 class="text-center font-bold mb-4" >Are you sure you want to delete room <?= $roomname ?>? </h2>
    
        <form class="flex flex-row w-full justify-center gap-5 items-center" method="POST">
            <input class="rounded py-2 px-4 bg-red-500" type="submit" name="submit" value="yes" >
            <input class="rounded py-2 px-4 bg-green-500" type="submit" name="submit" value="no">
        </form>
    
</div>