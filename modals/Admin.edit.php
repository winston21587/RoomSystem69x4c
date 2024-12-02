
<?php
    require_once "../class/adminClass.php";
    require_once "../Func/clean.php";

    $admin = new Admin();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $roomname = clean($_GET['roomname']);
        $department = clean($_GET['department']);
        $status = clean($_GET['status']);
    }

    if(isset($_POST['submit'])){
        $roomname = clean($_POST['RoomName']);
        $department = clean($_POST['department']);
        $status = clean($_POST['status']);
        $admin->EditRooms($id,$roomname,$department,$status);
        
    }
?>


<div id="editRoom" class=" items-start bg-slate-200 p-5">
    <form class="flex flex-col justify-center" method="POST">
    <input  class="text-black " type="text" name="RoomName" value="<?= $roomname ?>" >
    <input  class="text-black " type="text" name="department" value="<?= $department ?>" >
    <select class="text-black "  name="status" id="status">
        <option value="available" <?= isset($status) && $status == 'available' ? 'selected' : '';?> >available</option>
        <option value="unavailable" <?= isset($status) && $status == 'unavailable' ? 'selected' : '';?> >unavailable</option>
    </select>    
    <input type="submit" name="submit">
    </form>
</div>