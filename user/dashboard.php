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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Tool Rental</h1>
            <div class="flex gap-4">
                <a href="rental_history.php" class="text-blue-600 font-medium hover:underline">
                    Rental History
                </a>
                <a href="../logout.php" class="text-red-500 font-medium hover:underline">
                    Logout
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-8">

        <!-- Page Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Browse Tools</h2>
            <p class="text-gray-500 mt-1">Search and rent available tools from the inventory.</p>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <form method="GET" class="flex flex-col sm:flex-row gap-3">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search by name or description..."
                    class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button 
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                    Search
                </button>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-md rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-600">
                    
                    <!-- Table Header -->
                    <thead class="bg-gray-800 text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Description</th>
                            <th class="px-6 py-4">Condition</th>
                            <th class="px-6 py-4">Available</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody class="divide-y divide-gray-200">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4 font-medium text-gray-800">
                                <?php echo $row['name']; ?>
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
                                <?php if ($row['quantity'] > 0) { ?>
                                    <a href="rent_equipment.php?id=<?php echo $row['id']; ?>"
                                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                                       Rent
                                    </a>
                                <?php } else { ?>
                                    <span class="text-red-500 font-medium">
                                        Out of Stock
                                    </span>
                                <?php } ?>
                            </td>

                        </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>

    </main>

</body>
</html>