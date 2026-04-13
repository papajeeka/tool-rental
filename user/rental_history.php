<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT rentals.*, tools.name 
        FROM rentals
        JOIN tools ON rentals.equipment_id = tools.id
        WHERE rentals.users_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <title>Rental History</title>
    </head>
<body>
    <h2>Rental History</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>Tool Name</th>
            <th>Rent Date</th>
            <th>Due Date</th>
            <th>Return Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['rent_date']; ?></td>
                <td><?php echo $row['due_date']; ?></td>
                <td><?php echo $row['return_date'] ? $row['return_date'] : 'Not returned'; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <?php if ($row['status'] === 'rented') { ?>
                        <a href="return_equipment.php?rental_id=<?php echo $row['id']; ?>&tool_id=<?php echo $row['equipment_id']; ?>">Return</a>
                    <?php } else { ?>
                        completed
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    </body>
</html>