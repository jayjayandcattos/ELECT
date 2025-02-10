<?php

include '../db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$party_lists = [];
$sql = "SELECT party_id, name FROM party_lists";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $party_lists[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $surname = $conn->real_escape_string($_POST['surname']);
    $position = $conn->real_escape_string($_POST['position']);
    $party_list = $conn->real_escape_string($_POST['party_list']);
    $platform = $conn->real_escape_string($_POST['platform']);
    $timestamp = date('Y-m-d H:i:s');

    $target_dir = "../Pics/candidate_pictures/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $uploadOk = 1; // Initialize the flag

    // Validate if the file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File is not an image.');</script>";
        $uploadOk = 0;
    }

    // Validate file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }

    // Validate file type
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    if ($imageFileType !== 'png') {
        echo "<script>alert('Sorry, only PNG files are allowed.');</script>";
        $uploadOk = 0;
    }

    // Check if file validation passed
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.');</script>";
    } else {
        // Attempt to upload the file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "<script>alert('The file  " . htmlspecialchars(basename($_FILES["image"]["name"])) .   " has been uploaded.');</script>";
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }


    $stmt = $conn->prepare("INSERT INTO candidates (first_name, surname, position, party_list, platform, picture, timestamp) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $first_name, $surname, $position, $party_list, $platform, $target_file, $timestamp);

    if ($stmt->execute()) {
        echo "<script>alert('Candidate added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Candidate</title>
    <link rel="stylesheet" href="../css/backend.css">
    <link rel="icon" type="image/png" href="../Pics/ELECT-icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap" rel="stylesheet">

<body>
    <div class="ACcontainer">
        <h2>ADD CANDIDATE</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-section">
                <label for="first_name">First Name:</label><br><br>
                <input type="text" id="first_name" name="first_name" required><br>

                <label for="surname">Surname:</label><br><br>
                <input type="text" id="surname" name="surname" required><br>

                <label for="position">Position:</label><br><br>
                <select id="position" name="position" required><br>
                    <option value="">SELECT POSITION</option>
                    <option value="President">President</option>
                    <option value="Vice President for Operations">Vice President for Operations</option>
                    <option value="Vice President for Internal Affairs">Vice President for Internal Affairs</option>
                    <option value="Vice President for External Affairs">Vice President for External Affairs</option>
                    <option value="Executive Secretary">Secretary</option>
                    <option value="Treasurer">Treasurer</option>
                    <option value="Auditor">Auditor</option>
                    <option value="Councilor for Membership">Councilor for Membership</option>
                    <option value="Councilor for Internal Affairs">Councilor for Internal Affairs</option>
                    <option value="Councilor for External Affairs">Councilor for External External</option>
                    <option value="Councilor for Logistics & Events">Councilor for Logistics & Events</option>
                    <option value="Councilor for Documentaries and Reports">Councilor for Documentaries and Reports</option>
                    <option value="Councilor for Information Dissemination">Councilor for Information Dissemination</option>
                </select>

                <label for="party_list">Partylist:</label><br><br>
                <select id="party_list" name="party_list" required>
                    <option value="">Select Party List</option>
                    <?php foreach ($party_lists as $party): ?>
                        <option value="<?= $party['name']; ?>"><?= $party['name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="platform">Platform:</label><br><br>
                <textarea id="platform" name="platform" required></textarea><br><br>
            </div>

            <label for="image">Upload Image (PNG only):</label><br><br>
            <input type="file" id="image" name="image" accept="image/png" required><br><br>
            <div class="preview-container"><br><br>
                <img id="preview" src="#" alt="Image Preview" style="display: none;">
                <br><br>
            </div>

            <button class="AUSER" type="submit">ADD CANDIDATE</button><br><br>
            <button class="AUSER" type="button" onclick="window.location.href='../admin/admin-dashboard.php'">Go Back?</button>
            <form>
    </div>

    <script>
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('preview');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>
</body>

</html>