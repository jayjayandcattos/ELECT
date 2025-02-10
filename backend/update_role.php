<?php
session_start();
if (!isset($_SESSION['student_id']) || $_SESSION['role_id'] !== 0) { //Admin 
    header("Location: login.php");
    exit();
}
include '../db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$role = $_POST['role'];

$stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
$stmt->bind_param("si", $role, $id);

if ($stmt->execute()) {
    echo "User role updated successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
header("Location: ../admin/admin-dashboard.php");
exit();
?>
