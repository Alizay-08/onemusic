<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: admin_login.php");
    exit();
}

include("../includes/connection.php");

// Fetch all music entries
$db = getDB();
$query = "SELECT * FROM music";
$stmt = $db->prepare($query);
$stmt->execute();
$music_entries = $stmt->fetchAll();

if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Delete the music entry from the database
    $query_delete = "DELETE FROM music WHERE id = :id";
    $stmt_delete = $db->prepare($query_delete);
    $stmt_delete->bindParam(':id', $delete_id);
    $stmt_delete->execute();
    header("Location: manage_music.php");
}
?>

<h1>Manage Music</h1>

<table border="1">
    <tr>
        <th>Title</th>
        <th>Artist</th>
        <th>Year</th>
        <th>Actions</th>
    </tr>
    <?php foreach($music_entries as $music) { ?>
    <tr>
        <td><?php echo $music['title']; ?></td>
        <td><?php echo $music['artist']; ?></td>
        <td><?php echo $music['year']; ?></td>
        <td>
            <a href="edit_music.php?id=<?php echo $music['id']; ?>">Edit</a> | 
            <a href="manage_music.php?delete_id=<?php echo $music['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>
