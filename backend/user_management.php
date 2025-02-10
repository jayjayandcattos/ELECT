<?php
include '../db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users from the database
$result = $conn->query("SELECT * FROM users ORDER BY surname ASC, first_name ASC");

$admins = [];
$voters = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        if ($row['role_id'] == 0) {
            $admins[] = $row;
        } elseif ($row['role_id'] == 1) {
            $voters[] = $row;
        }
    }
} else {
    echo "Error fetching users: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/usermanagement.css">
</head>

<body>
    <h2>USER MANAGEMENT</h2>
    <div class="UMAN-big-box">
        <a href="../backend/add_user.php">
            <button class="UMAN-add-user-btn">ADD NEW USER</button>
        </a>
        <div class="UMAN-container">
            <!-- Admins Section -->
            <div class="UMAN-user-box UMAN-admin-box">
                <h3>ADMINS</h3>
                <table class="UMAN-user-table">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>ROLE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admins as $admin) { ?>
                            <tr class="UMAN-user-item">
                                <td class="UMAN-user-name"><?php echo htmlspecialchars($admin['first_name']) . ' ' . htmlspecialchars($admin['surname']); ?></td>
                                <td class="UMAN-user-role">Admin</td>
                                <td class="UMAN-action-icons">
                                    <a href="../backend/edit_user.php?student_id=<?php echo urlencode($admin['student_id']); ?>">
                                        <img src="../Pics/EDIT.png" alt="Edit Icon" class="UMAN-action-icon">
                                    </a>
                                    <a href="../backend/delete_user.php?student_id=<?php echo urlencode($admin['student_id']); ?>" onclick="return confirm('Are you sure you want to delete this admin?');">
                                        <img src="../Pics/DELETE.png" alt="Delete Icon" class="UMAN-action-icon">
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Voters Section -->
            <div class="UMAN-user-box UMAN-voter-box">
                <h3>VOTERS</h3>
                <table class="UMAN-user-table">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>ROLE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($voters as $voter) { ?>
                            <tr class="UMAN-user-item">
                                <td class="UMAN-user-name"><?php echo htmlspecialchars($voter['first_name']) . ' ' . htmlspecialchars($voter['surname']); ?></td>
                                <td class="UMAN-user-role">Voter</td>
                                <td class="UMAN-action-icons">
                                    <a href="../backend/edit_user.php?student_id=<?php echo urlencode($voter['student_id']); ?>">
                                        <img src="../Pics/EDIT.png" alt="Edit Icon" class="UMAN-action-icon">
                                    </a>
                                    <a href="../backend/delete_user.php?student_id=<?php echo urlencode($voter['student_id']); ?>" onclick="return confirm('Are you sure you want to delete this voter?');">
                                        <img src="../Pics/DELETE.png" alt="Delete Icon" class="UMAN-action-icon">
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>

</html>
