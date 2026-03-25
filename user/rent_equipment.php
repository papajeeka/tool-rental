<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $tool_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $checkSql = "SELECT quantity FROM tools WHERE id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $tool_id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $equipment = $result->fetch_assoc();

    if ($equipment && $equipment['quantity'] > 0) {
        $rent_date = date("y-m-d");
        $return_date = date("y-m-d", strtotime("+7 days"));

        $insertSql = "INSERT INTO rentals (user_id, tool_id, rent_date, return_date) VALUES (?, ?, ?, ?, 'rented')";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("iiss", $user_id, $tool_id, $rent_date, $return_date);

        if ($insertStmt->execute()) {
            $updateSql = "UPDATE tools SET quantity = quantity - 1 WHERE id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("i", $tool_id);
            $updateStmt->execute();

            echo "Equipment rented successfully.";
            echo '<br><a href="dashboard.php">Back to Dashboard</a>';
        } else {
            echo "Rental failed.";
        }
    } else {
        echo "Equipment not available.";
    }
}
?>