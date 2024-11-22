<?php
    include "../includes/header.php";
    require_once "../class/account.php";
    require_once "../Func/clean.php";
    session_start();

    $pageTitle = "Register";
    $acc = new Account();
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
        
      $email = clean($_POST['email']);
      $username = clean($_POST['username']);
      $course = clean($_POST['course']);
      $section = clean($_POST['section']);
      $password = clean($_POST['password']);
  
      $acc->email = $email;
      $acc->username = $username;
      $acc->course = $course;
      $acc->section = $section;
      $acc->password = $password;
        $acc->register();
        header("location:Login.php");
        exit;
    }

    


?>

<!DOCTYPE html>
<html lang="en">
<body>
<div class="w-80 mx-auto mt-20 p-6 bg-neutral-50 rounded-xl shadow-lg">
  <h2 class="text-4xl text-center font-semibold font-['arial'] mb-6 ">Register</h2>
  <form method="POST" class="space-y-6">
    <div class="relative ">
      
    <input  name="username" type="text" id="username" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Username">
    <input name="email" type="email" id="email" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Email">
    
</div>
    
    <div class="relative">
      <!-- <input type="text" id="course" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="course"> -->
        <label for="course">Course</label>
      <select name="course" id="course">
        <option value="BSCS">BSCS</option>
        <option value="BSIT">BSIT</option>
        <option value="BS-ACT">BS-ACT</option>
    </select>
    <select name="section" id="section">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
    </select>
    </div>

    <div class="relative">
      <input name="password" type="password" id="password" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Password">
    </div>
    
    <div class="flex justify-between items-center justify-content-center">
      <input name="submit" type="submit" class="px-6 py-2 bg-red-600 text-white rounded-3xl shadow-lg">
    </div>
  </form>

  <div class="text-center mt-4">
    <span class="text-sm text-gray-600">have an account?</span>
    <a href="Login.php" class="text-red-600 text-sm font-semibold">Login</a>
  </div>
</div>


</body>
</html>