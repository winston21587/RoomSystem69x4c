<?php
$pageTitle = "main";
include "../includes/header.php";
session_start();
if(empty($_SESSION["userid"])){
    header("location:../account/Login.php");
    exit;
}
if(isset($_SESSION["userid"]) && $_SESSION["role"] == "Admin"){
    header("location:../admin/admin.php");
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Select Building</h1>
    <a href="../account/logout.php">logout</a>

    <div class="button-group">

        <button id="dp-btn" class="btn dp-btn" data-bg="CCS">CCS</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CSM">CSM</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="Engineering">Engineering</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CLA">CLA</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="Nursing">Nursing</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="Architecture">Architecture</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CCJE">CCJE</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CHE">CHE</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="COA">COA</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="COAIS">COAIS</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="COFAES">COFAES</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="COL">COL</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="COM">COM</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CPADS">CPADS</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CSSPE">CSSPE</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CSWCD">CSWCD</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CTE">CTE</button>
    </div>

    <div id="customModal" class="modal">
        <div class="modal-content">
            <button id="closeModal" class="close">close</button>
            <div id="modalBody">

            </div>
        </div>
    </div>
</body>
</html>


<?php
include "../includes/footer.php";