<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body>
<div class="flex justify-center items-center min-h-screen">
<div class="w-96 bg-white rounded-xl shadow-lg relative p-6">
  <h2 class="text-4xl text-center font-semibold font-['Poppins'] mb-6">Login</h2>
  
  <form id="loginForm" class="space-y-6">
    <!-- Username Input -->
    <div class="relative">
      <input 
        type="text" 
        id="username" 
        class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600"
        placeholder="Username"
        required
      >
      <small id="usernameError" class="text-red-600 text-xs hidden">Username is required.</small>
    </div>
    
    <!-- Password Input -->
    <div class="relative">
      <input 
        type="password" 
        id="password" 
        class="w-full px-4 py-2 border rounded-lg bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600"
        placeholder="Password"
        required
      >
      <small id="passwordError" class="text-red-600 text-xs hidden">Password is required.</small>
    </div>
    
    <!-- Actions -->
    <div class="flex justify-between items-center">
      <a href="#" class="text-xs text-zinc-600 font-semibold">Forgot Password?</a>
      <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-3xl shadow-lg">Login</button>
    </div>
  </form>

  <!-- Register Link -->
  <div class="text-center mt-4">
    <span class="text-sm text-gray-600">Don't have an account?</span>
    <a href="#" class="text-red-600 text-sm font-semibold">Register</a>
  </div>
</div>

<!-- JavaScript for Validation -->
<script>
  // Select form and input elements
  const form = document.getElementById('loginForm');
  const usernameInput = document.getElementById('username');
  const passwordInput = document.getElementById('password');
  const usernameError = document.getElementById('usernameError');
  const passwordError = document.getElementById('passwordError');

  // Validate on submit
  form.addEventListener('submit', (event) => {
    let isValid = true;

    // Reset errors
    usernameError.classList.add('hidden');
    passwordError.classList.add('hidden');

    // Username validation
    if (usernameInput.value.trim() === '') {
      usernameError.classList.remove('hidden');
      isValid = false;
    }

    // Password validation
    if (passwordInput.value.trim() === '') {
      passwordError.classList.remove('hidden');
      isValid = false;
    }

    // Prevent form submission if invalid
    if (!isValid) {
      event.preventDefault();
    }
  });
</script>

</body>
</html>
