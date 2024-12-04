
<?php
    require_once "../class/adminClass.php";
    require_once "../Func/clean.php";

    $admin = new Admin();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $roomname = clean($_GET['roomname']);
        $department = clean($_GET['department']);
        // $status = clean($_GET['status']);
    }

?>


<div id="editRoom" class=" items-start bg-slate-200 p-5">
    <form class="flex flex-col justify-center" method="POST">
    <input  class="text-black " type="text" name="RoomName" id="nameEdit" value="<?= $roomname ?>" >
    <input  class="text-black " type="text" name="department" id="deptEdit" value="<?= $department ?>">  
    <input type="submit" name="submit">
    </form>
</div>