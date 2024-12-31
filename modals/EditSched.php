
<?php
    require_once "../class/adminClass.php";
    require_once "../Func/clean.php";

    $Admin = new Admin();
    if(isset($_GET['id'])){
        $id = clean($_GET['id']);
        $start = clean($_GET['start']);
        $end = clean($_GET['end']);
        $day = clean($_GET['day']);
        $sub = clean($_GET['sub']);
        $prof = clean($_GET['prof']);
        $year = clean($_GET['year']);
        $sem = clean($_GET['sem']);
        
    }

?>
<div id="editRoom" class=" items-start bg-white">
<form class="flex flex-col justify-center gap-2" method="POST">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div>
        <label for="dayOfWeek" class="block text-lg font-medium text-gray-700">Day of the Week</label>
        <select name="day" id="dayOfWeek"
            class="mt-2 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            <option <?= ($day == 'monday') ? 'selected' : '' ?> value="monday">Monday</option>
            <option <?= ($day == 'tuesday') ? 'selected' : '' ?> value="tuesday">Tuesday</option>
            <option <?= ($day == 'wednesday') ? 'selected' : '' ?> value="wednesday">Wednesday</option>
            <option <?= ($day == 'thursday') ? 'selected' : '' ?> value="thursday">Thursday</option>
            <option <?= ($day == 'friday') ? 'selected' : '' ?> value="friday">Friday</option>
            <option <?= ($day == 'saturday') ? 'selected' : '' ?> value="saturday">Saturday</option>
            <option <?= ($day == 'sunday') ? 'selected' : '' ?> value="sunday">Sunday</option>
        </select>
    </div>
    <div class="flex gap-2">
        <div class="w-1/2">
            <label for="start" class="block text-lg font-medium text-gray-700">Start Time</label>
            <input
                class="mt-2 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                type="time" name="start" value="<?= $start ?>" required>
        </div>
        <div class="w-1/2">
            <label for="end" class="block text-lg font-medium text-gray-700">End Time</label>
            <input
                class="mt-2 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                type="time" name="end" value="<?= $end ?>" required>
        </div>
    </div>
    <div class="flex gap-2">
        <div class="w-1/2">
            <label for="sub" class="block text-lg font-medium text-gray-700">Subject</label>
            <select name="sub"
                class="mt-2 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <?php foreach($Admin->getSub() as $s): ?>
                <option <?= ($sub == $s['SubName']) ? 'selected' : '' ?> value="<?= $s['id'] ?>"> <?= $s['SubName'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="w-1/2">
            <label for="profid" class="block text-lg font-medium text-gray-700">Professor</label>
            <select name="prof" id="profid"
                class="mt-2 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <?php foreach($Admin->getProf() as $c): ?>
                <option <?= ($prof == $c['name']) ? 'selected' : '' ?> value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="flex gap-2">
        <div class="w-1/2">
            <label for="semester" class="block text-lg font-medium text-gray-700">Semester</label>
            <select name="sem" id="semester"
                class="mt-2 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <option <?= ($sem == '1st_semester') ? 'selected' : '' ?> value="1st_semester">1st Semester</option>
                <option <?= ($sem == '2nd_semester') ? 'selected' : '' ?> value="2nd_semester">2nd Semester</option>
            </select>
        </div>
        <div class="w-1/2">
            <label for="year" class="block text-lg font-medium text-gray-700">Year</label>
            <input
                class="mt-2 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                type="number" id="year" name="year" min="1900" max="2099" step="1" value="<?= $year ?>" required>
        </div>
    </div>
    <div class="mt-1">
        <input
            class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
            type="submit" name="submit" value="Editsched">
    </div>
</form>

</div>