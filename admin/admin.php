<?php
require_once "../class/adminClass.php";
require_once "../class/Roomclass.php";
include "../Func/clean.php";
$pageTitle = "Admin";
include "../includes/header.php";
session_start();

if(empty($_SESSION["userid"]) || $_SESSION['role'] != "Admin"){
    header("location:../account/Login.php");
    exit;
}

    $Admin = new Admin();
    $Room = new Room();
    // var_dump($_POST);
    // var_dump($Admin);

    if(isset($_POST["submit"] )  && $_SERVER['REQUEST_METHOD'] == 'POST' ){
    $Admin->roomname = clean($_POST['RoomName']);
    $Admin->department = clean($_POST['department']);
    
    if($Admin->CheckUnqRoom()){
        if($Admin->addRoom()){
            echo "<p> added successdfully </p>";
        }else{
            echo "<p> added unsuccessfully </p>";
        }
    }else{
        echo "found room";
    }
    header("location:". $_SERVER['PHP_SELF']);
    exit;

}

?>

<!DOCTYPE html>
<html lang="en">

<body>

    <div class="flex flex-row w-full p-6 px-16 justify-between text-center items-center">
        <button onclick="open()" >click</button>
        <h1 class="text-4xl font-bold text-black">Admin</h1>
        <button class="px-4 py-2 bg-black text-white rounded"><a href="../account/logout.php">Logout</a></button>
    </div>
    <div class="table-content w-full flex flex-row justify-around ">
        <div class="table-1">
            <div class="table-1-head flex flex-row w-full justify-between items-center p-6">
                <h2 class="font-bold text-2xl">Rooms</h2>
                <button class=" addRoomBtn px-4 py-2 bg-blue-500 text-white rounded" onclick="alertthis()" >Add Room</button>
            </div>
            <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left border-b border-gray-300">Room id</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Room name</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Status</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">add room</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Edit</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($Admin->ShowRooms() as $r):   ?>
                    <tr>
                        <td class="px-4 py-2 border-b border-gray-300"><?= $r['id']; ?></td>
                        <td class="px-4 py-2 border-b border-gray-300"><?= $r['RoomName']; ?></td>
                        <td class="px-4 py-2 border-b border-gray-300"><?= $r['department']; ?></td>
                        <td class="px-4 py-2 border-b border-gray-300"><?= $r['status']; ?></td>
                        <td class="px-4 py-2 border-b border-gray-300"><button class="EditRoom"
                                data-id="<?= $r['id']; ?>">Edit</button></td>
                        <td class="px-4 py-2 border-b border-gray-300"><button class="DeleteRoom"
                                data-id="<?= $r['id']; ?>">Delete</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="table-2">
            <div class="table-2-head flex w-full justify-between px-4 items-center p-4">
                <h2 class="text-xl font-bold" >Schedules</h2>
                <button class="px-4 py-2 bg-blue-500 text-white rounded">Insert Schedule</button>
            </div>
            <table>
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left border-b border-gray-300">Day</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Start Time</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">End Time</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Subject</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Manage</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($Room->showAllSched($depart) as $r): ?>
                    <td class="px-4 py-2 border-b border-gray-300"><?= $r['DayOfWeek'] ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?= $r['start_time'] ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?= $r['end_time'] ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?= $r['subject'] ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><button>Edit</button></td>
                    <td class="px-4 py-2 border-b border-gray-300"><button>Delete</button></td>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <a href="../account/logout.php">logout</a>
</body>

<div id="customModalAdmin" class="modal ">
        <div class="modal-content">
            <button id="closeModalAdmin" class="close">close</button>
            <div id="modalBodyAdmin">

            </div>
        </div>
    </div>


</html>
<?php include "../includes/footer.php";
?>
<script>
    function open(){
        alert("clicked");
    }
</script>

