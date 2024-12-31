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


<div id="editRoom" class=" items-start bg-white">

<form method="POST" class="flex flex-col gap-1">
    <div class="mb-2">
        <input type="hidden" name="id" value="<?= $id ?>">
    </div>

    <div class="mb-2 flex gap-2">
        <div class="w-1/2">
            <label for="nameEdit" class="block text-lg font-medium text-gray-700">Room Name</label>
            <input
                class="mt-2 w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
                type="text" name="RoomName" id="nameEdit" value="<?= $roomname ?>" required>
        </div>
        <div class="w-1/2">
            <label for="RoomType" class="block text-lg font-medium text-gray-700">Room Type</label>
            <select name="RoomType" id="RoomType"
                class="mt-2 w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                <option <?= ($RoomType == 'Lec') ? 'selected' : '' ?> value="Lec">Lec</option>
                <option <?= ($RoomType == 'Lab') ? 'selected' : '' ?> value="Lab">Lab</option>
            </select>
        </div>
    </div>

    <div class="mb-2 flex gap-2">
        <div class="w-1/2">
            <label for="department" class="block text-lg font-medium text-gray-700">Department</label>
            <select name="department" id="department"
                class="mt-2 w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                <?php foreach($Admin->getDept() as $c): ?>
                <option <?= ($department == $c['deptName']) ? 'selected' : '' ?> value="<?= $c['id'] ?>">
                    <?= $c['deptName'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="w-1/2">
            <label for="Roomfloor" class="block text-lg font-medium text-gray-700">Floor</label>
            <input
                class="mt-2 w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
                type="text" name="floor" id="Roomfloor" value="<?= $floor ?>" required>
        </div>
    </div>

    <div class="mb-2">
        <label for="RoomBuilding" class="block text-lg font-medium text-gray-700">Building</label>
        <input
            class="mt-2 w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
            type="text" name="Building" id="RoomBuilding" value="<?= $building ?>" required>
    </div>

    <div class="mt-6">
        <input
            class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
            type="submit" name="submit" value="editRoom">
    </div>
</form>



</div>


