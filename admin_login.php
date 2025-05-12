<?php
session_start();
include 'connection.php';

$msg = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Escape input
    $username = mysqli_real_escape_string($conn, $username);

    // Check if admin exists
    $query = "SELECT * FROM users WHERE user_id='$username' AND role='admin'";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['user_id'];
        header("Location: admin/dashboard.php");
        exit();
    } else {
        $msg = "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Admin ID" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
    <p style="color:red;"><?php echo $msg; ?></p>
</body>
</html>
