<?php
include "../includes/header.php";
require_once "../class/account.php";
require_once "../Func/clean.php";
session_start();

$pageTitle = "Register";
$acc = new Account();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $email = clean($_POST['email']);
    $username = clean($_POST['username']);
    $course = clean($_POST['course']);
    $section = clean($_POST['section']);
    $password = clean($_POST['password']);

    // Server-side validation
    $errors = [];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    if (empty($username) || strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }

    if (empty($course)) {
        $errors[] = "Please select a course.";
    }

    if (empty($section)) {
        $errors[] = "Please select a section.";
    }

    if (empty($password) || strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }

    if (empty($errors)) {
        $acc->email = $email;
        $acc->username = $username;
        $acc->course = $course;
        $acc->section = $section;
        $acc->password = $password;
        $acc->register();
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
    
    <?php if (!empty($errors)): ?>
        <ul class="text-red-600 text-sm mb-4">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST" class="space-y-6" id="registerForm">
        <div class="relative">
            <input name="username" type="text" id="username" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Username">
            <small id="usernameError" class="text-red-600 text-xs hidden">Username must be at least 3 characters.</small>

            <input name="email" type="email" id="email" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Email">
            <small id="emailError" class="text-red-600 text-xs hidden">Invalid email address.</small>
        </div>

        <div class="relative">
            <label for="course">Course</label>
            <select name="course" id="course" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
                <option value="">Select a course</option>
                <option value="BSCS">BSCS</option>
                <option value="BSIT">BSIT</option>
                <option value="BS-ACT">BS-ACT</option>
            </select>
            <small id="courseError" class="text-red-600 text-xs hidden">Please select a course.</small>

            <label for="section">Section</label>
            <select name="section" id="section" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
                <option value="">Select a section</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
            <small id="sectionError" class="text-red-600 text-xs hidden">Please select a section.</small>
        </div>

        <div class="relative">
            <input name="password" type="password" id="password" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Password">
            <small id="passwordError" class="text-red-600 text-xs hidden">Password must be at least 6 characters.</small>
        </div>

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
<script>
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
</script>
</body>
</html>
