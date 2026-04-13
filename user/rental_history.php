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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental History</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Rental History</h2>
            <p class="text-gray-500 mt-1">Track your rented tools, due dates, and return status.</p>
        </div>

        <!-- Table Card -->
        <div class="bg-white shadow-md rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-800 text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Tool Name</th>
                            <th class="px-6 py-4">Rent Date</th>
                            <th class="px-6 py-4">Due Date</th>
                            <th class="px-6 py-4">Return Date</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-800">
                                <?php echo $row['name']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row['rent_date']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row['due_date']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row['return_date'] ? $row['return_date'] : 'Not returned'; ?>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                    <?php
                                        if ($row['status'] === 'returned') {
                                            echo 'bg-green-100 text-green-700';
                                        } elseif ($row['status'] === 'overdue') {
                                            echo 'bg-red-100 text-red-700';
                                        } else {
                                            echo 'bg-yellow-100 text-yellow-700';
                                        }
                                    ?>">
                                    <?php echo ucfirst($row['status']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($row['status'] === 'rented') { ?>
                                    <a href="return_equipment.php?rental_id=<?php echo $row['id']; ?>&tool_id=<?php echo $row['equipment_id']; ?>"
                                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                                       Return
                                    </a>
                                <?php } else { ?>
                                    <span class="text-gray-500 font-medium">Completed</span>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>