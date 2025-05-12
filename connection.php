<?php
// Database configuration
define('DB_SERVER', 'localhost');          // Database host (localhost)
define('DB_USERNAME', 'root');             // Database username (root)
define('DB_PASSWORD', '');                 // Database password (null)
define('DB_DATABASE', 'onemusic_db');      // Database name (onemusic_db)

// Function to connect to the database
function getDB() {
    $dbConnection = null;
    try {
        // Establish the PDO connection
        $dbConnection = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        // Set the PDO error mode to exception
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // If connection fails, show the error message
        echo "Connection failed: " . $e->getMessage();
    }
    
    // Return the connection object
    return $dbConnection;
}

// Check the connection
$db = getDB();
if ($db) {
    echo "Connection successful!";
} else {
    echo "Failed to connect to the database.";
}
?>
