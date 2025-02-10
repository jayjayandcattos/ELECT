<?php
include 'db_connection.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT name, platform, picture FROM party_lists";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $partyLists = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<style>
  .modal-container {
    perspective: 800px;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    visibility: hidden;
    opacity: 0;
    transition: visibility 0.5s ease, opacity 0.5s ease;
  }

  .modal-container.show {
    visibility: visible;
    opacity: 1;
  }

  .modal-container .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    backdrop-filter: blur(3px);
    transition: backdrop-filter 0.2s ease 0.2s;
    opacity: 0;
  }

  .modal-container.show .overlay {
    opacity: 1;
    backdrop-filter: blur(3px);
  }

  .modal-container:not(.show) .overlay {
    backdrop-filter: blur(0px);
  }

  .modal {
    width: 80%;
    height: 60%;
    position: relative;
    transform-style: preserve-3d;
    transform: rotateX(-60deg);
    transition: transform 1.5s ease, opacity 0.8s ease 0.2s;
    opacity: 0;
    top: 50px;
    backdrop-filter: blur(20px);
    z-index: 2;
  }

  .modal.is-flipped {
    transform: rotateX(0);
    opacity: 1;
  }

  .modal.is-closing {
    transform: rotateX(45deg);
    transition: transform 1s ease, opacity 0.8s ease 0.2s;
    opacity: 0;
  }

  .modal-face {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
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

  .modal-face.back {
    transform: rotateX(180deg);
    background: #e3e3e3;
  }

  .close-button {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: #f44336;
    color: white;
    border: none;
    border-radius: 100%;
    width: 40px;
    height: 40px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .close-button::before {
    display: none;
  }

  .close-button:hover {
    transform: none;
    box-shadow: inset 10px 10px 10px rgba(0, 0, 0, 0.5);
    border: none;
    color: white;
    transition: all 0.3s ease;
  }

  .modal-header {
    font-size: 20px;
  }

  .modal-body {
    display: flex;
    flex-direction: row;
    height: 80%;
    width: 100%;
  }
</style>

<h1>PARTICIPATING PARTYLISTS</h1>

<div class="dashboard">
  <div class="carousel">
    <div class="group">
      <?php foreach ($partyLists as $party): ?>
        <div class="banner-slide">
          <img class="enlarge" src="uploads/<?php echo htmlspecialchars($party['picture']); ?>" alt="<?php echo htmlspecialchars($party['name']); ?>">
        </div>
      <?php endforeach; ?>
    </div>

    <div aria-hidden class="group">
      <?php foreach ($partyLists as $party): ?>
        <div class="banner-slide">
          <img class="enlarge" src="uploads/<?php echo htmlspecialchars($party['picture']); ?>" alt="<?php echo htmlspecialchars($party['name']); ?>">
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="party-container">
    <?php foreach ($partyLists as $party): ?>
      <div class="party">
        <div class='party-banner' style='background-image: url("Pics/<?php echo htmlspecialchars($party['picture']); ?>");'></div>
        <div class='party-content'>
          <h2><?php echo htmlspecialchars($party['name']); ?></h2>
          <p><?php echo htmlspecialchars($party['platform']); ?></p>
          <button class='btn-viewPartylist' onclick='openModal("<?php echo htmlspecialchars($party['name']); ?>")'>View Candidates</button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Modal -->
<div class="modal-container">
  <div class="overlay"></div>
  <div id="partyModal" class="modal">
    <div class="modal-face front">
      <div class="modal-header">
        <h1 id="partyName"></h1>
        <button class="close-button">✖</button>
      </div>
      <div class="modal-body" id="candidateList">
        <p> Loading Information... </p>
      </div>
    </div>
  </div>
</div>

<script>
  const modalContainer = document.querySelector('.modal-container');
  const modal = document.querySelector('.modal');
  const closeButtons = document.querySelectorAll('.close-button');
  const body = document.body;
  const overlay = document.querySelector('.overlay');

  function openModal(partyName) {
    modalContainer.classList.add('show');
    modal.classList.add('is-flipped');
    document.getElementById('partyName').innerText = partyName;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "Voter_db/partylists-info.php?party_lists=" + encodeURIComponent(partyName), true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById('candidateList').innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  }

  closeButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      modal.classList.add('is-closing');
      setTimeout(() => {
        modal.classList.remove('is-flipped');
        modalContainer.classList.remove('show');
        modal.classList.remove('is-closing');
      }, 1000);
    });
  });

  overlay.addEventListener('click', (event) => {
    modal.classList.add('is-closing');
    setTimeout(() => {
      modal.classList.remove('is-flipped');
      modal.classList.remove('is-closing');
      modalContainer.classList.remove('show');
    }, 1000);
  });
</script>
