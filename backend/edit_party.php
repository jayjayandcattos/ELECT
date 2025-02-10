<?php
session_start();
if (!isset($_SESSION['student_id']) || $_SESSION['role_id'] !== 0) {
    header("Location: login.php");
    exit();
}
include '../db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['party_id'])) {
    $party_id = $_GET['party_id'];
    $result = $conn->query("SELECT * FROM party_lists WHERE party_id = $party_id");
    $partylist = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $platform = $_POST['platform'];
        $picture = $partylist['picture'];

        if (!empty($_FILES["picture"]["name"])) {
            $target_dir = "uploads/party_lists/";
            $target_file = $target_dir . basename($_FILES["picture"]["name"]);
            move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
            $picture = $target_file;
        }

        $stmt = $conn->prepare("UPDATE party_lists SET name = ?, picture = ?, platform = ? WHERE party_id = ?");
        $stmt->bind_param("sssi", $name, $picture, $platform, $party_id);
        if ($stmt->execute()) {
            echo "Party List updated successfully!";
            header("Location: ../admin/admin-dashboard.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
} else {
    die("Invalid Party List ID.");
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Party List</title>
    <link rel="stylesheet" type="text/css" href="../css/dashboardcontent.css">
    <link rel="icon" type="image/png" href="../Pics/ELECT-icon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/backend.css">
</head>

<body>
    <div class="EPcontainer">
        <h2>Edit Party List</h2>
        <form action="edit_party.php?id=<?php echo $party_id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-section">
                <div class="image-section">
                    <div class="image-preview">
                        <img src="<?php echo $partylist['picture']; ?>" alt="Current Picture">
                    </div>
                    <input type="file" name="picture" id="picture"><br><br>
                </div>
                <div class="text-section">
                    <label for="name">Party List Name:</label><br><br>
                    <input type="text" name="name" id="name" value="<?php echo $partylist['name']; ?>" required>

                    <label for="platform">Platform:</label><br><br>
                    <textarea name="platform" id="platform" rows="5" required><?php echo $partylist['platform']; ?></textarea>
                </div>
            </div>
            <button class="AUSER" type="submit">EDIT PARTY</button><br><br>
            <button class="AUSER" type="button" onclick="window.location.href='../admin/admin-dashboard.php'">Go Back?</button>
        </form>
    </div>
</body>

</html>