<head>
  <title>ELECT</title>
  <link rel="icon" type="image/png" href="Pics/ELECT-icon.png">
  <link rel="stylesheet" href="./css/ELECT-Styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Saira:wght@600&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="header">
    <div class="navbar">
      <div class="nav-content">
        <div class="nav-left">


          <a href="https://qcu.edu.ph/" target="_blank">
            <img class="logo dark" alt="QCU" src="../Pics/QCU-Logo.png">
          </a>

          <a href="https://www.facebook.com/qcusupremestudentcouncil" target="_blank">
            <img class="logo dark" alt="SSC" src="../Pics/SSC-Logo.jpg">
          </a>

        </div>

        <div class="nav-right">
          <div class="date">
            <div class="date1" id="currentDate">Date</div>
          </div>

          <div class="time">
            <div class="time1" id="currentTime">Time</div>
          </div>

          <a href="../Main/logout.php" class="logout-btn" title="Logout">
            <img src="../Pics/Logout.png" alt="Logout">
          </a>
        </div>


        <script>
          function updateDateTime() {
            const now = new Date();

            const options = {
              year: 'numeric',
              month: 'long',
              day: 'numeric'
            };
            const date = now.toLocaleDateString(undefined, options);

            const time = now.toLocaleTimeString();

            document.getElementById('currentDate').innerText = date;
            document.getElementById('currentTime').innerText = time;
          }

          setInterval(updateDateTime, 1000);

          updateDateTime();
        </script>
      </div>
    </div>
  </div>
</body>