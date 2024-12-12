<?php
$pageTitle = "main";
require_once "../class/Roomclass.php";
include "../includes/header.php";
// session_start();
// if(empty($_SESSION["userid"])){
//     header("location:../account/Login.php");
//     exit;
// }
// if(isset($_SESSION["userid"]) && $_SESSION["role"] == "Admin"){
//     header("location:../admin/admin.php");
//     exit;
// }
//     if(isset($_GET['id'])){
//         $roomId = $_GET['id'];
//         $roomObj = new Room();
//         $dept = NULL;
//         $roomDetails = $roomObj->fetchRoomId($roomId);
//         $subjectDetails = $roomObj->showAllSched($roomId,$dept); 

//         if(!empty($roomDetails)){
//             $roomName = $roomDetails['RoomName'];
//         } else {
//             echo "<H1>No info found in this room</H1>";
//             exit;
//         }
// } else {
//     echo "<H1>No info found in this room</H1>";
//     exit;
//  }

//  if(isset($confirmUse)){
//     $message = "Input Received";
// } else {
//     $message = "No input received";
// }     

$roomObj = new Room();

$array = $roomObj->showNewSched();

?>

<style>
    th,td{
        border: 5px black solid;
        padding: 5px;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<body>
    <a href="MainPageUI.php"><--< /a>

            <table border="1">
                <tr>
                    <th>Room Id</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Subject Name</th>
                    <th>Prof Name</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($array as $arr): ?>
                    <tr>
                        <td><?= $arr["RoomName"] ?></td>
                        <td><?= $arr["DayOfWeek"] ?></td>
                        <td><?= $arr["start_time"] ?></td>
                        <td><?= $arr["end_time"] ?></td>
                        <td><?= $arr["SubName"] ?></td>
                        <td><?= $arr["profName"] ?></td>
                        <td><button>Request</button></td>
                    </tr>
                <?php endforeach; ?>
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
            <script>
                updateClock();
            </script>
</body>

</html>

<?php
include "../includes/footer.php";
?>