<?php

require_once "../class/adminClass.php";
$Admin = new Admin();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $name = $_GET['name'];
}
// var_dump(($_GET));
?>


<div class="schedInsert" >
    <form class="flex flex-col justify-end items-start" method="POST">
        <input type="hidden" name="roomid" value="<?= $id ?>" >
        <h3>Insert Room for <?= $name ?></h3>
        <select name="day" id="dayOfWeek">
            <option value="moday">monday</option>
            <option value="tuesday">tuesday</option>
            <option value="wednesday">wednesday</option>
            <option value="thursday">thursday</option>
            <option value="friday">friday</option>
            <option value="saturday">saturday</option>
            <option value="sunday">sunday</option>
        </select>
        <input type="time" name="start_time">
        <input type="time" name="end_time">
        <select name="subjects">
            <?php foreach($Admin->getSub() as $s): ?>
                <option value="<?= $s['id'] ?>"> <?= $s['SubName'] ?></option>
            <?php endforeach; ?> 
        </select>
        <input class="rounded text-black bg-blue-300 px-4 py-1" type="submit" name="submit" value="Addsched">
    </form>
</div>