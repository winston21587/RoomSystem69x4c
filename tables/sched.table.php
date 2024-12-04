<?php
// $dept = 'CCS';
require_once "../class/adminClass.php";
require_once "../class/Roomclass.php";
include "../Func/clean.php";
session_start();
$Room = new Room();
$depart = NULL;
if(isset($_GET['id'])){
    $id = $_GET['id'];
}

?>

<?php foreach($Room->showAllSched($id,$depart) as $r): ?>
<tr>
    <td class="px-4 py-2 border-b border-gray-300"><?= $r['DayOfWeek'] ?></td>
    <td class="px-4 py-2 border-b border-gray-300"><?= $r['start_time'] ?></td>
    <td class="px-4 py-2 border-b border-gray-300"><?= $r['end_time'] ?></td>
    <td class="px-4 py-2 border-b border-gray-300"><?= $r['subject'] ?></td>
    <td class="px-4 py-2 border-b border-gray-300"><button data-id="<?= $r['id'] ?>">Edit</button></td>
    <td class="px-4 py-2 border-b border-gray-300"><button data-id="<?= $r['id'] ?>">Delete</button></td>
</tr>
<?php endforeach; ?>
<script src="../js/admin.js"></script>