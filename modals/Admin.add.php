<?php
require_once "../class/adminClass.php";
$Admin = new Admin();

?>
<div class="AdminModal" id="AdminModal">
<form method="POST" class="space-y-4 w-full max-w-md mx-auto">
    <div class="flex flex-col space-y-3">
        <input type="text" name="RoomName" placeholder="Enter Room Name"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <select name="department" id="department"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <?php foreach ($Admin->getDept() as $c): ?>
            <option value="<?= $c['id'] ?>"><?= $c['deptName'] ?></option>
            <?php endforeach; ?>
        </select>
        <select name="RoomType" id="RoomType"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="Lab">Lab</option>
            <option value="Lec">Lec</option>
        </select>
        <input type="text" name="floor" placeholder="Enter Floor"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input type="text" name="building" placeholder="Enter Building"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <input type="submit" name="submit" value="add"
        class="w-full py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out">
</form>
</div>

