<?php
// $dept = 'CCS';
require_once "../class/adminClass.php";
session_start();
$Admin = new Admin();

if(isset($_GET['dept'])){
    $dept = $_GET['dept'];
    if($dept == 'all'){
        $dept = '';
    } 
    $_SESSION['current_dept_tab'] = $dept;
}

?>

<?php foreach($Admin->ShowRooms($dept) as $r):   ?>
<tr>
    <td class="px-4 py-2 border-b border-gray-300"><?= $r['id']; ?></td>
    <td class="px-4 py-2 border-b border-gray-300"><?= $r['RoomName']; ?></td>
    <td class="px-4 py-2 border-b border-gray-300"><?= $r['department']; ?></td>
    <td class="px-4 py-2 border-b border-gray-300"><button class="checkSched" data-id="<?= $r['id']; ?>">Check
            Schedule</button></td>

    <td class="px-4 py-2 border-b border-gray-300"><button class="EditRoom" data-id="<?= $r['id']; ?>"
            data-room="<?= $r['RoomName'] ?>" data-dept="<?= $r['department'] ?>"
            data-status="<?= $r['status'] ?>">Edit</button>
    </td>
    <td class="px-4 py-2 border-b border-gray-300"><button class="DeleteRoom" data-id="<?= $r['id']; ?>"
            data-room="<?= $r['RoomName'] ?>" data-dept="<?= $r['department'] ?>"
            data-status="<?= $r['status'] ?>">Delete</button>
    </td>
</tr>
<?php endforeach; ?>

<script src="../js/admin.js"></script>