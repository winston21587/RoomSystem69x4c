<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pageTitle = "Admin";
require_once "../class/adminClass.php";
require_once "../class/Roomclass.php";
include "../Func/clean.php";
include "../includes/header.php";
session_start();

if (empty($_SESSION["userid"])) {
    header("location:../account/Login.php");
    exit;
}
if ($_SESSION['role'] == "Student") {
    header("location:../main/MainPageUI.php");
    exit;
}
if ($_SESSION['role'] == "Faculty") {
    header("location:../admin/faculty.php");
    exit;
}

$Admin = new Admin();
$Room = new Room();
// var_dump($_POST);
// var_dump($_GET);
// var_dump($_SESSION['w']);
// var_dump($Admin);
// $id;
// $depart = NULL;
//     $_SESSION['err'] = 'good';

if (isset($_POST["submit"])  && $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["submit"] == 'add') {
    $room = clean($_POST['RoomName']);
    $dept = clean($_POST['department']);
    $RoomType = clean($_POST['RoomType']);
    $floor = clean($_POST['floor']);
    $building = clean($_POST['building']);
    if ($Admin->CheckUnqRoom($room)) {
        if ($Admin->addRoom($room, $dept, $floor, $RoomType, $building)) {
            header("location:" . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "<p> added unsuccessfully </p>";
        }
    } else {
        echo "<p>room name already exist</p>";
    }
}

if (isset($_POST["submit"])  && $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["submit"] == 'editRoom') {
    $id = clean($_POST['id']);
    $roomname = clean($_POST['RoomName']);
    $department = clean($_POST['department']);
    $floor = clean($_POST['floor']);
    $type = clean($_POST['RoomType']);
    $building = clean($_POST['Building']);

    if ($Admin->EditRooms($id, $roomname, $department, $floor, $type, $building)) {
        header("location:" . $_SERVER['PHP_SELF']);
        exit;
    }
}

if (isset($_POST["submit"])  && $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["submit"] == 'Addsched') {
    $day = clean($_POST['day']);
    $start_time = clean($_POST['start_time']);
    $end_time = clean($_POST['end_time']);
    $sub = clean($_POST['subjects']);
    $roomid = clean($_POST['roomid']);
    $profid = clean($_POST['profid']);
    $sem = clean($_POST['semester']);
    $year = clean($_POST['year']);

    $start_time = date("H:i:s", strtotime($start_time));
    $end_time = date("H:i:s", strtotime($end_time));

    if ($Admin->AddSched(
        $roomid,
        $day,
        $start_time,
        $end_time,
        $sub,
        $profid,
        $sem,
        $year
    )) {
        header("location:" . $_SERVER['PHP_SELF']);
        exit;
    }
}

if (isset($_POST["submit"])  && $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["submit"] == 'Editsched') {

    $id = clean($_POST['id']);
    $start = clean($_POST['start']);
    $end = clean($_POST['end']);
    $day = clean($_POST['day']);
    $sub = clean($_POST['sub']);
    $prof = clean($_POST['prof']);
    $sem = clean($_POST['sem']);
    $year = clean($_POST['year']);

    $Admin->EditSched(
        $id,
        $day,
        $start,
        $end,
        $sub,
        $prof,
        $sem,
        $year
    );
}
// var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">

<body class="w-full h-screen">

    <div class="flex flex-col sm:flex-row w-full p-6 px-4 sm:px-16 justify-between mb-4 text-center sm:items-center shadow-lg bg-red-600 text-white">
        <h1 class="text-2xl sm:text-4xl font-bold text-white uppercase">Faculty</h1>
        <h1 class="text-2xl sm:text-4xl text-white uppercase hidden sm:block">
            <?= $_SESSION['lastName'] . ', ' . strtoupper(substr($_SESSION['firstName'], 0, 1)) . '.' ?>
        </h1>
        <button class="px-4 py-2 bg-white text-red-600 hover:bg-red-600 hover:text-white rounded mt-4 sm:mt-0 transition duration-300 ease-in-out">
            <a href="../account/logout.php">Logout</a>
        </button>
    </div>

    <div class="table-content w-full flex flex-col gap-10 p-4 sm:p-10">
        <div class="table-1">
            <div class="table-1-head flex flex-col sm:flex-row w-full justify-between items-center p-4 gap-4">
                <h2 class="font-bold text-lg sm:text-2xl">Rooms</h2>
                <button id="Addbtn" class="addRoomBtn px-4 py-2 bg-blue-500 text-white rounded text-sm sm:text-base">
                    Add Room
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="RoomTable display w-full border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-cener">Room ID</th>
                            <th class="px-4 py-2 text-center">Room Name</th>
                            <th class="px-4 py-2 text-center">Department</th>
                            <th class="px-4 py-2 text-center"></th>
                            <th class="px-4 py-2 text-center">Manage</th>
                            <th class="px-4 py-2 text-center"></th>
                        </tr>
                    </thead>
                    <tbody class="showroombody">
                        <?php foreach ($Admin->ShowRooms() as $r): ?>
                            <tr>
                                <td><?= $r['id']; ?></td>
                                <td><?= $r['RoomName']; ?></td>
                                <td><?= $r['department']; ?></td>
                                <td>
                                    <button class="checkSched text-sm sm:text-base"
                                        data-id="<?= $r['id'] ?>" data-name="<?= $r['RoomName'] ?>">Check Schedule</button>
                                </td>
                                <td>
                                    <button class="EditRoom text-sm sm:text-base text-blue-600 font-bold" data-id="<?= $r['id']; ?>" data-room="<?= $r['RoomName'] ?>" data-floor="<?= $r['floor'] ?>" data-type="<?= $r['RoomType'] ?>" data-building="<?= $r['Building'] ?>" data-dept="<?= $r['department'] ?>">Edit</button>
                                </td>
                                <td>
                                    <button class="DeleteRoom text-sm sm:text-base  text-red-600 font-bold" data-id="<?= $r['id']; ?>" data-room="<?= $r['RoomName'] ?>" data-dept="<?= $r['department'] ?>">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-2">
            <div class="table-2-head flex flex-col sm:flex-row w-full justify-between items-center p-4 gap-4">
                <h2 class="text-lg sm:text-xl font-bold ScheduleText">Schedules</h2>
                <button id="schedInsert" class="px-4 py-2 bg-blue-500 text-white rounded text-sm sm:text-base">
                    Insert Schedule
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="SchedTable display w-full border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left">Day</th>
                            <th class="px-4 py-2 text-left">Start Time</th>
                            <th class="px-4 py-2 text-left">End Time</th>
                            <th class="px-4 py-2 text-left">Subject</th>
                            <th class="px-4 py-2 text-left">Professor</th>
                            <th class="px-4 py-2 text-left">Manage</th>
                            <th class="px-4 py-2 text-left">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="schedForRoom">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="customModalAdmin"
        class="AddRoomModal hidden fixed inset-0 bg-black bg-opacity-40 z-50 flex justify-center items-center">
        <div
            class="RoomAddbody flex flex-col justify-center items-end bg-white p-6 rounded-lg border border-gray-300 w-11/12 max-w-md sm:max-w-lg text-center shadow-lg">
            <button id="closeModalAdmin" class="closeRoom px-4 py-2 rounded bg-black text-white text-sm sm:text-base">
                Close
            </button>
            <div id="modalBodyAdmin" class="py-4 w-full">
                <?php include "../modals/Admin.add.php" ?>
            </div>
        </div>
    </div>

    <div class="ManageModal hidden fixed inset-0 bg-black bg-opacity-40 z-50 flex justify-center items-center">
        <div
            class="RoomManagebody flex flex-col justify-center items-end bg-white p-6 rounded-lg border border-gray-300 w-11/12 max-w-md sm:max-w-lg text-center shadow-lg">
            <button id="closeModalManage" class="closeRoomManage px-4 py-2 rounded bg-black text-white text-sm sm:text-base  text-blue-600 font-bold">
                Close
            </button>
            <div class="ModalManageBody py-4 w-full"></div>
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