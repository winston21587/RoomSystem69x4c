<?php
require_once "../class/adminClass.php";
$Admin = new Admin();
?>

<div class="flex items-center justify-center" id="AdminModal">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
        <div class="flex flex-col space-y-4">
            <input 
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                type="text" 
                name="RoomName" 
                placeholder="Enter Room Name" 
            >
            <select 
                name="department" 
                id="department" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            >  
                <?php foreach($Admin->getDept() as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['deptName'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mt-4">
            <input 
                class="w-full text-white bg-blue-500 hover:bg-blue-600 rounded-md px-4 py-2 cursor-pointer" 
                type="submit" 
                name="submit" 
                value="Add"
            >
        </div>
    </form>
</div>
