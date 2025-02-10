<?php
include '../db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    
    $archive_stmt = $conn->prepare("INSERT INTO archived_users (student_id, first_name, surname, role_id) SELECT student_id, first_name, surname, role_id FROM users WHERE student_id = ?");
    $archive_stmt->bind_param("s", $student_id);
    
    
    if ($archive_stmt->execute()) {
            
        $stmt = $conn->prepare("DELETE FROM users WHERE student_id = ?");
        $stmt->bind_param("s", $student_id);

        if ($stmt->execute()) {
            header("Location: ../admin/admin-dashboard.php"); 
            exit();
        } else {
            echo "Error deleting user: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error archiving user: " . $archive_stmt->error;
    }

    $archive_stmt->close();
} else {
    die("Invalid user ID.");
}

$conn->close();
?>
