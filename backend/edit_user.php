<?php
include '../db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = $_GET['student_id'] ?? null;

if ($student_id === null || !preg_match('/^\d{2}-\d{4}$/', $student_id)) {
    die("Invalid User ID. Please ensure the format is correct (e.g., 23-1949).");
}

// Fetch user data
$stmt = $conn->prepare("SELECT * FROM users WHERE student_id = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("User not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $surname = $_POST['surname'];
    $hashed_password = password_hash($surname, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET first_name = ?, surname = ?, password = ? WHERE student_id = ?");
    $stmt->bind_param("sssi", $first_name, $surname, $hashed_password, $student_id);

    if ($stmt->execute()) {
        echo "User updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: ../admin/admin-dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="icon" type="image/png" href="../Pics/ELECT-icon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Saira:wght@600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap">
    <link rel="stylesheet" href="../css/backend.css">
</head>

<body>
    <div class="container">
        <div class="header-message">
            <?php echo "Student ID from URL: " . htmlspecialchars($student_id) . "<br>"; ?><br><br>
        </div>
        <form action="add_user.php" method="POST">
            <label for="student_id">Student ID:</label><br>
            <input type="text" id="student_id" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>" readonly><br>

            <label for="first_name">First Name:</label><br>
            <input type="text" id="first_name" name="first_name" required><br>

            <label for="surname">Surname:</label><br>
            <input type="text" id="surname" name="surname" required><br>

            <label for="role">Role:</label><br>
            <select id="role" name="role" required>
                <option value="0">Admin</option>
                <option value="1">Voter</option>
            </select><br><br>

            <button class="AUSER" type="submit">EDIT USER</button><br><br>
            <button class="AUSER" type="button" onclick="window.location.href='../admin/admin-dashboard.php'">Go Back?</button>
        </form>
    </div>
</body>

</html>