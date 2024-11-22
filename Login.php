<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body>
<div class="w-80 mx-auto mt-20 p-6 bg-neutral-50 rounded-xl shadow-lg">
  <h2 class="text-4xl text-center font-semibold font-['Poppins'] mb-6">Login</h2>
  
  <form class="space-y-6">
    <div class="relative">
      <input type="text" id="username" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Username">
      <!-- <div class="absolute top-3 left-4 text-gray-500">Username</div> -->
    </div>
    
    <div class="relative">
      <input type="password" id="password" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Password">
      <!-- <div class="absolute top-3 left-4 text-gray-500">Password</div> -->
    </div>
    
    <div class="flex justify-between items-center">
      <a href="#" class="text-xs text-zinc-600 font-semibold">Forgotten Password?</a>
      <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-3xl shadow-lg">Login</button>
    </div>
  </form>

  <div class="text-center mt-4">
    <span class="text-sm text-gray-600">Don't have an account?</span>
    <a href="#" class="text-red-600 text-sm font-semibold">Register</a>
  </div>
</div>


</body>
</html>