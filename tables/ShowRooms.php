<?php
require_once "../class/adminClass.php";
$Admin = new Admin();

if(isset($_GET['id'])){
    $id = $_GET['id'];

}


?>

<div>
<label for="RoomDept" class="block text-lg font-medium text-gray-700">Rooms</label>
    <select name="RoomDept" id="RoomDept" class="w-full mt-2 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
    <?php foreach($Admin->showroomForDept($id) as $c): ?>
        <option value="<?= $c['id'] ?>"><?= $c['RoomName'] ?></option>
    <?php endforeach; ?>
    </select>
</div>