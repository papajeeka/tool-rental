<?php
include '../connection.php';

$id = $_GET['id'];

// Fetch existing data
$result = $conn->query("SELECT * FROM tools WHERE id = $id");
$row = $result->fetch_assoc();

// Update logic
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $quipment_type = $_POST['equipment_type'];
    $serial_number = $_POST['serial_number'];
    $item_condition = $_POST['item_condition'];
    $quantity = $_POST['quantity'];

    $conn->query("UPDATE tools 
                  SET name='$name', equipment_type='$quipment_type', 
                      serial_number='$serial_number', item_condition='$item_condition', quantity='$quantity'
                  WHERE id=$id");

    header("Location: edit_equipment.php"); // go back after update
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tool</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">

<div class="bg-white p-6 rounded-xl shadow-md w-96">
    <h2 class="text-xl font-bold mb-4">Edit Tool</h2>

    <form method="POST">
        <input type="text" name="name" value="<?php echo $row['name']; ?>" 
               class="w-full border p-2 mb-3 rounded" required>

        <input type="text" name="equipment_type" value="<?php echo $row['equipment_type']; ?>" 
               class="w-full border p-2 mb-3 rounded" required>

        <input type="text" name="serial_number" value="<?php echo $row['serial_number']; ?>" 
               class="w-full border p-2 mb-3 rounded" required>

        <select name="item_condition" class="w-full border p-2 mb-3 rounded">
            <option <?php if($row['item_condition']=="New") echo "selected"; ?>>New</option>
            <option <?php if($row['item_condition']=="Good") echo "selected"; ?>>Good</option>
        </select>

        <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" 
               class="w-full border p-2 mb-3 rounded" required>

        <button type="submit" name="update" 
                class="bg-blue-600 text-white px-4 py-2 rounded w-full">
            Update Tool
        </button>
    </form>
</div>

</body>
</html>