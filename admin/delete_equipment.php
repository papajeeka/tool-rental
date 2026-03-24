<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM tools WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: edit_equipment.php");
        exit();
    } else {
        echo "failed to delete tool.";
    }
}
?>