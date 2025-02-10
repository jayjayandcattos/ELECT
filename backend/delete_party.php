<?php
include '../db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['party_id'])) {
    $party_id = $_GET['party_id'];

    
    $archive_stmt = $conn->prepare("INSERT INTO archived_party_lists (name, created_at) SELECT name, created_at FROM party_lists WHERE party_id = ?");
    $archive_stmt->bind_param("i", $party_id);

    
    if ($archive_stmt->execute()) {
        
        $stmt = $conn->prepare("DELETE FROM party_lists WHERE party_id = ?");
        $stmt->bind_param("i", $party_id);

        if ($stmt->execute()) {
            header("Location: ../admin/admin-dashboard.php"); 
            exit();
        } else {
            echo "Error deleting party list: " . $stmt->error;
        }   

        $stmt->close();
    } else {
        echo "Error archiving party list: " . $archive_stmt->error;
    }

    $archive_stmt->close();
} else {
    die("Invalid party list ID.");
}

$conn->close();
?>
