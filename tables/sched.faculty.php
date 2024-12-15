<?php
// $dept = 'CCS';
session_start();
require_once "../class/adminClass.php";
require_once "../class/Roomclass.php";
include "../Func/clean.php";
$Admin = new Admin();
$depart = NULL;

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$facID = $_SESSION['facultyId'];
?>

<?php foreach($Admin->showAllSched($id) as $r): ?>
<tr>
    <td class="px-4 py-2 border-b border-gray-300"><?= $r['DayOfWeek'] ?></td>
    <td class="px-4 py-2 border-b border-gray-300"><?= $r['start_time'] ?></td>
    <td class="px-4 py-2 border-b border-gray-300"><?= $r['end_time'] ?></td>
    <td class="px-4 py-2 border-b border-gray-300"><?= $r['subjectN'] ?></td>
    <td class="px-4 py-2 border-b border-gray-300"><?= $r['professor'] ?></td>
    <td class="px-4 py-2 border-b border-gray-300" ><button
     data-id="<?= $r['SchedID'] ?>"
     data-send="<?= $r['professor'] ?>"
     data-reqto="<?= $r['facultyID'] ?>"
     data-facid="<?= $facID ?>"   class="requestBTN" >Request</button></td>
</tr>
<?php endforeach; ?>
<script src="../js/admin.js"></script>