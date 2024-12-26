<?php
require_once "../class/adminClass.php";
$Admin = new Admin();

?>
<div  class="AdminModal" id="AdminModal" >
    <form method="POST"  >
        <div class="flex flex-col justify-end items-start">
            <input class="py-2" type="text" name="RoomName" placeholder="Enter Room Name" >
            <select name="department" id="department">  
            <?php foreach($Admin->getDept() as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['deptName'] ?></option>
                <?php endforeach; ?>
            </select>
            <select name="RoomType" id="RoomType">
                <option value="Lab">Lab</option>
                <option value="Lec">Lec</option>
            </select>
            <input type="text" name="floor" placeholder="Enter floor">
            <input type="text" name="building" placeholder="Enter Building">
    </div>
        <input class="rounded text-black bg-blue-300 px-4 py-1" type="submit" name="submit" value="add" >
    </form>
</div>

