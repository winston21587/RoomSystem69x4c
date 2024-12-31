<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// session_start();

$pageTitle = "Register";
include "../includes/header.php";
require_once "../class/account.php";
require_once "../class/adminClass.php";
require_once "../Func/clean.php";

$acc = new Account();
$admin = new Admin();

if(isset($_SESSION["userid"])){
    header("location:../main/temp.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $email = clean($_POST['email']);
    $username = clean($_POST['username']);
    $Firstname = clean($_POST['Firstname']);
    $Lastname = clean($_POST['Lastname']);
    $Middlename = clean($_POST['Middlename']);
    $course = clean($_POST['course']);
    $section = clean($_POST['section']);
    $password = clean($_POST['password']);
    $department = clean($_POST['departmentSelect']);
    $acc->email = $email;
    $errors = [];
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    if (empty($username) || strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }
    if (empty($Firstname) || strlen($Firstname) < 3) {
        $errors[] = "First name must be at least 3 characters.";
    }
    if (empty($Lastname) || strlen($Lastname) < 3) {
        $errors[] = "Last name must be at least 3 characters.";
    }
    if (empty($Middlename) || strlen($Middlename) < 3) {
        $errors[] = "Middle name must be at least 3 characters.";
    }
    if (empty($course)) {
        $errors[] = "Please select a course.";
    }

    if (empty($section)) {
        $errors[] = "Please select a section.";
    }

    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }
    if (empty($department)) {
        $errors[] = "Please select a department.";
    }
    if ($acc->CheckUnqEmail() == false){
        $errors[] = "email exist";
    }
    if (empty($errors)) {

        $acc->register($username, $email, $password, 
        $department ,$Lastname, $Firstname,
         $Middlename,$section,$course);
        header("location:Login.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<body>
<div class="w-96 mx-auto mt-20 p-8 bg-neutral-50 rounded-xl shadow-lg">
    <h2 class="text-4xl text-center font-semibold font-['arial'] mb-6">Register</h2>

    <form method="POST" class="space-y-6" id="registerForm">
        <div class="relative space-y-4">
            <input name="username" type="text" id="username" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Username">
            <input name="Lastname" type="text" id="Lastname" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Last Name">
            <input name="Firstname" type="text" id="FirstName" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="First Name">
            <input name="Middlename" type="text" id="Middlename" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Middle Name">
            <small id="usernameError" class="text-red-600 text-xs hidden">Username must be at least 3 characters.</small>
            <input name="email" type="email" id="email" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Email">
            <small id="emailError" class="text-red-600 text-xs hidden">Invalid email address.</small>
        </div>

        <div class="relative grid grid-cols-3 gap-4">
            <div>
                <label for="section" class="block mb-1">Section</label>
                <select name="section" id="section" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
                    <option value="">Select a section</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>

            <div>
                <label for="departmentSelect" class="block mb-1">Department</label>
                <select name="departmentSelect" id="departmentSelect" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
                    <option value="" selected disabled>Select a department</option>
                    <?php foreach($admin->getDept() as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= $c['deptName'] ?></option>
                    <?php endforeach; ?>    
                </select>
            </div>

            <div>
                <label for="course" class="block mb-1">Course</label>
                <select name="course" id="course" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
                    <option selected disabled>Select a course</option>
                    <?php foreach($admin->getCourse() as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= $c['coursename'] ?></option>
                    <?php endforeach; ?>    
                </select>
            </div>
        </div>

        <div class="relative space-y-4">
            <input name="password" type="password" id="password" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Password">
            <small id="passwordError" class="text-red-600 text-xs hidden">Password must be at least 6 characters.</small>
        </div>

        <?php if (!empty($errors)): ?>
        <ul class="text-red-600 text-sm mb-4">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <div class="flex justify-center items-center">
            <input name="submit" type="submit" value="Submit" class="px-8 py-2 bg-red-600 text-white rounded-3xl shadow-lg">
        </div>
    </form>

    <div class="text-center mt-4">
        <span class="text-sm text-gray-600">Have an account?</span>
        <a href="Login.php" class="text-red-600 text-sm font-semibold">Login</a>
    </div>
</div>
</body>

</html>
