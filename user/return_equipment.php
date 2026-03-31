<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['rental_id']) && isset($_GET['tool_id'])) {
    $rental_id = $_GET['rental_id'];
    $tool_id = $_GET['tool_id'];

    $return_date = date("y-m-d");

    $sql = "UPDATE rentals SET return_date = ?, status = 'returned' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $return_date, $rental_id);

    if ($stmt->execute()) {
        $updateSql = "UPDATE tools SET quantity = quantity + 1 WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("i", $tool_id);
        $updateStmt->execute();

        echo "Equipment returned successfully.";
        echo '<br><a href="rental_history.php">Back to Rental History</a>';
    } else {
        echo "Return failed.";
    }
}
?>
    