<?php
$conn = new mysqli("localhost", "root", "", "electovs");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM candidates ORDER BY candidate_id DESC");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Candidates Management</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap">
</head>

<body>
    <h2 class="CMAN-h2">CANDIDATES MANAGEMENT</h2>
    <div class="CMAN-container">
        <div class="CMAN-btn-container">
            <a href="../backend/add_candidate.php">
                <button class="CMAN-add-candidate-btn">ADD NEW CANDIDATE</button>
            </a>
        </div>


        <table class="CMAN-table">
            <thead>
                <tr class="CMAN-tr">
                    <th class="CMAN-th">NAME</th>
                    <th class="CMAN-th">POSITION</th>
                    <th class="CMAN-th">PARTY LIST</th>
                    <th class="CMAN-th">PLATFORM</th>
                    <th class="CMAN-th">PICTURE</th>
                    <th class="CMAN-th">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli("localhost", "root", "", "electovs");
                $result = $conn->query("SELECT * FROM candidates");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='CMAN-tr'>";
                    echo "<td class='CMAN-td'>" . htmlspecialchars($row['first_name'] . ' ' . $row['surname']) . "</td>";
                    echo "<td class='CMAN-td'>" . htmlspecialchars($row['position']) . "</td>";
                    echo "<td class='CMAN-td'>" . htmlspecialchars($row['party_list']) . "</td>";
                    echo "<td class='CMAN-td'>" . htmlspecialchars($row['platform']) . "</td>";
                    echo "<td class='CMAN-td'><img class='CMAN-candidate-img' src='" . htmlspecialchars($row['picture']) . "' alt='Candidate Picture'></td>";
                    echo "<td class='CMAN-td'>
                          <a href='../backend/edit_candidate.php?candidate_id=" . htmlspecialchars($row['candidate_id']) . "'>
                              <img class='CMAN-action-icon' src='../Pics/EDIT.png' alt='Edit'>
                          </a> 
                          <a href='../backend/delete_candidate.php?candidate_id=" . htmlspecialchars($row['candidate_id']) . "' 
                             onclick=\"return confirm('Are you sure you want to delete this candidate?');\">
                              <img class='CMAN-action-icon' src='../Pics/DELETE.png' alt='Delete'>
                          </a>
                          </td>";
                    echo "</tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>