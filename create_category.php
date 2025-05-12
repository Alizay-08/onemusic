<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: admin_login.php");
    exit();
}

include("../includes/connection.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $name = $_POST['name'];

    $db = getDB();
    $query = "INSERT INTO categories (type, name) VALUES (:type, :name)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':name', $name);
    $stmt->execute();

    echo "Category added successfully!";
}
?>

<h1>Create Category</h1>

<form method="POST">
    Type: 
    <select name="type" required>
        <option value="year">Year</option>
        <option value="artist">Artist</option>
        <option value="album">Album</option>
        <option value="genre">Genre</option>
        <option value="language">Language</option>
    </select><br>
    Name: <input type="text" name="name" required><br>
    <button type="submit">Create Category</button>
</form>
