<?php
// $dept = 'CCS';
session_start();
require_once "../class/adminClass.php";
require_once "../class/Roomclass.php";
include "../Func/clean.php";
$Admin = new Admin();
$depart = NULL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$facID = $_SESSION['facultyId'];
?>

<?php foreach ($Admin->showAllSched($id) as $r): ?>
    <tr>
        <td class="px-4 py-2 border-b border-gray-300 text-center"><?= $r['DayOfWeek'] ?></td>
        <td class="px-4 py-2 border-b border-gray-300 text-center"><?= $r['start_time'] ?></td>
        <td class="px-4 py-2 border-b border-gray-300 text-center"><?= $r['end_time'] ?></td>
        <td class="px-4 py-2 border-b border-gray-300 text-center"><?= $r['subjectN'] ?></td>
        <td class="px-4 py-2 border-b border-gray-300 text-center"><?= $r['professor'] ?></td>

        <?php if($facID != $r['facultyID']):?>
            <td class="px-4 py-2 border-b border-gray-300 text-center"><button
                    data-id="<?= $r['SchedID'] ?>"
                    data-send="<?= $r['professor'] ?>"
                    data-reqto="<?= $r['facultyID'] ?>"
                    data-facid="<?= $facID ?>" class="requestBTN">Request</button>
            </td>
        <?php endif;?>
    </tr>
<?php endforeach; ?>
<script src="../js/admin.js"></script>