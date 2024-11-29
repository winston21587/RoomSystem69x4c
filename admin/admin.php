<?php
include "../includes/header.php";
include "../modals/RoomModal.php";
require_once "../class/adminClass.php";
include "../Func/clean.php";

session_start();

if(empty($_SESSION["userid"]) || $_SESSION['role'] != "Admin"){
    header("location:../account/Login.php");
    exit;
}

    $Admin = new Admin();

    var_dump($_POST);
 if(isset($POST["submit"]) && $_SERVER['REQUEST_METHOD'] == "POST" ){
    $Admin->roomname = clean($_POST['RoomName']);
    $Admin->department = clean($_POST['department']);

    if($Admin->addRoom()){
        echo "<p>". " added successfully"."</p>";
    }else{
        echo "<p>". " added unsuccessfully"."</p>";
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<body>
<h1>Hello</h1>
        <form method="POST" >
        <input type="text" name="RoomName" placeholder="Enter Room Name" >
        <select name="department" id="department">
            <option value="CCS">CSS</option>
            <option value="CLA">CLA</option>
            <option value="CSM">CSM</option>
            <option value="Engineering">Engineering</option>
        </select>
        
        <input type="submit" name="submit" >
    </form>
    <h1>Admin</h1>
    <h2>Rooms</h2>
    <button onclick="OpenAddRoom()" >Add Room</button>
    <table>
        <thead>
            <tr>
                <td>Room id</td>
                <td>Room name</td>
                <td>add room</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
<a href="../account/logout.php">logout</a>
</body>
</html>

<script>
    let addRoom = document.getElementById("AdminModal")

    function OpenAddRoom() {
        addRoom.style.display = "block";
    }
    function closeAddRoom() {
        addRoom.style.display = "none";
    }
</script>