<?php

if (!isset($_SESSION['student_id']) || $_SESSION['role_id'] !== 1) {
    header("Location: index.php");
    exit();
}

include 'db_connection.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = $_SESSION['student_id'];
$sql_user = "SELECT student_id, CONCAT(first_name, ' ', surname) AS full_name FROM users WHERE student_id = '$student_id'";
$user_result = $conn->query($sql_user);
$voter_info = $user_result->fetch_assoc();

$sql_positions = "SELECT DISTINCT position FROM candidates";
$positions = $conn->query($sql_positions);
?>
<style>
    .container {
        display: flex;
        width: 100%;
        gap: 50px;
        padding: 20px;
        margin-bottom: 50px;
    }

    .right-info {
        width: 30%;
        position: absolute;
        top: 20%;
        right: 10%;
    }


    .right-info h1 {
        text-align: left;
        line-height: 60px;
    }

    .voter-info {
        border-radius: 20px;
        background: linear-gradient(90deg, #001a5f, #007ec5);
        padding: 20px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: auto;
        width: 100%;
        color: aliceblue;
        margin-top: 30px;
    }

    fieldset {
        margin-bottom: 20px;
        width: 100%;
        padding: 15px;
        border: 3px solid rgb(143 203 249);
        border-radius: 10px;
    }

    legend {
        font-weight: bold;
        color: #001a5f;
        padding: 10px;
        font-family: Saira;
    }

    .candidate-option {
        display: flex;
        align-items: center;
        margin: 20px;
    }

    label {
        font-size: 16px;
    }

    input[type="radio"] {
        margin: 0 30px;
        transform: scale(1.5);
    }

    .form-modal {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        overflow: hidden;
        transform: translateY(100%);
        transition: transform 0.5s ease;
    }

    .form-modal-content {
        background-color: rgba(0, 0, 255, 0.2);
        margin: 10% 20%;
        padding: 40px;
        border-radius: 30px;
        width: auto;
        height: auto;
        min-height: 590px;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        top: 30px;
        backdrop-filter: blur(60px);
        background: linear-gradient(to bottom,
                rgba(255, 255, 255, 0.8) 10%,
                rgba(255, 255, 255, 0.2) 40%,
                rgba(255, 255, 255, 0) 100%);
        border-radius: 20px;
        box-shadow:
            0 0 10px rgba(0, 126, 197, 0.5),
            0 0 15px rgba(0, 126, 197, 0.3);
        padding: 20px;
        box-sizing: border-box;
        overflow: hidden;
        outline: 3px solid #57cdff;
    }

    .sum {
        border-radius: 10px;
        box-sizing: border-box;
        border: rgb(185, 222, 255) solid 3px;
        padding: 20px 50px;
        margin: 20px;
        width: 700px;
        height: 280px;
        font-size: 15px;
        background-color: #f0f8ff61;
        font-family: Roboto;
        overflow-y: scroll;
    }

    /* OK Button */
    .ok-btn {
        background: linear-gradient(90deg, #001a5f, #007ec5);
        width: 100px;
        height: 60px;
        padding: 15px;
        font-size: 20px;
        color: white;
        margin-bottom: 50px;
    }

    .ok-btn:hover {
        background-color: #45a049;
    }

    .bottom {
        flex-direction: row;
        display: flex;
        gap: 40px;
        position: absolute;
        bottom: 60px;
        justify-content: center;
        align-items: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
        border: 1px solid transparent;
    }

    .candidate-option label {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    .candidate-option label>span {
        display: table-cell;
    }

    .candidate-option label>span:first-child {
        width: 60%;
    }

    .candidate-option label>span:last-child {
        width: 40%;
        text-align: right;
    }

    #backButtonContainer {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(2px);
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 20%;
        left: 10%;
        border: #00a2ff solid 3px;
    }

    #backButton {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        transition: none;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #1e2230;
    }

    #backButton:hover {
        transform: none;
        box-shadow: none;
        border: none;
    }

    #backButton::before {
        display: none;
    }

    #backButton img {
        width: 40px;
        height: auto;
        opacity: 0.5;
        transition: opacity 0.3s ease;
    }

    #backButton img:hover {
        opacity: 1;
    }

    .voter-info input {
        filter: blur(5px);
        transition: filter 0.3s ease;
    }

    .voter-info:hover input {
        filter: blur(0);
    }
