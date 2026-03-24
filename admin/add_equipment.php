<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['add_tool'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $serial_number = $_POST['serial_number'];
    $condition = $_POST['item_condition'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO tools (name, description, serial_number, item_condition, quantity) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $description, $serial_number, $condition, $quantity);

    if ($stmt->execute()) {
        echo "Tool added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Equipment</title>
    </head>
    <body>
        <h2>Add New Tools</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Tool Name" required>
            <input type="text" name="description" placeholder="Description" required>
            <input type="text" name="serial_number" placeholder="Serial Number" required>   
            <input type="text" name="item_condition" placeholder="Condition" required>
            <input type="number" name="quantity" placeholder="Quantity" required>
            <button type="submit" name="add_tool">Add Tool</button>
        </form>
    </body>
    </html>
            