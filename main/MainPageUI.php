<?php
$pageTitle = "main";
include "../includes/header.php";
require_once "../class/Roomclass.php";
include "../Func/clean.php";

session_start();
if (empty($_SESSION["userid"])) {
    header("location:../account/Login.php");
    exit;
}
if (isset($_SESSION["userid"]) && $_SESSION["role"] == "Admin") {
    header("location:../admin/admin.php");
    exit;
}
if (isset($_SESSION["userid"]) && $_SESSION["role"] == "Faculty") {
    header("location:../admin/faculty.php");
    exit;
}
// var_dump($_SESSION);

?>


<!DOCTYPE html>
<html lang="en">

<body>
    <div class="flex flex-row w-full p-6 px-16 justify-between mb-4 text-center items-center shadow-lg ">
        <h1 class="text-4xl font-bold text-black uppercase">USER</h1>
        <h1 class="text-4xl text-black uppercase"><?= $_SESSION['username'] ?></h1>
        <button class="px-4 py-2 bg-black text-white rounded"><a href="../account/logout.php">Logout</a></button>
    </div>

    <h1 class="text-4xl font-bold text-black uppercase text-center">SELECT BUILDING</h1>

    <div class="button-group">

        <button id="dp-btn" class="btn dp-btn" data-bg="8">CCS</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="7">CSM</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="Engineering">Engineering</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CLA">CLA</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="5">Nursing</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="Architecture">Architecture</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CCJE">CCJE</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CHE">CHE</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="COA">COA</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="COAIS">COAIS</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="COFAES">COFAES</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="COL">COL</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="6">COM</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CPADS">CPADS</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CSSPE">CSSPE</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CSWCD">CSWCD</button>
        <button id="dp-btn" class="btn dp-btn" data-bg="CTE">CTE</button>
    </div>

    <script>
        // Function to redirect with a fixed value
        function redirectToPage(departmentId) {
            window.location.href = `page2.php?id=${encodeURIComponent(departmentId)}`;
        }

        // Using the data attribute for dynamic buttons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function() {
                const departmentId = this.dataset.bg;
                window.location.href = `useRoom.php?id=${encodeURIComponent(departmentId)}`;
            });
        });
    </script>
</body>

</html>
<?php
include "../includes/footer.php";
