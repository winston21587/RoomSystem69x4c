<?php
    require_once '../class/Roomclass.php';
   $roomObj = new Room();
    
    if(isset($_GET['bg'])){
        $dept = $_GET['bg'];
    }else{
        $dept = [];
    }
    $array = $roomObj->showAllRoom($dept);
    // $array = [];
?>



<div class="room">
    <div class="room-content">
        <table border="1">
            <tr>
                <th>Room Name</th>
                <th>Room Status</th>
                <th>Check For More Info</th>
            </tr>
            <?php if(empty($array)):?>
            <tr>
                <td colspan="3">
                    <p>No Room Found.</p>
                </td>
            </tr>
            <?php endif;?>

            <?php foreach ($array as $arr):?>
            <tr>
                <td><?= $arr['RoomName']?></td>
                <td><?= $arr['status']?></td>
                <td><button class="check-room" data-id="<?= $arr["id"]?>"> Check <?= $arr["id"]?></button></td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
<script src="../js/room.js" ></script>