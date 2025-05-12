<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome, Admin!</h2>
    <ul>
        <li><a href="add_music.php">Add Music</a></li>
        <li><a href="add_video.php">Add Video</a></li>
        <li><a href="create_category.php">Manage Categories</a></li>
        <li><a href="manage_music.php">Manage Music</a></li>
        <li><a href="manage_videos.php">Manage Videos</a></li>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="edit_site_info.php">Edit Website Info</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
