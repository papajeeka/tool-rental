<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
?>
<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Tool Rental Admin</h1>
            <a href="../logout.php" 
               class="text-red-500 font-medium hover:text-red-600">
               Logout
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-10">

        <!-- Welcome Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">
                Welcome, <?php echo $_SESSION['username']; ?>
            </h2>
            <p class="text-gray-500 mt-1">
                Manage your tools, users, and system operations efficiently.
            </p>
        </div>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Manage Users -->
            <a href="manage_users.php" 
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-200">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">
                    Manage Users
                </h3>
                <p class="text-sm text-gray-500">
                    View, edit, and control user accounts.
                </p>
            </a>

            <!-- Manage Tools -->
            <a href="edit_equipment.php" 
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-200">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">
                    Manage Tools
                </h3>
                <p class="text-sm text-gray-500">
                    Update tool details and inventory.
                </p>
            </a>

            <!-- Add Equipment -->
            <a href="add_equipment.php" 
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-200">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">
                    Add Equipment
                </h3>
                <p class="text-sm text-gray-500">
                    Add new tools to your inventory.
                </p>
            </a>

        </div>

    </main>

</body>
</html>
    