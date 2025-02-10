<?php
include '../db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['candidate_id']) && is_numeric($_GET['candidate_id'])) {
    $candidate_id = $_GET['candidate_id'];

    //Archive the candidate before deletion
    $archive_stmt = $conn->prepare("INSERT INTO archived_candidates (candidate_id, first_name, surname, position, party_list, picture) SELECT candidate_id, first_name, surname, position, party_list, picture FROM candidates WHERE candidate_id = ?");
    $archive_stmt->bind_param("i", $candidate_id);

    if ($archive_stmt->execute()) {
        //Delete the candidate from the original table
        if ($archive_stmt->affected_rows > 0) {
            $delete_stmt = $conn->prepare("DELETE FROM candidates WHERE candidate_id = ?");
            $delete_stmt->bind_param("i", $candidate_id);

            if ($delete_stmt->execute()) {
                echo "Candidate deleted successfully.";
            } else {
                echo "Error deleting candidate: " . $delete_stmt->error;
            }

            $delete_stmt->close();
        } else {
            echo "No such candidate found.";
        }
    } else {
        echo "Error archiving candidate: " . $archive_stmt->error;
    }

    $archive_stmt->close();
} else {
    die("Invalid candidate ID.");
}

$conn->close();
header("Location: ../admin/admin-dashboard.php");  
exit();
?>
