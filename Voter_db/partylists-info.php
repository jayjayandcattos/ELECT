<?php
// hi
include 'db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$party_lists = isset($_GET['party_lists']) ? $_GET['party_lists'] : '';
$party_stmt = $conn->prepare("SELECT name, platform, picture FROM party_lists WHERE name = ?");
$party_stmt->bind_param("s", $party_lists);
$party_stmt->execute();
$party_result = $party_stmt->get_result();
$party_info = $party_result->fetch_assoc();

echo "<div class='content-container'>";

if ($party_info) {
    echo "<div class='party-side'>
            <div class='party-card'>
                <img src='uploads/" . htmlspecialchars($party_info['picture']) . "' alt='Party Banner' class='party-pic'>
            </div>
            <div class='party-side-text'>
                <p style='display: inline-block; background: linear-gradient(90deg, #001a5f, #3a05ae); color: white; border-radius: 10px; padding: 6px 12px; margin-bottom:10px;'>PLATFORM</p>
                <p>" . htmlspecialchars($party_info['platform']) . "</p>
            </div>
          </div>";
} else {
    echo "<div class='party-side'><p>Party list details not found.</p></div>";
}


$candidate_stmt = $conn->prepare("SELECT first_name, surname, position, picture, platform FROM candidates WHERE party_list = ?");
$candidate_stmt->bind_param("s", $party_lists);
$candidate_stmt->execute();
$candidate_result = $candidate_stmt->get_result();

echo "<div class='candidates'>";
if ($candidate_result->num_rows > 0) {
    while ($row = $candidate_result->fetch_assoc()) {
        echo "<div class='candidate-card'>
                <img src='uploads/" . htmlspecialchars($row['picture']) . "' class='candidate-picture'>
                <div class='candidate-info'>
                    <h2 class='candidate-name'>" . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['surname']) . "</h2>
                    <p class='candidate-position'>" . htmlspecialchars($row['position']) . "</p>
                    <p class='candidate-platform'>" . htmlspecialchars($row['platform']) . "</p>
                </div>
              </div>";
    }
} else {
    echo "<p>No candidates found for this party list.</p>";
}
echo "</div>";

echo "</div>"; 

$party_stmt->close();
$candidate_stmt->close();
$conn->close();
?>



<style>
    /* Main content container */
    .content-container {
        display: flex;
        width: 100%;
        height: 100%;
        gap: 20px;
        padding: 20px;
        overflow-y: scroll;
        flex-wrap: wrap;
    }

    /* Party side container */
    .party-side {
        flex: 1;
        text-align: left;
        color: aliceblue;
        display: flex;
        flex-direction: column;
    }

    .party-side-text {
        padding: 20px;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.4);
        color: #141920;
        height: 100%;
        border: 3px solid transparent;
        transition: background-color 0.3s ease;
    }

    .party-side-text:hover {
        background-color: aliceblue;
    }

    .party-side p {
        font-family: Roboto;
        letter-spacing: 0.5px;
        line-height: 30px;
    }


    .party-card img.party-pic {
        width: 100%;
        height: auto;
        border-radius: 10px;
        aspect-ratio: 8 / 3;
        object-fit: cover;
        margin-bottom: 30px;
    }

    /* Candidates container */
    .candidates {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow-y: visible;
        max-height: 500px;
        gap: 15px;
        border-radius: 10px;
    }

    .candidate-card {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        gap: 20px;
        padding: 20px;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.4);
        border: 3px solid transparent;
        transition: background-color 0.3s ease;
    }

    .candidate-card:hover {
        background-color: aliceblue;
    }
 

    .candidate-picture {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid #00a3ff;
        object-fit: cover;
    }

    .candidate-info {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
    }

    .candidate-name {
        font-size: 24px;
        font-weight: bold;
        margin: 0;
    }

    .candidate-position {
        font-size: 20px;
        margin: 5px 0;
    }

    .candidate-platform {
        font-size: 18px;
        color: #777;
    }
</style>