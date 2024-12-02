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
    $id;
    $depart = NULL;
    
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

<body class="w-full h-full" >

    <div class="flex flex-row w-full p-6 px-16 justify-between mb-4 text-center items-center shadow-lg ">
        <h1 class="text-4xl font-bold text-black uppercase">Admin</h1>
        <button class="px-4 py-2 bg-black text-white rounded"><a href="../account/logout.php">Logout</a></button>
    </div>
    <div class="table-content w-full flex flex-row justify-around pb-7">
        <div class="table-1">   
            <div class="table-1-head flex flex-row w-full justify-between items-center p-6">
                <h2 class="font-bold text-2xl">Rooms</h2>
                <select name="department" id="departmentSelect" >
                <option value="" selected disabled>Select a Department</option>
                    <option value="CCS">CSS</option>
                    <option value="CLA">CLA</option>
                    <option value="CSM">CSM</option>
                    <option value="Engineering">Engineering</option>
                </select>
                <button id="Addbtn"  class=" addRoomBtn px-4 py-2 bg-blue-500 text-white rounded"  >Add Room</button>
            </div>
            <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left border-b border-gray-300">Room id</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Room name</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Department</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300">Status</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-center" colspan="2">Manage</th>
                    </tr>
                </thead>
                <tbody class="showroombody" id="RoomForDept">

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
                    <?php foreach($Room->showAllSched($id,$depart) as $r): ?>
                    <tr>
                    <td class="px-4 py-2 border-b border-gray-300"><?= $r['DayOfWeek'] ?></td>  
                    <td class="px-4 py-2 border-b border-gray-300"><?= $r['start_time'] ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?= $r['end_time'] ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?= $r['subject'] ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><button>Edit</button></td>
                    <td class="px-4 py-2 border-b border-gray-300"><button>Delete</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="customModalAdmin" class="AddRoomModal hidden fixed inset-0 bg-black bg-opacity-40 z-50  justify-center items-center backdrop-blur-sm">
        <div class="RoomAddbody flex flex-col justify-center items-end bg-white p-6 rounded-lg border border-gray-300 w-11/12 max-w-lg text-center shadow-lg absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" >
            <button id="closeModalAdmin" class="closeRoom px-4 py-2 rounded bg-black m-1 text-white">close</button>
            <div id="modalBodyAdmin" class="py-4 w-full">
                    <?php include "../modals/Admin.add.php" ?>
            </div>
        </div>
    </div>        

    <div class="ManageModal hidden fixed inset-0 bg-black bg-opacity-40 z-50  justify-center items-center backdrop-blur-sm" >
        <div class="RoomManagebody flex flex-col justify-center items-end bg-white p-6 rounded-lg border border-gray-300 w-11/12 max-w-lg text-center shadow-lg absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" >
        <button id="closeModalManage" class="closeRoomManage px-4 py-2 rounded bg-black m-1 text-white">close</button>
        <div class="ModalManageBody py-4 w-full" >

        </div>
        </div>                    
    </div>

</body>

<script>                    
    const Addbtn = document.getElementById('Addbtn');
    const modalBack = document.getElementById('customModalAdmin');
    const closeAddBtn = document.getElementById('closeModalAdmin');

    Addbtn.addEventListener('click', function(){
        modalBack.classList.remove("hidden");
    });

    closeAddBtn.addEventListener('click', function(){
        modalBack.classList.add("hidden");
    });

</script>


</html>
<?php include "../includes/footer.php" ?>


