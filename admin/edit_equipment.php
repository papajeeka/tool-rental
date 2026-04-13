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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tools</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Edit Tools</h2>
            <p class="text-gray-500 mt-1">Manage and update the tools available in your rental inventory.</p>
        </div>

        <!-- Table Card -->
        <div class="bg-white shadow-md rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-800 text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Description</th>
                            <th class="px-6 py-4">Serial Number</th>
                            <th class="px-6 py-4">Condition</th>
                            <th class="px-6 py-4">Quantity</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-800">
                                <?php echo $row['id']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row['name']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row['equipment_type']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row['serial_number']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                    <?php
                                        if ($row['item_condition'] == 'new') {
                                            echo 'bg-green-100 text-green-700';
                                        } elseif ($row['item_condition'] == 'good') {
                                            echo 'bg-blue-100 text-blue-700';
                                        } else {
                                            echo 'bg-yellow-100 text-yellow-700';
                                        }
                                    ?>">
                                    <?php echo ucfirst($row['item_condition']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row['quantity']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <a href="delete_tool.php?id=<?php echo $row['id']; ?>"
                                   class="inline-block bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-600 transition"
                                   onclick="return confirm('Are you sure you want to delete this tool?');">
                                   Delete
                                </a>
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