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

// Get form data
$name = $_POST['name'];
$party_list = $_POST['party_list'];
$position = $_POST['position'];

// Insert new candidate into the database
$stmt = $conn->prepare("INSERT INTO candidates (name, party_list, position, vote_count) VALUES (?, ?, ?, 0)");
$stmt->bind_param("sss", $name, $party_list, $position);

if ($stmt->execute()) {
    echo "Candidate added successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
header("Location: ../admin/admin-dashboard.php");
exit();
?>
