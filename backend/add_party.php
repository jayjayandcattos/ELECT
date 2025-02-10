<?php
include '../db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $platform = $_POST['platform'];

    $target_dir = "../Pics/party_lists/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if ($check === false) {
        $message = "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["picture"]["size"] > 500000) {
        $message = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType !== 'png') {
        $message = "Sorry, only PNG files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $message = $message ?: "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO party_lists (name, picture, platform) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $target_file, $platform);
            if ($stmt->execute()) {
                $message = "Party list successfully added!";
                header("Location: ../admin/admin-dashboard.php");
                exit();
            } else {
                $message = "Error: " . $stmt->error;
            }
        } else {
            $message = "Error uploading file.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/backend.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap">
    <link rel="icon" type="image/png" href="../Pics/ELECT-icon.png">
    <title>Add Party List</title>
</head>

<body>
    <div class="EPcontainer">
        <h2>Add New Party List</h2>
        <form action="add_party.php" method="POST" enctype="multipart/form-data">
            <div class="form-section">
                <div class="image-section">
                    <div class="image-preview" id="imagePreview">
                        <span>No image chosen</span><br><br>
                    </div>
                    <input type="file" name="picture" id="picture" accept=".png" required onchange="previewImage(event)">
                </div><br>
                <div class="text-section">
                    <label for="name">Party List Name:</label><br><br>
                    <input type="text" name="name" id="name" required>

                    <label for="platform">Platform:</label><br><br>
                    <textarea name="platform" id="platform" rows="5" required></textarea>
                </div><br>
            </div>
            <button class="AUSER" type="submit">ADD PARTY</button><br><br>
            <button class="AUSER" type="button" onclick="window.location.href='../admin/admin-dashboard.php'">Go Back?</button>
        </form>

    </div>

    <script>
        function previewImage(event) {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';
            const file = event.target.files[0];
            if (file) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                previewContainer.appendChild(img);
            }
        }

        <?php if (!empty($message)) : ?>
            alert("<?php echo $message; ?>");
        <?php endif; ?>
    </script>
</body>

</html>