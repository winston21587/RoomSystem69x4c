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
    // var_dump($_GET);
    // var_dump($_SESSION['w']);
    // var_dump($Admin);
    $id;
    // $depart = NULL;
    $_SESSION['err'] = 'good';
    
    if(isset($_POST["submit"] )  && $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["submit"] == 'add' ){
        $room = clean($_POST['RoomName']);
        $dept = clean($_POST['department']);
    if($Admin->CheckUnqRoom($room)){
        if($Admin->addRoom($room,$dept)){
               header("location:". $_SERVER['PHP_SELF']);
               exit;
        }else{
            echo "<p> added unsuccessfully </p>";
        }
    }else{
        echo "<p>room name already exist</p>";
    }
}
    if(isset($_POST["submit"] )  && $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["submit"] == 'Addsched' ){
        $day = clean($_POST['day']);
        $start_time = clean($_POST['start_time']);
        $end_time = clean($_POST['end_time']);
        $sub = clean($_POST['subjects']);
        $roomid = clean($_POST['roomid']);

        $start_time = date("H:i:s", strtotime($start_time));
        $end_time = date("H:i:s", strtotime($end_time));

     if($Admin->AddSched($roomid,$day,$start_time,$end_time,$sub)){
            header("location:". $_SERVER['PHP_SELF']);
            exit;
        }
    }





?>

<!DOCTYPE html>
<html lang="en">

<body class="w-full h-full">

    <div class="flex flex-row w-full p-6 px-16 justify-between mb-4 text-center items-center shadow-lg ">
        <h1 class="text-4xl font-bold text-black uppercase">Admin</h1>
        <button class="px-4 py-2 bg-black text-white rounded"><a href="../account/logout.php">Logout</a></button>
    </div>
    <div class="table-content w-full flex flex-row justify-around pb-7">
        <div class="table-1">
            <div class="table-1-head flex flex-row w-full justify-between items-center p-6">
                <h2 class="font-bold text-2xl">Rooms</h2>
                <button id="Addbtn" class=" addRoomBtn px-4 py-2 bg-blue-500 text-white rounded">Add Room</button>
            </div>
            <table class=" RoomTable display">
                <thead>
                    <tr >
                        <th>Room id</th>
                        <th>Room name</th>
                        <th>Department</th>
                        <th></th>
                        <th>Manage</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="showroombody" >
                <?php foreach($Admin->ShowRooms() as $r):   ?>
                    <tr>
                        <td ><?= $r['id']; ?></td>
                        <td ><?= $r['RoomName']; ?></td>
                        <td ><?= $r['department']; ?></td>
                        <td ><button class="checkSched"
                                data-id="<?= $r['id'] ?>" data-name="<?= $r['RoomName'] ?>">Check Schedule</button></td>

                        <td ><button class="EditRoom"
                                data-id="<?= $r['id']; ?>" data-room="<?= $r['RoomName'] ?>"
                                data-dept="<?= $r['department'] ?>" data-status="<?= $r['status'] ?>">Edit</button>
                        </td>
                        <td ><button class="DeleteRoom"
                                data-id="<?= $r['id']; ?>" data-room="<?= $r['RoomName'] ?>"
                                data-dept="<?= $r['department'] ?>" data-status="<?= $r['status'] ?>">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                
                </tbody>
            </table>
        </div>
        <div class="table-2">
            <div class="table-2-head flex w-full justify-between px-4 items-center p-4">
                <h2 class="text-xl font-bold ScheduleText">Schedules</h2>
                <button class="px-4 py-2 bg-blue-500 text-white rounded" id="schedInsert">Insert Schedule</button>
            </div>

            <table>
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left border-b border-gray-300">Day</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">end Time</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">End Time</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Subject</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Manage</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Delete</th>
                    </tr>
                </thead>
                <tbody id="schedForRoom">
                
                </tbody>
            </table>
        </div>
    </div>

    <div id="customModalAdmin"
        class="AddRoomModal hidden fixed inset-0 bg-black bg-opacity-40 z-50  justify-center items-center backdrop-blur-sm">
        <div
            class="RoomAddbody flex flex-col justify-center items-end bg-white p-6 rounded-lg border border-gray-300 w-11/12 max-w-lg text-center shadow-lg absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <button id="closeModalAdmin" class="closeRoom px-4 py-2 rounded bg-black m-1 text-white">close</button>
            <div id="modalBodyAdmin" class="py-4 w-full">
                <?php include "../modals/Admin.add.php" ?>
            </div>
        </div>
    </div>

    <div
        class="ManageModal hidden fixed inset-0 bg-black bg-opacity-40 z-50  justify-center items-center backdrop-blur-sm">
        <div
            class="RoomManagebody flex flex-col justify-center items-end bg-white p-6 rounded-lg border border-gray-300 w-11/12 max-w-lg text-center shadow-lg absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <button id="closeModalManage"
                class="closeRoomManage px-4 py-2 rounded bg-black m-1 text-white">close</button>
            <div class="ModalManageBody py-4 w-full">

            </div>
        </div>
    </div>

</body>

<script>
    const Addbtn = document.getElementById('Addbtn');
const modalBack = document.getElementById('customModalAdmin');
const closeAddBtn = document.getElementById('closeModalAdmin');

Addbtn.addEventListener('click', function() {
    modalBack.classList.remove("hidden");
});

closeAddBtn.addEventListener('click', function() {
    modalBack.classList.add("hidden");
});

</script>


<?php include "../includes/footer.php" ?>
</html>