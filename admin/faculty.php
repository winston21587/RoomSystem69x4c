<?php
require_once "../class/adminClass.php";
require_once "../class/Roomclass.php";
include "../Func/clean.php";
$pageTitle = "Admin";
include "../includes/header.php";
session_start();

if(empty($_SESSION["userid"]) || $_SESSION['role'] != "Staff"){
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
        <h1 class="text-4xl font-bold text-black uppercase">Faculty</h1>
        <h1 class="text-4xl text-black uppercase"><?= $_SESSION['username'] ?></h1>
        <button class="px-4 py-2 bg-black text-white rounded"><a href="../account/logout.php">Logout</a></button>
    </div>
    <div class="inbox p-5 px-12" >
    <h1 class="text-4xl text-center text-gray-800 mt-10">Inbox</h1>
        <table class=" RoomTable display" >
            <thead>
                <tr>
                    <th>Request</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Room</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($Admin->displayRequest($_SESSION['username']) as $d): ?>
                        <tr>
                            <td><?= ($d['Name'] == $_SESSION['username']) ? "Accept" : "Requested"; ?></td>
                            <td><?= ($d['Name'] == $_SESSION['username']) ? $d['sender'] : $d['Name'] ?></td>
                            <td><?= $d['Department'] ?></td>
                            <td><?= $d['Room'] ?></td>
                            <td><?= $d['start']. " ".$d['end'] ?></td>
                            <td><?= $d['status'] ?></td>
                            <td>
                                <?php if($d['Name'] == $_SESSION['username']): ?>
                                    <button data-id="<?= $d['id'] ?>" class="AcceptRequestBTN" >Accept</button>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="table-content w-full flex flex-row justify-around pb-7">
        <div class="inbox" >
        <h1 class="text-4xl text-center text-gray-800 mt-10">Faculty Room Schedule</h1>
    <div class="max-w-md mx-auto mt-8 bg-white p-6 rounded-lg shadow-lg">
        <form method="POST">

            <div class="mb-4">
                <label for="FacultyDepartment" class="block text-lg font-medium text-gray-700">Department</label>
                <select name="FacultyDepartment"  id="FacultyDepartment" class="w-full mt-2 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 FacultyDepartment" required>
                <option disabled selected>Choose Department</option>

                <?php foreach($Admin->getDept() as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['deptName'] ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4 RoomDept ">

            </div>

        </form>

    </div>
        </div>

        <div class="table-2 mt-4">
            <div class="table-2-head flex w-full justify-between px-4 items-center p-4">
                <h2 class="text-4xl  ScheduleText">Schedules</h2>
            </div>

            <table>
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left border-b border-gray-300">Day</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Start Time</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">End Time</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Subject</th>
                        <th>Professor</th>
                        <th>Submit</th>
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



<?php include "../includes/footer.php" ?>
</html>