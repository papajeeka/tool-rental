<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome to the Admin Dashboard</h1>
    <p>Hello, <?php echo $_SESSION['username']; ?></p>

    <ul>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="manage_tools.php">Manage Tools</a></li>
        <li><a href="add_rentals.php">Add Rentals</a></li>
        <li><a href="../logout.php">Logout</a></li>

    </ul>
</body>
</html>
    