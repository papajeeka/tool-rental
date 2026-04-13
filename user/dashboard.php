<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}


$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM tools WHERE name LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$search%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM tools");
}
?>
<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
</head>
<body>
    <h1>User Dashboard</h1>

    <form method="GET">
        <input type="text" name="search" placeholder="Search by name or description">
        <button type="submit">Search</button>
    </form>

    <table border="1" cellpadding="10">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Condition</th>
            <th>Available Quantity</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['serial_number']; ?></td>
            <td><?php echo $row['item_condition']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>
                <?php if ($row['quantity'] > 0) { ?>
                    <a href="rent_equipment.php?id=<?php echo $row['id']; ?>">Rent</a>
                <?php } else {?>
                    Out of Stock
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>

    <p><a href="rental_history.php">View Rental History</a></p>
    <p><a href="../logout.php">Logout</a></p>
</body>
</html>