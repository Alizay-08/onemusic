<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: admin_login.php");
    exit();
}

include("../includes/connection.php");

// Fetch all users
$db = getDB();
$query = "SELECT * FROM users";
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll();

if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Delete the user from the database
    $query_delete = "DELETE FROM users WHERE user_id = :user_id";
    $stmt_delete = $db->prepare($query_delete);
    $stmt_delete->bindParam(':user_id', $delete_id);
    $stmt_delete->execute();
    header("Location: manage_users.php");
}
?>

<h1>Manage Users</h1>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    <?php foreach($users as $user) { ?>
    <tr>
        <td><?php echo $user['name']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['role']; ?></td>
        <td>
            <a href="manage_users.php?delete_id=<?php echo $user['user_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>
