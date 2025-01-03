<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../class/adminClass.php";
require_once "../class/Roomclass.php";
include "../Func/clean.php";
$pageTitle = "Faculty";
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
if ($_SESSION['role'] == "Admin") {
    header("location:../admin/admin.php");
    exit;
}

$Admin = new Admin();
$Room = new Room();
$id;

?>

<!DOCTYPE html>
<html lang="en">

<body class="w-full h-full reloaded">

    <div class="flex flex-col sm:flex-row w-full p-6 px-4 sm:px-16 justify-between mb-4 text-center sm:items-center shadow-lg bg-red-600 text-white">
        <h1 class="text-2xl sm:text-4xl font-bold text-white uppercase">Faculty</h1>
        <h1 class="text-2xl sm:text-4xl text-white uppercase hidden sm:block">
            <?= $_SESSION['lastName'] . ', ' . strtoupper(substr($_SESSION['firstName'], 0, 1)) . '.' ?>
        </h1>
        <button class="px-4 py-2 bg-white text-red-600 hover:bg-red-300 rounded mt-4 sm:mt-0 transition duration-300 ease-in-out">
            <a href="../account/logout.php">Logout</a>
        </button>
    </div>

    <div class="inbox px-4 sm:px-12 w-full mb-10">
        <div class="flex flex-col sm:flex-row mt-6 sm:mt-10 justify-center items-center">
            <h1 class="text-2xl sm:text-4xl text-center text-gray-800 mb-4 sm:mr-8">Requests</h1>
            <div class="flex gap-4">
                <button class="text-lg sm:text-3xl text-center text-gray-800 tabBTN activeTab border-b-4 border-black/70 rounded" data-url="../tables/inbox.php">
                    Inbox
                </button>
                <button class="text-lg sm:text-3xl text-center text-gray-800 tabBTN" data-url="../tables/sentbox.php">
                    Sentbox
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
        <table class="requestTable SentBoxTable display mx-auto mt-6 w-full sm:w-auto border border-gray-300">
        </table>
        </div>
    </div>

    <div class="table-content flex flex-col lg:flex-row pb-7 px-4 sm:px-0 justify-around items-center gap-4">

        <div class="inbox w-full max-w-lg mb-8 sm:mb-0 sm:w-1/2">
            <h1 class="text-2xl sm:text-4xl text-center text-gray-800 mt-6 sm:mt-10">Faculty Room Schedule</h1>
            <div class="mt-6 sm:mt-8 bg-white p-6 rounded-lg shadow-lg">
                <form method="POST">
                    <div class="mb-4">
                        <label for="FacultyDepartment" class="block text-lg font-medium text-gray-700">Department</label>
                        <select name="FacultyDepartment" id="FacultyDepartment"
                            class="w-full mt-2 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 FacultyDepartment"
                            required>
                            <option disabled selected>Choose Department</option>
                            <?php foreach ($Admin->getDept() as $c): ?>
                                <option value="<?= $c['id'] ?>"><?= $c['deptName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4 RoomDept"></div>
                </form>
            </div>
        </div>

        <div class="table-2 w-full max-w-5xl">
            <div class="table-2-head flex items-center justify-center w-full px-4 p-4 h-20">
                <h2 class="text-2xl sm:text-4xl ScheduleText text-center">Schedules</h2>
            </div>
            <div class="overflow-x-auto sm:overflow-visible p-5">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-red-300">
                            <th class="px-4 py-2 text-center">Day</th>
                            <th class="px-4 py-2 text-center">Start Time</th>
                            <th class="px-4 py-2 text-center">End Time</th>
                            <th class="px-4 py-2 text-center">Subject</th>
                            <th class="px-4 py-2 text-center">Professor</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="schedForRoom">
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

    <div id="customModalAdmin"
        class="AddRoomModal hidden fixed inset-0 bg-black bg-opacity-40 z-50 flex justify-center items-center backdrop-blur-sm">
        <div
            class="RoomAddbody flex flex-col justify-center items-end bg-white p-6 rounded-lg border border-gray-300 w-11/12 max-w-lg text-center shadow-lg">
            <button id="closeModalAdmin" class="closeRoom px-4 py-2 rounded bg-black m-1 text-white">close</button>
            <div id="modalBodyAdmin" class="py-4 w-full">
                <?php include "../modals/Admin.add.php" ?>
            </div>
        </div>
    </div>

    <div
        class="ManageModal hidden fixed inset-0 bg-black bg-opacity-40 z-50 flex justify-center items-center backdrop-blur-sm">
        <div
            class="RoomManagebody flex flex-col justify-center items-end bg-white p-6 rounded-lg border border-gray-300 w-11/12 max-w-lg text-center shadow-lg">
            <button id="closeModalManage"
                class="closeRoomManage px-4 py-2 rounded bg-black m-1 text-white">close</button>
            <div class="ModalManageBody py-4 w-full">
            </div>
        </div>
    </div>

</body>


<?php include "../includes/footer.php" ?>

</html>