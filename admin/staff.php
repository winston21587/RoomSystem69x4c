<?php
include "../includes/header.php";
session_start();
if(empty($_SESSION["userid"]) || $_SESSION['role'] != "Admin"){
    header("location:../account/Login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Admin</h1>

    <form method="GET">
        <label for="department">Select Department</label>
        <select name="department" id="department">
            <option value="CCS">CSS</option>
            <option value="CLA">CLA</option>
            <option value="CSM">CSM</option>
            <option value="Engineering">Engineering</option>
        </select>
    </form>
    <h2>Rooms</h2>
    <table>
        <thead>
            <tr>
                <td>Room id</td>
                <td>Room name</td>
                <td>add room</td>
                <td>Edit</td>
            </tr>
        </thead>
    </table>
<a href="../account/logout.php">logout</a>
</body>
</html>