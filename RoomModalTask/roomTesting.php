<?php
    include './class/Room.class.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table{
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    
    $roomObj = new Room();
    $array = $roomObj->showAllRoom();
    ?>

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
                <td><button><a href="useRoom.php?id=<?= $arr["id"]?>">Check <?= $arr["id"]?></a></button></td>
            </tr>
        <?php endforeach;?>
    </table>
</body>
</html>