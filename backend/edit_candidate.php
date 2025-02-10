<?php
include '../db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['candidate_id'])) {
    $candidate_id = $_GET['candidate_id'];

    $stmt = $conn->prepare("SELECT * FROM candidates WHERE candidate_id = ?");
    $stmt->bind_param("i", $candidate_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $candidate = $result->fetch_assoc();

    if (!$candidate) {
        die("Candidate not found.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = $_POST['first_name'];
        $surname = $_POST['surname'];
        $position = $_POST['position'];
        $party_list = $_POST['party_list'];

        // Handle file upload
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../Pics/';
            $file_name = basename($_FILES['picture']['name']);
            $target_file = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_file)) {
                $picture = $file_name;
            } else {
                die("Failed to upload the picture.");
            }
        } else {
            $picture = $candidate['picture'];
        }

        $stmt = $conn->prepare("UPDATE candidates SET first_name = ?, surname = ?, position = ?, party_list = ?, picture = ? WHERE candidate_id = ?");
        $stmt->bind_param("sssssi", $first_name, $surname, $position, $party_list, $picture, $candidate_id);
        if ($stmt->execute()) {
            echo "Candidate updated successfully!";
            header("Location: ../admin/admin-dashboard.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
} else {
    die("Invalid candidate ID.");
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Candidate</title>
    <link rel="icon" type="image/png" href="../Pics/ELECT-icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/backend.css">
</head>

<body>
    <div class="ECcontainer">
        <h2>Edit Candidate</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="first_name">First Name:</label><br><br>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($candidate['first_name']); ?>" required><br>

            <label for="surname">Surname:</label><br><br>
            <input type="text" name="surname" value="<?php echo htmlspecialchars($candidate['surname']); ?>" required><br>

            <label for="position">Position:</label><br><br>
            <input type="text" name="position" value="<?php echo htmlspecialchars($candidate['position']); ?>" required><br>

            <label for="party_list">Party List:</label><br><br>
            <input type="text" name="party_list" value="<?php echo htmlspecialchars($candidate['party_list']); ?>" required><br>

            <label for="picture">Update Picture:</label><br><br>
            <input type="file" name="picture" accept="image/*"><br><br>
            <small>Current Picture: <br>
                <img src="../uploads/<?php echo htmlspecialchars($candidate['picture']); ?>" alt="Candidate Picture" style="max-height: 100px;"></small><br>

                <button class="AUSER" type="submit">EDIT CANDIDATE</button><br><br>
            <button class="AUSER" type="button" onclick="window.location.href='../admin/admin-dashboard.php'">Go Back?</button>
            
        </form>

    </div>
</body>

</html>