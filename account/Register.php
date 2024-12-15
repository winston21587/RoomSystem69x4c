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
<div class="w-80 mx-auto mt-20 p-6 bg-neutral-50 rounded-xl shadow-lg">
    <h2 class="text-4xl text-center font-semibold font-['arial'] mb-6 ">Register</h2>

    <form method="POST" class="space-y-6" id="registerForm">
        <div class="relative">

            <input name="username" type="text" id="username" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Username"> <br><br>
            <input name="Lastname" type="text" id="Lastname" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Last Name"> <br><br>
            <input name="Firstname" type="text" id="FirstName" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="First Name"> <br><br>
            <input name="Middlename" type="text" id="Middlename" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Middle Name"> <br><br>
            <small id="usernameError" class="text-red-600 text-xs hidden">Username must be at least 3 characters.</small>
            <input name="email" type="email" id="email" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Email">
            <small id="emailError" class="text-red-600 text-xs hidden">Invalid email address.</small>
        </div>

        <div class="relative">

            <small id="sectionError" class="text-red-600 text-xs hidden">Please select a section.</small>
            <label for="section">Section</label>
            <select name="section" id="section" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
                <option value="">Select a section</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>

            <label for="departmentSelect">Department</label>
            <select name="departmentSelect" id="departmentSelect" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
                <option value="" selected disabled >Select a department</option>
                <?php foreach($admin->getDept() as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['deptName'] ?></option>
                <?php endforeach; ?>    

            </select>
            <small id="courseError" class="text-red-600 text-xs hidden">Please select a course.</small>
            <label for="course">Course</label>
            <select name="course" id="course" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
                <option selected disabled>Select a course</option>
                <?php foreach($admin->getCourse() as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['coursename'] ?></option>
                <?php endforeach; ?>    


            </select>
        </div>

        <div class="relative">
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
        <div class="flex justify-between items-center">
            <input name="submit" type="submit" value="submit" class="px-6 py-2 bg-red-600 text-white rounded-3xl shadow-lg">
        </div>
    </form>

    <div class="text-center mt-4">
        <span class="text-sm text-gray-600">Have an account?</span>
        <a href="Login.php" class="text-red-600 text-sm font-semibold">Login</a>
    </div>
</div>

<!-- JavaScript for Client-Side Validation -->
<!-- <script>
    document.getElementById('registerForm').addEventListener('submit', function (event) {
        let isValid = true;

        const username = document.getElementById('username');
        const email = document.getElementById('email');
        const course = document.getElementById('course');
        const section = document.getElementById('section');
        const password = document.getElementById('password');

        const usernameError = document.getElementById('usernameError');
        const emailError = document.getElementById('emailError');
        const courseError = document.getElementById('courseError');
        const sectionError = document.getElementById('sectionError');
        const passwordError = document.getElementById('passwordError');

        usernameError.classList.add('hidden');
        emailError.classList.add('hidden');
        courseError.classList.add('hidden');
        sectionError.classList.add('hidden');
        passwordError.classList.add('hidden');

        if (username.value.trim().length < 3) {
            usernameError.classList.remove('hidden');
            isValid = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.value.trim() || !emailRegex.test(email.value.trim())) {
            emailError.classList.remove('hidden');
            isValid = false;
        }

        if (course.value === "") {
            courseError.classList.remove('hidden');
            isValid = false;
        }

        if (section.value === "") {
            sectionError.classList.remove('hidden');
            isValid = false;
        }

        if (password.value.trim().length < 8) {
            passwordError.classList.remove('hidden');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
</script> -->
</body>
</html>
