<?php



require_once "../class/adminClass.php";
require_once "../Func/clean.php";

$Admin = new Admin();
if(isset($_GET['id'])){
    $id = clean($_GET['id']);

    }
$data = $Admin->DisplaySchedID($id);
?>


<div>
    <h1><?= $data['start_time'], ' to ',$data['end_time'] ?> </h1>
    <p><?= $data['DayOfWeek'] ?></p>

    <div class="subINFO">
        <p><?= $data['subjectN'] ?></p>
    </div>    
    <div class="roomINFO" >
        <p><?= $data['RoomName'] ?></p>
        <p><?= $data['RoomType'] ?></p>
        <p><?= $data['Building'] ?></p>
    </div>

</div>