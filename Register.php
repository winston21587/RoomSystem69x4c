<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body class="bg-neutral-50">

<div class="flex justify-center items-center min-h-screen">
  <div class="w-96 bg-white rounded-xl shadow-lg relative p-6">
    <!-- Decorative Shapes
    <div class="absolute left-[-50px] top-[-50px]">
      <div class="w-64 h-64 bg-neutral-100 rounded-full shadow-lg"></div>
    </div>
    <div class="absolute right-[-50px] top-[-50px]">
      <div class="w-64 h-64 bg-neutral-100 rounded-full shadow-lg"></div>
    </div> -->

    <!-- Login Title -->
    <h2 class="text-4xl text-center text-black font-semibold mb-8 font-['Poppins']">Login</h2>
    
    <!-- Login Form -->
    <form action="#" method="POST" class="space-y-6">
      <!-- Username Input -->
      <div class="relative">
        <input type="text" name="username" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Username" required>
        <!-- <label for="username" class="absolute top-3 left-4 text-gray-500">Username</label> -->
      </div>

      <!-- Password Input -->
      <div class="relative">
        <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Password" required>
        <!-- <label for="password" class="absolute top-3 left-4 text-gray-500">Password</label> -->
      </div>

      <!-- Forgot Password Link -->
      <div class="flex justify-between">
        <a href="#" class="text-xs text-zinc-600 font-semibold">Forgotten Password?</a>
      </div>
      
      <!-- Login Button -->
      <button type="submit" class="w-full px-6 py-2 bg-red-600 text-white rounded-3xl shadow-lg">Login</button>
    </form>

    <!-- Register Link -->
    <div class="text-center mt-4">
      <span class="text-sm text-gray-600">Don't have an account?</span>
      <a href="#" class="text-red-600 text-sm font-semibold">Register</a>
    </div>
  </div>
</div>

</body>
</html>
