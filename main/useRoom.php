<?php
    $pageTitle = "main";
    require_once "../class/Roomclass.php";
    include "../includes/header.php";
    session_start();
    if(empty($_SESSION["userid"])){
        header("location:../account/Login.php");
        exit;
    }
    if(isset($_SESSION["userid"]) && $_SESSION["role"] == "Admin"){
        header("location:../admin/admin.php");
        exit;
    }
        if(isset($_GET['id'])){
            $roomId = $_GET['id'];
            $roomObj = new Room();
            $dept = NULL;
            $roomDetails = $roomObj->fetchRoomId($roomId);
            $subjectDetails = $roomObj->showAllSched($roomId,$dept); 

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
<body>
    <a href="MainPageUI.php"><--</a>
    <h1>Schedule for room <?= $roomName?></h1> <br>
    <h2>Current time: <span id="clock"></span></h2> <br>
    <button>Use this room</button> <br> <br>
    <table border="1">
        <tr>
            <th>Subject</th>
            <th>Start</th>
            <th>End</th>
            <th>Info</th>
        </tr>

        <!-- added handling for other depts kase ala pa man sila subs -->
        <?php if(empty($subjectDetails)):?> 
            <tr>
                <td colspan="3">
                    <span>
                        No Subjects found.
                    </span>
                </td>
            </tr>
        <?php endif;?>

        <?php foreach($subjectDetails as $subArr): ?>
            <tr> 
                    <td><?= $subArr["subject"]?></td>
                    <td><?= $subArr["start_time"]?></td>
                    <td><?= $subArr["end_time"]?></td>
                    <td><button>Check</button></td>
            </tr>
        <?php endforeach;?>
    </table>

    <script>
        function updateClock() {
            const now = new Date();
            document.getElementById('clock').innerText = now.toLocaleString();
        }
        setInterval(updateClock, 1000);
    </script>
    <script>updateClock();</script>
</body>
</html>