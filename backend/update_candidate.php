<?php
session_start();
if (!isset($_SESSION['student_id']) || $_SESSION['role_id'] !== 0) { //Admin 
    header("Location: login.php");
    exit();
}

include '../db_connection.php';;

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get candidate ID from URL
$candidate_id = $_GET['id'];

// Fetch candidate data
$stmt = $conn->prepare("SELECT * FROM candidates WHERE id = ?");
$stmt->bind_param("i", $candidate_id);
$stmt->execute();
$result = $stmt->get_result();
$candidate = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Candidate</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <h2>Edit Candidate</h2>
        <form action="update_candidate_process.php?id=<?php echo $candidate['id']; ?>" method="POST">
            <label for="name">Candidate Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $candidate['name']; ?>" required><br><br>
            <label for="party_list">Party List:</label><br>
            <input type="text" id="party_list" name="party_list" value="<?php echo $candidate['party_list']; ?>" required><br><br>
            <label for="position">Position:</label><br>
            <input type="text" id="position" name="position" value="<?php echo $candidate['position']; ?>" required><br><br>
            <input type="submit" value="Update Candidate">
        </form>
        <a href="candidates_management.php">Back to Candidates Management</a>
    </div>
</body>
</html>
