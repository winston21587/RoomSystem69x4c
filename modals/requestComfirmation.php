<?php
    require_once "../class/adminClass.php";
    include "../Func/clean.php";
    session_start();
    $Admin = new Admin();

    if(isset($_GET['dept'])){
        $department = clean($_GET['dept']);
    }
?>

<div>
    <h1>Send Request?</h1>
    <label for="facultyName">Select Faculty Member:</label>
    <select name="facultyName" id="facultyName">
        <option selected disabled>--Select--</option>
        <?php foreach($Admin->showFaculty($department) as $f): ?>
            <option value="<?= $f['id'] ?>"><?= $f['username'] ?></option>
        <?php endforeach; ?>

    </select>
    <button id="RequestAproved" >Yes</button>
    <button id="RequestDenied" >No</button>
</div>