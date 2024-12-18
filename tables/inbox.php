<?php
require_once "../class/adminClass.php";
include "../Func/clean.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$Admin = new Admin();
$FID = $_SESSION['facultyId'];
?>
       
       <thead>
                <tr>
                    <th>Requested By</th>
                    <th>Room</th>
                    <th>schedule</th>
                    <th>Date Requested</th>
                    <th>Date to Use</th>
                    <th>Status</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($Admin->displayRequest($FID) as $d): ?>
                    <tr>
                        <td><?= $d['professor'] ?></td>
                        <td><?= $d['Roomname'] ?></td>
                        <td><button>check</button></td>
                        <td><?= $d['DateRequested'] ?></td>
                        <td><?= $d['DateOfUse'] ?></td>
                        <td class=" p-3 rounded
                        <?= $d['status'] == 'Approved' ? 'bg-green-500 text-white' : ($d['status'] == 'Pending' ? 'bg-yellow-500 text-white' : 'bg-red-500 text-white') ?>"
                         ><?= $d['status'] ?></td>
                        <td><button class="bg-blue-500 rounded p-3 AcceptRequestBTN" data-id="<?= $d['id'] ?>" ><?= ($d['status'] == 'Pending') ? 'accept' : 'change' ?></button></td>
                    </tr>
                <?php endforeach;?>
            </tbody>


            <script src="../js/admin.js" ></script>