<?php
$pageTitle = "Login";
include "../includes/header.php";
require_once "../class/account.php";
require_once "../Func/clean.php";
session_start();

if(isset($_SESSION["userid"])){
    if($_SESSION['role'] = "Staff"){
        header("location:../admin/faculty.php");
        exit;
    }
    if($_SESSION['role'] = "Admin"){
        header("location:../admin/admin.php");
        exit;
    }
    if($_SESSION['role'] = "Student"){
        header("location:../main/MainPageUI.php");
        exit;
    }
    
  
}

$pageTitle = "Login";

$acc = new Account();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {

    $acc->email = clean($_POST['email']);
    $acc->password = clean($_POST['password']);

    if ($acc->login()) {
        $_SESSION['userid'] = $acc->id;
        $_SESSION['username'] = $acc->username;
        $_SESSION['email'] = $acc->email;
        $_SESSION['course'] = $acc->course;
        $_SESSION['section'] = $acc->section;
        $_SESSION['role'] = $acc->role;
            if($_SESSION["role"] == "Admin"){
                header("location:../admin/admin.php");
                exit;
            }elseif($_SESSION["role"] == "Staff"){
                header("location:../admin/faculty.php");
                exit;
            }
            else{
            header("location:../main/MainPageUI.php");
            exit;
            }
    } else {
        $_SESSION['message'] = "Failed to login";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<body>
<div class="w-80 mx-auto mt-20 p-6 bg-neutral-50 rounded-xl shadow-lg">
    <h2 class="text-4xl text-center font-semibold font-['arial'] mb-6">Login</h2>
    <form method="POST" class="space-y-6" id="loginForm">

        <div class="relative">
            <input name="email" type="email" id="email" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Email">
            <small id="emailError" class="text-red-600 text-xs hidden">Please enter a valid email address.</small>
        </div>

        <div class="relative">
            <input name="password" type="password" id="password" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Password">
            <small id="passwordError" class="text-red-600 text-xs hidden">Password must be at least 8 characters.</small>
        </div>

        <div class="flex justify-between items-center">
            <a href="#" class="text-xs text-zinc-600 font-semibold">Forgotten Password?</a>
            <button name="submit" type="submit" class="px-6 py-2 bg-red-600 text-white rounded-3xl shadow-lg">Login</button>
        </div>
    </form>

    <div class="text-center mt-4">
        <span class="text-sm text-gray-600">Don't have an account?</span>
        <a href="Register.php" class="text-red-600 text-sm font-semibold">Register</a>
    </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function (event) {
        let isValid = true;

        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        emailError.classList.add('hidden');
        passwordError.classList.add('hidden');

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.value.trim() || !emailRegex.test(email.value.trim())) {
            emailError.classList.remove('hidden');
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
