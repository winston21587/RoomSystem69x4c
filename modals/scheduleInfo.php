<?php



require_once "../class/adminClass.php";
require_once "../Func/clean.php";
require_once "../Func/time.php";

$Admin = new Admin();
if(isset($_GET['id'])){
    $id = clean($_GET['id']);

    }
$data = $Admin->DisplaySchedID($id);
?>


<div class="bg-white ">
    <h1 class="text-lg font-semibold text-gray-700">
        <?= convert($data['start_time']) ?> to <?= convert($data['end_time']) ?>
    </h1>
    <p class="text-sm text-gray-500"><?= $data['DayOfWeek'] ?></p>

    <div class="subINFO mt-3">
        <p class="text-md font-medium text-gray-800"><?= $data['subjectN'] ?></p>
    </div>    

    <div class="roomINFO mt-4 space-y-1">
        <p class="text-sm text-gray-600">
            <span class="font-semibold">Room:</span> <?= $data['RoomName'] ?>
        </p>
        <p class="text-sm text-gray-600">
            <span class="font-semibold">Type:</span> <?= $data['RoomType'] ?>
        </p>
        <p class="text-sm text-gray-600">
            <span class="font-semibold">Building:</span> <?= $data['Building'] ?>
        </p>
    </div>
</div>


</div>