<?php
session_start();
include 'db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $password = $_POST['password']; // NO HASHING

    // Duplicate email check
    $check = $conn->prepare("SELECT user_id FROM tbl_user WHERE user_email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $check->close();
        header("Location: register.php?error=email");
        exit();
    }
    $check->close();

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO tbl_user (user_name, user_email, user_contact, user_pass) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $contact, $password);

    if ($stmt->execute()) {
        $stmt->close();
        // Registration successful → Go to login page
        header("Location: ../login.php?success=registered");
        exit();
    } else {
        $stmt->close();
        header("Location: register.php?error=fail");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">
    <div class="form-container">
        <h2>Register</h2>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="User Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="contact" placeholder="Contact Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Register</button>

            <?php if (isset($_GET['error'])): ?>
                <?php if ($_GET['error'] === 'email'): ?>
                    <div class="error auth-red auth-switch">Email already registered.</div>
                <?php elseif ($_GET['error'] === 'fail'): ?>
                    <div class="error auth-red auth-switch">Registration failed. Try again.</div>
                <?php endif; ?>
            <?php endif; ?>

            <p class="auth-switch">Already have an account? <a href="../login.php">Login 👆🏻</a></p>
        </form>
    </div>
</body>
</html>
