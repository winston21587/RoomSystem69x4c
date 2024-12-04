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

     if(isset($confirmUse)){
        $message = "Input Received";
    } else {
        $message = "No input received";
    }     
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <a href="MainPageUI.php"><--</a>
    <h1>Schedule for room <?= $roomName?> STATUS: <?= $roomDetails["status"]?></h1> <br>
    <h2>Current time: <span id="clock"></span></h2> <br>
    <button class="Addsched" data-bg="<?= $roomId?>">Use this room</button> <br> <br>

    <h1><span id="displayTime"></span></h1>


    <table border="1">
        <tr>
            <th>Subject</th>
            <th>Start</th>
            <th>End</th>
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
            </tr>
        <?php endforeach;?>
    </table>
    
    <div id="customModal" class="modal">
        <div class="modal-content">
            <button id="closeModal" class="close">close</button>
            <div id="modalBody">

            </div>
        </div>
    </div>

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

<?php
    include "../includes/footer.php";
?>