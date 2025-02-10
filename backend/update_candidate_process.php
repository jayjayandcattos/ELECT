<?php
session_start();
if (!isset($_SESSION['student_id']) || $_SESSION['role_id'] !== 0) { // Admin 
    header("Location: login.php");
    exit();
}

include '../db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get candidate ID from URL
$candidate_id = $_GET['id'];
$name = $_POST['name'];
$party_list = $_POST['party_list'];
$position = $_POST['position'];

// Update candidate in the database
$stmt = $conn->prepare("UPDATE candidates SET name = ?, party_list = ?, position = ? WHERE id = ?");
$stmt->bind_param("sssi", $name, $party_list, $position, $candidate_id);

if ($stmt->execute()) {
    echo "Candidate updated successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
header("Location: candidates_management.php");
exit();
?>
