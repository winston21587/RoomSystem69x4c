<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once "../class/adminClass.php";
    include "../Func/clean.php";
    session_start();
    $Admin = new Admin();

    if(isset($_GET['requestTo'])){
        $requestTo = clean($_GET['requestTo']);

    }
?>

        <h1 class="text-xl font-semibold text-gray-800 mb-4 RequestMSG">Send Request to <?= $requestTo ?>?</h1>
    <?= var_dump($_GET) ?>
        <div class="mb-4">
            <input type="date" name="DateOfUse" id="DateOfUse">
        </div>
        <div class="flex justify-center space-x-3 ">
            <button id="RequestAproved" class="px-4 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">Yes</button>
        </div>
        <script src="../js/admin.js"></script>