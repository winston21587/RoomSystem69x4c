<?php
    require_once "../class/Roomclass.php";

    if(isset($_GET['id'])){
        $roomId = $_GET['id'];

        $roomObj = new Room();

        $roomDetails = $roomObj->fetchRoomId($roomId);
       $subjectDetails = $roomObj->showAllSched();

        if(!empty($roomDetails)){
            $roomName = $roomDetails['RoomName'];
        } else {
            echo "<H1>No info found in this room</H1>";
            exit;
        }
    } else {
        echo "<H1>No info found in this room</H1>";
        exit;
     }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>
        function updateClock() {
            const now = new Date();
            document.getElementById('clock').innerText = now.toLocaleString();
        }

        setInterval(updateClock, 1000);
    </script>
</head>
<body>
    <h1>Schedule for room <?= $roomName?></h1> <br>
    <h2>Current time: <span id="clock"></span></h2> <br>
    <button>Use this room</button> <br> <br>
    <table border="1">
        <tr>
            <th>Subject</th>
            <th>Start</th>
            <th>End</th>
        </tr>
        <?php foreach($subjectDetails as $subArr): ?>
            <tr> 
                    <td><?= $subArr["subject"]?></td>
                    <td><?= $subArr["start_time"]?></td>
                    <td><?= $subArr["end_time"]?></td>
            </tr>
        <?php endforeach;?>
    </table>

    <script>updateClock();</script>
</body>
</html>