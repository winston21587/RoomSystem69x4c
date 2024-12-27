<?php
$pageTitle = "main";
require_once "../class/Roomclass.php";
include "../includes/header.php";

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

$roomObj = new Room();

$id = $_GET['id'] ?? null;
$array = $roomObj->showNewSched($id);
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <div class="flex flex-col mb-8 sm:flex-row w-full p-6 px-4 sm:px-16 justify-between mb-4 text-center sm:items-center shadow-lg bg-red-600 text-white">
        <a href="../main/MainPageUI.php">
            <svg

                class="w-6"
                xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24"
                strokeWidth={1.5} stroke="currentColor"
                className="size-6">

                <path strokeLinecap="round"
                    strokeLinejoin="round"
                    d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <h1 class="text-2xl sm:text-4xl text-white uppercase hidden sm:block">
            <?= $_SESSION['lastName'] . ', ' . strtoupper(substr($_SESSION['firstName'], 0, 1)) . '.' ?>
        </h1>
        <button class="px-4 py-2 bg-white text-red-600 hover:bg-red-600 hover:text-white rounded mt-4 sm:mt-0 transition duration-300 ease-in-out">
            <a href="../account/logout.php">Logout</a>
        </button>
    </div>

    <h1 class="text-4xl font-bold text-black uppercase text-center mb-4">SCHEDULES</h1>

    <table align="center" id="schedTable" class="overflow-x-auto min-w-full text-center border-separate border-spacing-y-1">
        <thead class="bg-red-300">
            <tr>
                <th class="py-4">Room Id</th>
                <th class="py-4">Day</th>
                <th class="py-4">Start Time</th>
                <th class="py-4">End Time</th>
                <th class="py-4">Subject Name</th>
                <th class="py-4">Prof Name</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($array)): ?>
                <tr>
                    <td colspan="6">
                        <p>No schedule found.</p>
                    </td>
                </tr>
            <?php endif; ?>
            <?php foreach ($array as $arr): ?>
                <tr class="even:bg-red-100">
                    <td class="py-4"><?= $arr["RoomName"] ?></td>
                    <td class="py-4"><?= $arr["DayOfWeek"] ?></td>
                    <td class="py-4"><?= $arr["start_time"] ?></td>
                    <td class="py-4"><?= $arr["end_time"] ?></td>
                    <td class="py-4"><?= $arr["SubName"] ?></td>
                    <td class="py-4"><?= $arr["profName"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

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
?>