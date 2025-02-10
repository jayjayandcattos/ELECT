<!-- The Thanks Modal -->
<div id="thanksModal" class="thanks">
    <div class="thanks-content">
        <img src="Pics/ELECT-Logo.png" alt="ELECT LOGO" style="width: 150px; height: auto;">
        <h2>Thank you for voting, <?= htmlspecialchars($voter_info['full_name']); ?>!</h2>
        <br>
        <p style="text-align: center; font-size: 15px;">
            Your personal information is confidential, and
            by submitting your votes, you agree to the
            collection and processing of your data
            for the purpose of this election.
        </p>
        <br>
        <br>
        <button class="ok-btn">OK</button>

    </div>