</style>



<div class="container">
    <div class="box-outline">
        <div class="enlarge" id="backButtonContainer">
            <button id="backButton">
                <img src="Pics/back.png" alt="Back">
            </button>
        </div>

        <h3>Please vote <span style="color: orange;">ONLY ONE</span> candidate in each <br>position, thank you!</h3>
        <form action="" method="POST" id="votingForm">
            <?php if ($positions->num_rows > 0): ?>
                <?php while ($position = $positions->fetch_assoc()): ?>
                    <fieldset>
                        <legend><?= htmlspecialchars($position['position']); ?></legend>
                        <?php
                        $sql_candidates = "
    SELECT candidate_id, first_name, surname, party_list 
    FROM candidates 
    WHERE position = '" . $conn->real_escape_string($position['position']) . "'
";
                        $candidates = $conn->query($sql_candidates);
                        ?>

                        <?php if ($candidates->num_rows > 0): ?>
                            <?php while ($candidate = $candidates->fetch_assoc()): ?>
                                <div class="candidate-option">
                                    <input type="radio" id="candidate_<?= $candidate['candidate_id']; ?>" name="vote[<?= $position['position']; ?>]" value="<?= $candidate['candidate_id']; ?>" required>
                                    <label for="candidate_<?= $candidate['candidate_id']; ?>">
                                        <span><?= htmlspecialchars($candidate['first_name']) . " " . htmlspecialchars($candidate['surname']); ?></span>
                                        <span style="color: #0088fe; font-weight: bold;"><?= htmlspecialchars($candidate['party_list']); ?></span>
                                    </label>

                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No candidates available for this position.</p>
                        <?php endif; ?>
                    </fieldset>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No positions available.</p>
            <?php endif; ?>
            <br>
            <button type="submit" class="btn-submitVote" style="margin-top: 20px;">Submit Vote</button>
        </form>
    </div>

    <!-- Voter Information Sidebar -->
    <div class="right-info">
        <h1>QCU SSC <br>Voting Form</h1>
        <div class="voter-info enlarge">
            <h2>Voter Information</h2><br>
            <form>
                <label for="student_id">Student ID</label>
                <input type="text" id="student_id" value="<?= htmlspecialchars($voter_info['student_id']); ?>" readonly><br>

                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" value="<?= htmlspecialchars($voter_info['full_name']); ?>" readonly><br>
            </form>
        </div>
    </div>
</div>

<!-- The Thanks Modal -->
<div id="thanksModal" class="form-modal">
    <div class="form-modal-content">
        <img src="Pics/ELECT-Logo.png" alt="ELECT LOGO" style="width: 150px; height: auto;">
        <h2 style="color: #004085; font-size: 50px;">Thank you for voting, <?= htmlspecialchars($voter_info['full_name']); ?>!</h2>
        <br>
        <p style="text-align: center; line-height: 40px;">
            Your personal information is confidential, and
            by submitting your votes,
            <br>you agree to the collection and processing of your data
            <br>for the purpose of this election.
        </p>
        <br>
        <br>
        <button class="ok-btn" id="okButton">OK</button>

    </div>
</div>
<!-- Summary Modal -->
<div id="summaryModal" class="form-modal">
    <div class="form-modal-content">
        <br>
        <br>
        <h2 style="color: #004085;">SUMMARY OF YOUR VOTES</h2>
        <div class="sum">
            <table id="voteSummary"></table>
            <div style="display: flex; gap: 10px;">
            </div>
        </div>
        <br>
        <p>Would you like to proceed with submitting the form?</p>

        <div class="bottom">
            <button id="cancelVote" class="btn-cancel" style="position:absolute; right:15px; bottom:-15px">CANCEL</button>
            <button id="confirmVote" class="btn-save" style="position:absolute; left:15px; bottom:-15px">SUBMIT</button>
        </div>
    </div>
