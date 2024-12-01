<?php
require_once "../class/adminClass.php";
include "../Func/clean.php";
$pageTitle = "Admin";
include "../includes/header.php";
session_start();

if(empty($_SESSION["userid"]) || $_SESSION['role'] != "Admin"){
    header("location:../account/Login.php");
    exit;
}

    $Admin = new Admin();
    // var_dump($_POST);
    // var_dump($Admin);

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
<body>

    <?php include "../modals/AddRoomModal.php";  ?>
    
    <h1>Admin</h1>
    <h2>Rooms</h2>
    <button onclick="OpenAddRoom()" >Add Room</button>
    <table>
        <thead>
            <tr>
                <td>Room id</td>
                <td>Room name</td>
                <td>Status</td>
                <td>add room</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
                <?php foreach($Admin->ShowRooms() as $r):   ?>
                    <tr>
                        <td><?= $r['id']; ?></td>
                        <td><?= $r['RoomName']; ?></td>
                        <td><?= $r['department']; ?></td>
                        <td><?= $r['status']; ?></td>
                        <td><button class="EditRoom" data-id="<?= $r['id']; ?>" >Edit</button></td>
                        <td><button class="DeleteRoom" data-id="<?= $r['id']; ?>" >Delete</button></td>
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
<a href="../account/logout.php">logout</a>
</body>
</html>
<?php include "../includes/footer.php"; ?>

<script>
    let addRoom = document.getElementById("AdminModal")

    function OpenAddRoom() {
        addRoom.style.display = "block";
    }
    function closeAddRoom() {
        addRoom.style.display = "none";
    }
</script>