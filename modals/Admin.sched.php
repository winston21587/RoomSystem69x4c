<?php

require_once "../class/adminClass.php";
require_once "../Func/clean.php";
$Admin = new Admin();

if(isset($_GET['id'])){
    $id = clean($_GET['id']);
    $name = clean($_GET['name']);
    $roomid = clean($_GET['roomid']);
}
// var_dump(($_GET));
?>


<div class="schedInsert">
<form class="flex flex-col gap-1" method="POST">
    <h3 class="text-xl font-semibold text-gray-700 mb-3">Insert Room for <?= $name ?></h3>
    <input type="hidden" name="roomid" value="<?= $roomid ?>">
    <div>
        <label for="dayOfWeek" class="block text-lg font-medium text-gray-700">Day of the Week</label>
        <select name="day" id="dayOfWeek"
            class="mt-2 w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
            <option value="monday">Monday</option>
            <option value="tuesday">Tuesday</option>
            <option value="wednesday">Wednesday</option>
            <option value="thursday">Thursday</option>
            <option value="friday">Friday</option>
            <option value="saturday">Saturday</option>
            <option value="sunday">Sunday</option>
        </select>
    </div>
    <div class="flex gap-2">
        <div class="w-1/2">
            <label for="start_time" class="block text-lg font-medium text-gray-700">Start Time</label>
            <input
                class="mt-2 w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
                type="time" name="start_time" required>
        </div>
        <div class="w-1/2">
            <label for="end_time" class="block text-lg font-medium text-gray-700">End Time</label>
            <input
                class="mt-2 w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
                type="time" name="end_time" required>
        </div>
    </div>
    <div class="flex gap-2">
        <div class="w-1/2">
            <label for="subjects" class="block text-lg font-medium text-gray-700">Subject</label>
            <select name="subjects"
                class="mt-2 w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                <?php foreach($Admin->getSub() as $s): ?>
                <option value="<?= $s['id'] ?>"> <?= $s['SubName'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="w-1/2">
            <label for="profid" class="block text-lg font-medium text-gray-700">Professor</label>
            <select name="profid" id="profid"
                class="mt-2 w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                <?php foreach($Admin->getProf() as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="flex gap-2">
        <div class="w-1/2">
            <label for="semester" class="block text-lg font-medium text-gray-700">Semester</label>
            <select name="semester" id="semester"
                class="mt-2 w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                <option value="1st_semester">1st Semester</option>
                <option value="2nd_semester">2nd Semester</option>
            </select>
        </div>
        <div class="w-1/2">
            <label for="year" class="block text-lg font-medium text-gray-700">Year</label>
            <input
                class="mt-2 w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
                type="number" id="year" name="year" min="1900" max="2099" step="1" placeholder="Enter Year"
                required>
        </div>
    </div>
    <div class="mt-3">
        <input
            class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
            type="submit" name="submit" value="Addsched">
    </div>
</form>



</div>
<script src="../js/sched.js"></script>