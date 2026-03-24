<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$result = $conn->query("SELECT * FROM tools");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Tools</title>
</head>
<body>
    <h2>Edit Tools</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Serial Number</th>
            <th>Condition</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['serial_number']; ?></td>
            <td><?php echo $row['item_condition']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>
                <a href="delete_tool.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
</body>
</html>