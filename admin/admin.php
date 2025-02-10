<head>
  <title>ELECT</title>
  <link rel="icon" type="image/png" href="../Pics/ELECT-icon.png">
  <link rel="stylesheet" href="../css/HeaderAdmin.css">
  <link rel="stylesheet" href="../css/admin.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap">
</head>

<div class="dashboard-section">
<div class="sidebar">
  <div class="logo">
    <img src="../pics/ELECT-white.png" alt="Logo">
  </div>
  <a href="#dashboard" onclick="location.reload()">DASHBOARD</a>
  <a href="#party-lists" onclick="loadContent('party-lists')">PARTYLISTS MANAGEMENT</a> 
  <a href="#manage-users" onclick="loadContent('manage-users')">USER MANAGEMENT</a> 
  <a href="#candidates-management" onclick="loadContent('candidates-management')">CANDIDATES MANAGEMENT</a>
  <a href="#view-results" onclick="loadContent('view-results')">VIEW RESULTS</a>
  <a href="#archives" onclick="loadContent('archives')">ARCHIVES</a> 
</div>


  <div id="main-content" class="main-content">
    <?php include '../backend/dashboardcontent.php'; ?>
  </div>

  <script>
    let currentSection = 'dashboard';

    function loadContent(section) {
      console.log('Loading section:', section);
      const mainContent = document.getElementById('main-content');
      const links = document.querySelectorAll('.dashboard-section .sidebar a');

      if (section === currentSection) return;
      currentSection = section;

      links.forEach(link => {
        link.classList.remove('active');
      });

      const activeLink = document.querySelector(`.dashboard-section .sidebar a[href="#${section}"]`);
      if (activeLink) {
        activeLink.classList.add('active');
      }

      let url;
      switch (section) {
        case 'dashboard':
          url = '../backend/dashboardcontent.php';
          break;
        case 'party-lists':
          url = '../backend/party_lists_management.php';
          break;
        case 'manage-users':
          url = '../backend/user_management.php';
          break;
        case 'candidates-management':
          url = '../backend/candidates_management.php';
          break;
        case 'view-results':
          url = '../backend/a-vote_monitoring.php';
          break;
        case 'archives': 
          url = '../backend/archives.php'; //hi
          break;
        default:
          mainContent.innerHTML = `<p>Select a valid option from the sidebar.</p>`;
          console.error('Invalid section:', section);
          return;
      }

      fetch(url)
        .then(response => {
          if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
          }
          return response.text();
        })
        .then(data => {
          mainContent.innerHTML = data;
        })
        .catch(error => {
          console.error('Error loading content:', error);
          mainContent.innerHTML = `<p>Error loading content. Please try again later.</p>`;
        });
    }
  </script>
</div>
