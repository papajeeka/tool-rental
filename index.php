<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Tool Rental</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <!-- Login Card -->
    <div class="bg-white shadow-xl rounded-2xl w-full max-w-md p-8">

        <!-- Header -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Welcome Back</h2>
            <p class="text-gray-500 text-sm mt-1">Login to your tool rental account</p>
        </div>

        <!-- Form -->
        <form action="login.php" method="POST" class="space-y-4">

            <!-- Username -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Username
                </label>
                <input 
                    type="text" 
                    name="username" 
                    required
                    placeholder="Enter your username"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Password
                </label>
                <input 
                    type="password" 
                    name="password" 
                    required
                    placeholder="Enter your password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Role
                </label>
                <select 
                    name="role" 
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <!-- Button -->
            <button 
                type="submit" 
                name="login"
                class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200"
            >
                Login
            </button>

        </form>

        <!-- Footer -->
        <p class="text-sm text-gray-500 text-center mt-6">
            Don't have an account?
            <a href="register.php" class="text-blue-600 font-medium hover:underline">
                Register
            </a>
        </p>

    </div>

</body>
</html>