</div>

<script>
    // Summary Modal Logic
    var summaryModal = document.getElementById("summaryModal");
    var voteSummaryTable = document.getElementById("voteSummary");

    const votingForm = document.getElementById("votingForm");
    const btn = document.querySelector(".btn-submitVote");
    btn.addEventListener('click', function(e) {
        e.preventDefault();

        const formData = new FormData(votingForm);
        voteSummaryTable.innerHTML = "";

        // required
        let allSelected = true;
        document.querySelectorAll("fieldset").forEach((fieldset) => {
            const positionName = fieldset.querySelector("legend").textContent;
            const selectedOption = fieldset.querySelector("input[type='radio']:checked");

            if (selectedOption) {
                const candidateLabel = fieldset.querySelector(
                    `label[for="${selectedOption.id}"] span:first-child`
                ).textContent;
                const partyList = fieldset.querySelector(
                    `label[for="${selectedOption.id}"] span:last-child`
                ).textContent;

                const row = voteSummaryTable.insertRow();
                const positionCell = row.insertCell();
                const nameCell = row.insertCell();
                const partyCell = row.insertCell();

                positionCell.textContent = positionName;
                nameCell.textContent = candidateLabel;
                partyCell.textContent = partyList;
            } else {
                allSelected = false;
                const listItem = document.createElement("li");
                listItem.textContent = `${positionName}: No candidate selected`;
                listItem.style.color = "red";
                voteSummaryTable.appendChild(listItem);
            }
        });

        if (!allSelected) {
            alert("Please select a candidate for all positions before submitting.");
            return false;
        }

        // Show summary modal
        summaryModal.style.display = "block";
        setTimeout(function() {
            summaryModal.style.transform = "translateY(0)";
        }, 10);
    });

    // Cancel Vote
    document.getElementById("cancelVote").onclick = function() {
        summaryModal.style.transform = "translateY(100%)";
        setTimeout(function() {
            summaryModal.style.display = "none";
        }, 500);
    };

    // Confirm Vote
    document.getElementById("confirmVote").onclick = function() {
        summaryModal.style.transform = "translateY(100%)";
        setTimeout(function() {
            summaryModal.style.display = "none";
            thanksModal.style.display = "block";
            setTimeout(function() {
                thanksModal.style.transform = "translateY(0)";
            }, 10);
        }, 1000);
    };


    // Thanks Modal
    var thanksModal = document.getElementById("thanksModal");
    var okButton = document.getElementById("okButton");
    okButton.onclick = function() {
        thanksModal.style.transform = "translateY(100%)";
        setTimeout(function() {
            thanksModal.style.display = "none";
            document.getElementById('votingForm').submit();
        }, 1000);
    }

    window.onclick = function(event) {
        if (event.target !== thanksModal && !thanksModal.contains(event.target)) {}
    }


    const backButton = document.getElementById("backButton");
    backButton.addEventListener("click", function() {
        $('.p2').fadeOut(700, function() {
            $('.p1').fadeIn(700);
        });
    });
</script>

<?php
if (isset($_POST['vote'])) {
    $vote_data = $_POST['vote'];
    $student_id = $_SESSION['student_id'];


    $checkVote = $conn->prepare("SELECT * FROM votes WHERE student_id = ?");
    $checkVote->bind_param("s", $student_id);
    $checkVote->execute();
    $result = $checkVote->get_result();

    if ($result->num_rows > 0) {
        echo "You have already voted!";
    } else {
        foreach ($vote_data as $position => $candidate_id) {
            // Insert vote for each candidate
            $stmt = $conn->prepare("INSERT INTO votes (student_id, candidate_id, vote_timestamp) VALUES (?, ?, NOW())");
            $stmt->bind_param("si", $student_id, $candidate_id);

            if (!$stmt->execute()) {
                echo "Error: " . $stmt->error;
            }
        }
        $stmt->close();
    }
}

?>