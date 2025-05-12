<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: admin_login.php");
    exit();
}

include("../includes/connection.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $about = $_POST['about'];
    $homepage_text = $_POST['homepage_text'];

    $db = getDB();
    $query = "UPDATE site_info SET about = :about, homepage_text = :homepage_text WHERE id = 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':about', $about);
    $stmt->bindParam(':homepage_text', $homepage_text);
    $stmt->execute();

    echo "Site info updated successfully!";
}

// Fetch current site info
$db = getDB();
$query = "SELECT * FROM site_info WHERE id = 1";
$stmt = $db->prepare($query);
$stmt->execute();
$site_info = $stmt->fetch();
?>

<h1>Edit Site Info</h1>

<form method="POST">
    About Us: <textarea name="about" required><?php echo $site_info['about']; ?></textarea><br>
    Homepage Text: <textarea name="homepage_text" required><?php echo $site_info['homepage_text']; ?></textarea><br>
    <button type="submit">Update Info</button>
</form>
