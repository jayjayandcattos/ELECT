<?php
include '../backend/db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, platform, picture, party_id FROM party_lists";  // Make sure to fetch party_id as well
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="../css/HeaderAdmin.css">
<link rel="stylesheet" href="../css/admin.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="party-container">
<h2 class="partylists-header">PARTYLISTS MANAGEMENT</h2>
  <div class="add-party-btn-container">
    <a href="../backend/add_party.php">
      <button class="add-party-btn">ADD NEW PARTY LIST</button>
    </a>
  </div>

  <?php
  $result->data_seek(0);

  while ($row = $result->fetch_assoc()) {
    echo "
      <div class='party'>
          <div class='party-banner' style='background-image: url(\"../Pics/" . htmlspecialchars($row['picture']) . "\");'></div>
          <div class='party-content'>
              <h2>" . htmlspecialchars($row['name']) . "</h2>
              <div class='action-buttons'>
                  <a href='../backend/edit_party.php?party_id=" . urlencode($row['party_id']) . "'><img src='../pics/edit.png' alt='Edit'></a>
                  <a href='../backend/delete_party.php?party_id=" . urlencode($row['party_id']) . "' onclick=\"return confirm('Are you sure you want to delete this party list?');\"><img src='../pics/delete.png' alt='Delete'></a>
              </div>
          </div>
      </div>";
  }
  ?>
</div>
