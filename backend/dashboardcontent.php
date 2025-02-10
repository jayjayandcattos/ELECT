<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Saira:wght@600&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap">
  <link rel="stylesheet" href="../css/admin.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  <?php
  include '../db_connection.php';

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $voterCountQuery = "SELECT COUNT(*) as total_voters FROM users WHERE role_id = 1";
  $voterCountResult = $conn->query($voterCountQuery);
  $voterCount = $voterCountResult->fetch_assoc()['total_voters'];

  $candidateCountQuery = "SELECT COUNT(*) as total_candidates FROM candidates";
  $candidateCountResult = $conn->query($candidateCountQuery);
  $candidateCount = $candidateCountResult->fetch_assoc()['total_candidates'];

  $voteDataQuery = "
    SELECT c.first_name, c.surname, c.position, COUNT(v.candidate_id) as vote_count 
    FROM votes v 
    INNER JOIN candidates c ON v.candidate_id = c.candidate_id 
    GROUP BY c.candidate_id, c.first_name, c.surname, c.position
  ";
  $voteDataResult = $conn->query($voteDataQuery);

  $chartData = [];
  while ($row = $voteDataResult->fetch_assoc()) {
    $chartData[] = $row;
  }
  ?>
  <div class="column-container">
    <div class="count-box">
      <div class="count-box-inner">
        <div class="count-box-space">
          <img src="../Pics/peopledashboard.png" alt="Voters">
        </div>
        <div class="count-box-content">
        <br>
          <h2>TOTAL VOTERS</h2>
          <p class="count-number"><?php echo $voterCount; ?></p>
        </div>
      </div>
    </div>

    <div class="count-box">
      <div class="count-box-inner">
        <div class="count-box-space">
          <img src="../Pics/checkdashboard.png" alt="Candidates">
        </div>
        <div class="count-box-content">
          <br>
          <h2>TOTAL CANDIDATES</h2>
          <p class="count-number"><?php echo $candidateCount; ?></p>
        </div>
      </div>
    </div>
  </div>

  <div class="large-box">
  <canvas id="voteBarChart" style="width: 9999999; height: 100%;"></canvas> 
  <!-- max width/anchored na di mastretch -->
  </div>
  </div>

  <script>
    function renderChart() {
      const chartData = <?php echo json_encode($chartData); ?>;
      const labels = chartData.map(item => `${item.first_name} ${item.surname} (${item.position})`);
      const votes = chartData.map(item => item.vote_count);

      const getRandomColor = () => {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
          color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
      };

      const colors = chartData.map(() => getRandomColor());

      const ctx = document.getElementById('voteBarChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            display: false,
            label: 'VOTES',
            data: votes,
            backgroundColor: colors,
            borderColor: colors.map(color => color.replace("0.7", "1")),
            borderWidth: 1
          }]
        },
        options: {
          indexAxis: 'y',
          responsive: true,
          scales: {
            x: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'NUMBER OF VOTES',
                font: {
                  family: "'Unbounded', sans-serif",
                  size: 16
                }
              }
            },
            y: {
              title: {
                display: false,
                text: 'CANDIDATES',
                font: {
                  family: "'Unbounded', sans-serif",
                  size: 16
                }
              }
            }
          },
          plugins: {
            legend: {
              labels: {
                font: {
                  family: "'Unbounded', sans-serif",
                  size: 14
                }
              }
            }
          }
        }
      });
    }

    document.addEventListener('DOMContentLoaded', renderChart);
  </script>

</body>

</html>