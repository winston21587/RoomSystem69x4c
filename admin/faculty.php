<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../class/adminClass.php";
require_once "../class/Roomclass.php";
include "../Func/clean.php";
$pageTitle = "Admin";
include "../includes/header.php";
session_start();

if(empty($_SESSION["userid"])){
    header("location:../account/Login.php");
    exit;
}
if($_SESSION['role'] == "Student"){
    header("location:../main/MainPageUI.php");
    exit;
}
if($_SESSION['role'] == "Admin"){
    header("location:../admin/admin.php");
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

    
   





?>

<!DOCTYPE html>
<html lang="en">

<body class="w-full h-full">

    <div class="flex flex-row w-full p-6 px-16 justify-between mb-4 text-center items-center shadow-lg ">
        <h1 class="text-4xl font-bold text-black uppercase">Faculty</h1>
        <h1 class="text-4xl text-black uppercase"><?= $_SESSION['username'] ?></h1>
        <button class="px-4 py-2 bg-black text-white rounded"><a href="../account/logout.php">Logout</a></button>
    </div>
    <div class="inbox p-5 px-12">
        <h1 class="text-4xl text-center text-gray-800 mt-10">Inbox</h1>
        <table class=" RoomTable display">
            <thead>
                <tr>
                    <th>Requested By</th>
                    <th>Room</th>
                    <th>schedule</th>
                    <th>Date Requested</th>
                    <th>Date to Use</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($Admin->displayRequest($_SESSION['facultyId']) as $d): ?>
                    <tr>
                        <td><?= $d['professor'] ?></td>
                        <td><?= $d['Roomname'] ?></td>
                        <td><button>check</button></td>
                        <td><?= $d['DateRequested'] ?></td>
                        <td><?= $d['DateOfUse'] ?></td>
                        <td class=" p-3 rounded
                        <?= $d['status'] == 'Approved' ? 'bg-green-500 text-white' : ($d['status'] == 'Pending' ? 'bg-yellow-500 text-white' : 'bg-red-500 text-white') ?>"
                         ><?= $d['status'] ?></td>
                        <td><button class="bg-blue-500 rounded p-3 AcceptRequestBTN" data-id="<?= $d['id'] ?>" >accept</button></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="table-content w-full flex flex-row justify-around pb-7">
        <div class="inbox">
            <h1 class="text-4xl text-center text-gray-800 mt-10">Faculty Room Schedule</h1>
            <div class="max-w-md mx-auto mt-8 bg-white p-6 rounded-lg shadow-lg">
                <form method="POST">

                    <div class="mb-4">
                        <label for="FacultyDepartment"
                            class="block text-lg font-medium text-gray-700">Department</label>
                        <select name="FacultyDepartment" id="FacultyDepartment"
                            class="w-full mt-2 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 FacultyDepartment"
                            required>
                            <option disabled selected>Choose Department</option>

                            <?php foreach($Admin->getDept() as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= $c['deptName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4 RoomDept">

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