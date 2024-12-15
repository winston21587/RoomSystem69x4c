
<?php
    require_once "../class/adminClass.php";
    require_once "../Func/clean.php";

    $Admin = new Admin();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $roomname = clean($_GET['roomname']);
        $department = clean($_GET['department']);
        $floor = clean($_GET['floor']);
        $RoomType = clean($_GET['RoomType']);
        $building = clean($_GET['building']);
        }
    
?>


<div id="editRoom" class=" items-start bg-slate-200 p-5">
    <form class="flex flex-col justify-center" method="POST" >
        <input type="hidden" name="id" value="<?= $id ?>">
    <input  class="text-black " type="text" name="RoomName" id="nameEdit" value="<?= $roomname ?>" >
                <select name="department" id="department">  
            <?php foreach($Admin->getDept() as $c): ?>
                    <option <?= ($department == $c['deptName']) ? 'selected' : '' ?>  value="<?= $c['id'] ?>"><?= $c['deptName'] ?></option>

                <?php endforeach; ?>
                <input type="text" name="floor" id="Roomfloor" value="<?=$floor ?>" >
                <input type="text" name="RoomType" id="RoomType" value="<?=$RoomType ?>" >
                <select name="RoomType" id="RoomType">
                    <option <?= ($RoomType == 'Lec') ? 'selected' : '' ?> value="Lec">Lec</option>
                    <option <?= ($RoomType == 'Lab') ? 'selected' : '' ?> value="Lab">Lab</option>
                </select>
                <input type="text" name="Building" id="RoomBuilding" value="<?=$building ?>" >
            </select>
    <input type="submit" name="submit" value="editRoom">
    </form>
</div>