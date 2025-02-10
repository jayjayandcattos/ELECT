<?php
// db_connection.php
$servername = 'localhost';      // Your database host
$dbname = 'electovs'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
