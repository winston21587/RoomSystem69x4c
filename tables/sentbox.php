<?php
require_once "../class/adminClass.php";
include "../Func/clean.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$Admin = new Admin();
$FID = $_SESSION['facultyId'];
?>
<thead class="bg-red-300">
    <tr>
        <th class="px-4 py-2 text-center">Requested To</th>
        <th class="px-4 py-2 text-center">Room</th>
        <th class="px-4 py-2 text-center">schedule</th>
        <th class="px-4 py-2 text-center">Date Requested</th>
        <th class="px-4 py-2 text-center">Date to Use</th>
        <th class="px-4 py-2 text-center">Status</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($Admin->sentBox($FID) as $d): ?>
        <tr>
            <td class="px-4 py-2 text-center"><?= $d['professor'] ?></td>
            <td class="px-4 py-2 text-center"><?= $d['Roomname'] ?></td>
            <td class="px-4 py-2 text-center"><button class="ScheduleBTN" data-sched="<?= $d['sched'] ?>">check</button></td>
            <td class="px-4 py-2 text-center"><?= $d['DateRequested'] ?></td>
            <td class="px-4 py-2 text-center"><?= $d['DateOfUse'] ?></td>
            <td class="px-4 py-2 text-center">
                <?php
                if ($d['status'] == "Approved") {
                    echo "<p class='bg-green-300 p-2 font-bold'> Approved </p>";
                } else if ($d['status'] == "Pending") {
                    echo "Pending";
                } else {
                    echo "Rejected";
                }
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

<script src="../js/admin.js"></script>