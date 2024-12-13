<?php
    require_once "../class/adminClass.php";
    include "../Func/clean.php";
    session_start();
    $Admin = new Admin();

    if(isset($_GET['dept'])){
        $department = clean($_GET['dept']);
        $username = clean($_GET['username']);
    }
?>

        <h1 class="text-xl font-semibold text-gray-800 mb-4">Send Request?</h1>
        <div class="mb-4">
            <label for="facultyName" class="block text-sm font-medium text-gray-700 mb-2">Select Faculty Member:</label>
            <select name="facultyName" id="facultyName" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option selected disabled>--Select--</option>
                <?php foreach($Admin->showFaculty($department, $username) as $f): ?>
                    <option value="<?= $f['id'] ?>"><?= $f['username'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="flex justify-end space-x-3">
            <button id="RequestAproved" class="px-4 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">Yes</button>
            <button id="RequestDenied" class="px-4 py-2 bg-red-500 text-white rounded-md shadow hover:bg-red-600">No</button>
        </div>
