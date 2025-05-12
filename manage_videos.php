<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: admin_login.php");
    exit();
}

include("../includes/connection.php");

// Fetch all video entries
$db = getDB();
$query = "SELECT * FROM videos";
$stmt = $db->prepare($query);
$stmt->execute();
$video_entries = $stmt->fetchAll();

if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Delete the video entry from the database
    $query_delete = "DELETE FROM videos WHERE id = :id";
    $stmt_delete = $db->prepare($query_delete);
    $stmt_delete->bindParam(':id', $delete_id);
    $stmt_delete->execute();
    header("Location: manage_videos.php");
}
?>

<h1>Manage Videos</h1>

<table border="1">
    <tr>
        <th>Title</th>
        <th>Artist</th>
        <th>Year</th>
        <th>Actions</th>
    </tr>
    <?php foreach($video_entries as $video) { ?>
    <tr>
        <td><?php echo $video['title']; ?></td>
        <td><?php echo $video['artist']; ?></td>
        <td><?php echo $video['year']; ?></td>
        <td>
            <a href="edit_video.php?id=<?php echo $video['id']; ?>">Edit</a> | 
            <a href="manage_videos.php?delete_id=<?php echo $video['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

