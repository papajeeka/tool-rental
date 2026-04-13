<?php
include 'connection.php';

$message = "";

if (isset($_POST['register'])) {

    // Get form values
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Check if passwords match
    if ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if username already exists
        $check_sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($check_sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "Username already exists.";
        } else {

            // Insert user into database
            $sql = "INSERT INTO users (fullname, email, username, password, role)
                    VALUES (?, ?, ?, ?, 'user')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $full_name, $email, $username, $hashed_password);
            if ($stmt->execute()) {
                $message = "Registration successful. You can now login.";
            } else {
                $message = "Error: Unable to register.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-box">
    <h2>Register</h2>

    <?php if ($message != "") { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>

    <form method="POST">

        <input type="text" name="full_name" placeholder="Full Name" required>

        <input type="email" name="email" placeholder="Email Address" required>

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <input type="password" name="confirm_password" placeholder="Confirm Password" required>

        <button type="submit" name="register">Register</button>

    </form>

    <p>Already have an account? <a href="index.php">Login here</a></p>

</div>

</body>
</html>