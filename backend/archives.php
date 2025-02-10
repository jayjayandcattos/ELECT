<?php
include '../backend/db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$usersQuery = "SELECT * FROM archived_users";
$usersResult = $conn->query($usersQuery);

$partyListsQuery = "SELECT * FROM archived_party_lists";
$partyListsResult = $conn->query($partyListsQuery);

$candidatesQuery = "SELECT * FROM archived_candidates";
$candidatesResult = $conn->query($candidatesQuery);
?>

<head>
    <title>ARCHIVES</title>
    <link rel="icon" type="image/png" href="../Pics/ELECT-icon.png">
    <link rel="stylesheet" href="../css/HeaderAdmin.css">
    <link rel="stylesheet" href="../css/admin.css"> <!-- Included admin.css here -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<h2>ARCHIVES</h2>
<button class="Archived-print-btn" onclick="window.print()">PRINT ARCHIVES</button> 


<div class="Archived-container">
    <div class="Archived-category">
        <h3>ARCHIVED USERS</h3>
        <table class="Archived-table">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>STUDENT ID</th>
                    <th>ROLE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user = $usersResult->fetch_assoc()) {
                    $role = $user['role_id'] == 1 ? 'Voter' : 'Admin';
                    echo "<tr>
                    <td>" . htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['surname']) . "</td>
                    <td>" . htmlspecialchars($user['student_id']) . "</td>
                    <td>" . $role . "</td>
                  </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="Archived-category">
        <h3>ARCHIVED PARTYLISTS</h3>
        <table class="Archived-table">
            <thead>
                <tr>
                    <th>PARTYLIST NAME</th>
                    <th>CREATED AT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($partyList = $partyListsResult->fetch_assoc()) {
                    echo "<tr>
                    <td>" . htmlspecialchars($partyList['name']) . "</td>
                    <td>" . htmlspecialchars($partyList['created_at']) . "</td>
                  </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="Archived-category">
        <h3>ARCHIVED CANDIDATES</h3>
        <table class="Archived-table">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>POSITION</th>
                    <th>ARCHIVED AT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($candidate = $candidatesResult->fetch_assoc()) {
                    echo "<tr>
                    <td>" . htmlspecialchars($candidate['first_name']) . " " . htmlspecialchars($candidate['surname']) . "</td>
                    <td>" . htmlspecialchars($candidate['position']) . "</td>
                    <td>" . htmlspecialchars($candidate['archived_at']) . "</td>
                  </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


</div>

<?php
$conn->close();
?>