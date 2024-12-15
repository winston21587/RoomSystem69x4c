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


<div class="schedInsert" >
    <form class="flex flex-col justify-end items-start" method="POST">
        <h3>Insert Room for <?= $name ?></h3>
        <input type="hidden" name="roomid" value="<?= $roomid ?>" >
        <select name="day" id="dayOfWeek">
            <option value="monday">monday</option>
            <option value="tuesday">tuesday</option>
            <option value="wednesday">wednesday</option>
            <option value="thursday">thursday</option>
            <option value="friday">friday</option>
            <option value="saturday">saturday</option>
            <option value="sunday">sunday</option>
        </select>
        <input type="time" name="start_time" >
        <input type="time" name="end_time" >
        <select name="subjects">
            <?php foreach($Admin->getSub() as $s): ?>
                <option value="<?= $s['id'] ?>"> <?= $s['SubName'] ?></option>
            <?php endforeach; ?> 
        </select>
        <select 
                name="profid" 
                id="profid" 
                class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            >  
                <?php foreach($Admin->getProf() as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <select name="semester" id="semester">
                <option value="1st_semester">1st-semester</option>
                <option value="2nd_semester">2nd-semester</option>
            </select>
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" min="1900" max="2099" step="1" placeholder="Enter Year">

        <input class="rounded text-black bg-blue-300 px-4 py-1" type="submit" name="submit" value="Addsched">
    </form>
</div>