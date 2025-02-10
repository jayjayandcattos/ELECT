<?php
include '../db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT c.first_name, c.surname, c.position, c.party_list, COUNT(v.candidate_id) AS total_votes
        FROM candidates c
        LEFT JOIN votes v ON c.candidate_id = v.candidate_id
        GROUP BY c.candidate_id";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOTE MONITORING</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap" />
    <link rel="stylesheet" href="../css/admin.css">
  
</head>

<body>
    <h2 class="VoteMonitoring-header">VOTE MONITORING</h2>
    <div class="VoteMonitoring-container">
        <button class="VoteMonitoring-print-btn" onclick="window.print()">PRINT RESULTS</button>
        <header class="VoteMonitoring-header"></header>
        <main class="VoteMonitoring-main">
            <table class="VoteMonitoring-table">
                <thead>
                    <tr>
                        <th>CANDIDATE NAME</th>
                        <th>POSITION</th>
                        <th>PARTY LIST</th>
                        <th>TOTAL VOTES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['first_name'] . " " . $row['surname']); ?></td>
                            <td><?php echo htmlspecialchars($row['position']); ?></td>
                            <td><?php echo htmlspecialchars($row['party_list']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_votes']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
    </div>
    <?php $conn->close(); ?>
</body>

</html>
