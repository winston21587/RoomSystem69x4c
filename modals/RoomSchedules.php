<?php
    require "../class/Roomclass.php";
    date_default_timezone_set('Asia/Manila'); //correct timezone natin


    $Currenttime = date("g:i:s a");

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['time'], $_POST['bg'])) {
        $timeOut = $_POST['time'];
        $roomId = $_POST['bg'];
    
        if (!empty($timeOut) && !empty($roomId)) {
            $roomObj = new Room();
            $result = $roomObj->roomAvail($roomId);
    
            if ($result) {
                echo "<p>Room status updated successfully. Time Out: $timeOut</p>";
            } else {
                echo "<p>Failed to update room status.</p>";
            }
        } else {
            echo "<p>Error: Please provide all required information.</p>";
        }
    }
    
?>

<div>
    <h1> FROM: <?= $Currenttime ?></h1>

    <form method="POST" id="timeForm">
        <h2 style="display: inline;">TO: </h2>
        <input id="timeOut" type="time" name="time"><br>
        <input type="submit" id="confirmUse" name="confirmUse">
    </form>
</div>

<script src="../js/sched.js"></script>