<?php 
session_start();
include 'user/db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password']; // NO HASHING

    // ✅ First check if admin credentials
    if ($email === "admin@4fold.com" && $password === "4fold") {
        $_SESSION['admin'] = [
            'email' => $email,
            'name' => 'Admin'
        ];
        header("Location: admin/index.php");
        exit();
    }

    // 🔹 Otherwise normal user login
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE user_email = ? AND user_pass = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $_SESSION['user'] = [
            'id' => $row['user_id'],
            'name' => $row['user_name'],
            'email' => $row['user_email'],
            'contact' => $row['user_contact']
        ];
        header("Location: user/index.php");
        exit();
    } else {
        header("Location: login.php?error=invalid");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="user/css/style.css">
</head>
<body class="auth-page">
    <div class="form-container">
        <h2>Login</h2>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Login</button>

            <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid'): ?>
                <div class="auth-switch auth-red">Invalid email or password.</div>
            <?php endif; ?>

            <p class="auth-switch">Don't have an account? <a href="user/register.php">Register</a></p>
        </form>
    </div>
</body>
</html>
