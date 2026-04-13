<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['add_tool'])) {
    $name = $_POST['name'];
    $equipment_type = $_POST['equipment_type'];
    $serial_number = $_POST['serial_number'];
    $condition = $_POST['item_condition'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO tools (name, equipment_type, serial_number, item_condition, quantity) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $equipment_type, $serial_number, $condition, $quantity);

    if ($stmt->execute()) {
        echo "Tool added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tool</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8">
        
        <!-- Header -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
            Add New Tool
        </h2>

        <!-- Form -->
        <form method="POST" class="space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Tool Name
                </label>
                <input type="text" name="name" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="e.g. Drill Machine">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Equipment Type
                </label>
                <input type="text" name="equipment_type" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Brief description">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Serial Number
                </label>
                <input type="text" name="serial_number" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="e.g. DRL-001">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Condition
                </label>
                <select name="item_condition" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select condition</option>
                    <option value="new">New</option>
                    <option value="good">Good</option>
                    <option value="fair">Fair</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Quantity
                </label>
                <input type="number" name="quantity" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="e.g. 5">
            </div>

            <!-- Button -->
            <button type="submit" name="add_tool"
                class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                Add Tool
            </button>

        </form>
    </div>

</body>
</html>
            