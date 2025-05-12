<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: admin_login.php");
    exit();
}

include("../includes/connection.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $album = $_POST['album'];
    $language = $_POST['language'];
    $image = $_FILES['image']['name'];
    $file = $_FILES['file']['name'];

    // Move uploaded files to the server directory
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/images/$image");
    move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/music/$file");

    $db = getDB();
    $query = "INSERT INTO music (title, artist, year, genre, album, language, image, file, created_at) 
              VALUES (:title, :artist, :year, :genre, :album, :language, :image, :file, NOW())";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':artist', $artist);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':album', $album);
    $stmt->bindParam(':language', $language);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':file', $file);
    $stmt->execute();

    echo "Music uploaded successfully!";
}
?>

<form method="POST" enctype="multipart/form-data">
    Title: <input type="text" name="title" required><br>
    Artist: <input type="text" name="artist" required><br>
    Year: <input type="number" name="year" required><br>
    Genre: <input type="text" name="genre" required><br>
    Album: <input type="text" name="album" required><br>
    Language: <input type="text" name="language" required><br>
    Image: <input type="file" name="image" required><br>
    Music File: <input type="file" name="file" required><br>
    <button type="submit">Add Music</button>
</form>
