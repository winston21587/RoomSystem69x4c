<?php

include "../includes/header.php";
require_once "../class/account.php";
require_once "../Func/clean.php";
session_start();

$pageTitle = "Login";

$acc = new Account();

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
        
  $acc->email = clean($_POST['email']);
  $acc->password = clean($_POST['password']);

  if($acc->login()){
      $_SESSION['userid'] = $acc->id;
      $_SESSION['username'] = $acc->username;
      $_SESSION['email'] = $acc->email;
      $_SESSION['course'] = $acc->course;
      $_SESSION['section'] = $acc->section;
      header("location:../main/temp.php");
  }else{
      $_SESSION['message'] = "Failed to login";
  }
}


?>



<!DOCTYPE html>
<html lang="en">
<body>
<div class="w-80 mx-auto mt-20 p-6 bg-neutral-50 rounded-xl shadow-lg">
  <h2 class="text-4xl text-center font-semibold font-['arial'] mb-6 ">Login</h2>
  <form method="POST" class="space-y-6">
    <div class="relative">
    <!-- <input type="text" id="username" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Username"> -->
    <input name="email" type="email" id="email" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="email">
    </div>
    
    <div class="relative">
      <input name="password" type="password" id="password" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Password">
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


</body>
</html>