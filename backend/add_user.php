<?php
include '../db_connection.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$roles_result = $conn->query("SELECT id, role_name FROM roles");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $surname = $_POST['surname'];
    $role_id = $_POST['role'];

    if (!preg_match("/^\d{2}-\d{4}$/", $student_id)) {
        echo "Error: Student ID must be in the format XX-XXXX (2 digits followed by a dash and 4 digits).";
        exit();
    }

    $hashed_password = password_hash($surname, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (student_id, first_name, surname, password, role_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $student_id, $first_name, $surname, $hashed_password, $role_id);

    if ($stmt->execute()) {

        header("Location: ../admin/admin-dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="icon" type="image/png" href="../Pics/ELECT-icon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Saira:wght@600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap">
    <link rel="stylesheet" href="../css/backend.css">
</head>

<body>
    <div class="container">
        <h2>Add User</h2>
        <form action="add_user.php" method="POST">
            <label for="student_id">Student ID:</label><br><br>
            <input type="text" id="student_id" name="student_id" required><br>
            <br>
            <label for="first_name">First Name:</label><br><br>
            <input type="text" id="first_name" name="first_name" required><br>

            <label for="surname">Surname:</label><br><br>
            <input type="text" id="surname" name="surname" required><br>

            <label for="role">Role:</label><br>
            <select id="role" name="role" required>
                <option value="0">Admin</option>
                <option value="1">Voter</option>
            </select><br>

            <?php
            // dropdown with roles from the database
            while ($role = $roles_result->fetch_assoc()) {
                echo '<option value="' . $role['id'] . '">' . ucfirst($role['role_name']) . '</option>';
            }
            ?>
            </select><br><br>

            <button class="AUSER" type="submit">ADD USER</button><br><br>
            <button class="AUSER" type="button" onclick="window.location.href='../admin/admin-dashboard.php'">Go Back?</button>
            <form>
    </div>
</body>

<script>
    document.querySelector("form").addEventListener("submit", function(event) {
        const studentId = document.getElementById("student_id").value;
        const studentIdRegex = /^\d{2}-\d{4}$/;

        if (!studentIdRegex.test(studentId)) {
            alert("Error: Student ID must be in the format XX-XXXX (2 digits followed by a dash and 4 digits).");
            event.preventDefault();
        }
    });
</script>



</html>

<?php
$conn->close();
?>