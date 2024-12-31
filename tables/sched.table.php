<?php
// $dept = 'CCS';
require_once "../class/adminClass.php";
require_once "../class/Roomclass.php";
include "../Func/clean.php";
include "../Func/time.php";
session_start();
$Admin = new Admin();
$depart = NULL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

?>

<?php foreach ($Admin->showAllSched($id) as $r): ?>
    <tr class="even:bg-gray-300">
        <td class="px-4 py-2 border-b border-gray-300"><?= $r['DayOfWeek'] ?></td>
        <td class="px-4 py-2 border-b border-gray-300"><?= convert($r['start_time']) ?></td>
        <td class="px-4 py-2 border-b border-gray-300"><?= convert($r['end_time']) ?></td>
        <td class="px-4 py-2 border-b border-gray-300"><?= $r['subjectN'] ?></td>
        <td class="px-4 py-2 border-b border-gray-300"><?= $r['professor'] ?></td>
        <td class="px-4 py-2 border-b border-gray-300"><button class="EditSched  text-blue-600 font-bold"
                data-id="<?= $r['SchedID'] ?>"
                data-day="<?= $r['DayOfWeek'] ?>"
                data-start="<?= $r['start_time'] ?>"
                data-end="<?= $r['end_time'] ?>"
                data-sub="<?= $r['subjectN'] ?>"
                data-prof="<?= $r['professor'] ?>"
                data-year="<?= $r['schoolYear'] ?>"
                data-sem="<?= $r['semester'] ?>">Edit</button></td>
        <td class="px-4 py-2 border-b border-gray-300 "><button class="DeleteSched  text-red-600 font-bold" data-id="<?= $r['SchedID'] ?>">Delete</button></td>
    </tr>
<?php endforeach; ?>

<script src="../js/admin.sched.js"></script>
