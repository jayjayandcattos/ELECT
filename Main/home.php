<?php
session_start();

include 'db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$login_success = false;
$already_voted = false;
$wrong_password = false;
$invalid_credentials = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['student_id']) && isset($_POST['password'])) {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];
    $check_vote_stmt = $conn->prepare("SELECT id FROM votes WHERE student_id = ?");
    $check_vote_stmt->bind_param("s", $student_id);
    $check_vote_stmt->execute();
    $check_vote_stmt->store_result();
    if ($check_vote_stmt->num_rows > 0) {
      $already_voted = true;
    } else {
      $stmt = $conn->prepare("SELECT student_id, password, role_id, first_name, surname FROM users WHERE student_id = ?");
      $stmt->bind_param("s", $student_id);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_student_id, $db_password, $db_role_id, $first_name, $surname);
        $stmt->fetch();
        if (password_verify($password, $db_password)) {
          $_SESSION['student_id'] = $db_student_id;
          $_SESSION['role_id'] = $db_role_id;
          $_SESSION['name'] = $first_name . ' ' . $surname;
          $login_success = true;
          $role_id = $db_role_id;
          if ($db_role_id == 0) {
            header("Location: admin/admin-dashboard.php");
            exit();
          }
          if (!isset($_SESSION['seen_animation'])) {
            $_SESSION['seen_animation'] = false;
          }
        } else {
          $wrong_password = true;
        }
      } else {
        $invalid_credentials = true;
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>ELECT</title>
  <link rel="icon" type="image/png" href="Pics/ELECT-icon.png">
  <link rel="stylesheet" href="./css/ELECT-Styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Saira:wght@600&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <?php include 'Header.php'; ?>

  <div class="content">
    <!-- p1 container -->
    <div class="p1">
      <br><br>
      <h1 class="target-vote" id="change">QCU SUPREME STUDENT COUNCIL</h1>
      <br>
      <div id="slider">
        <div id="left-section" class="section">
          <div class="left-section-visible">
            <?php include 'SSC.php'; ?>
            <form action="javascript:void(0);" id="vote-now-form">
              <button class="btn-ViewVotingForm" type="submit">VOTE NOW</button>
            </form>
            <div class="arrow" onclick="scrollToDiv()">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
        </div>
        <div id="right-section" class="section">
          <?php include 'about.php'; ?>
        </div>

        <div id="box"></div>
        <div id="float">
          <!-- Error Box -->
          <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && ($already_voted || $wrong_password || $invalid_credentials)): ?>
            <div id="error-box" class="error-box fade-in-out">
              <?php if ($already_voted): ?>
                <p>You have already voted!</p>
              <?php elseif ($invalid_credentials): ?>
                <p>Invalid ID number or password. Please try again.</p>
              <?php elseif ($wrong_password): ?>
                <p>The password you entered is incorrect.</p>
              <?php endif; ?>

            </div>
          <?php endif; ?>
          <!-- error -->

          <div class="card">
            <h2>ENTER LOGIN INFO</h2>
            <br>
            <!-- Login Form -->
            <form action="" method="POST">
              <label for="student_id">Enter ID Number</label>
              <input type="text" id="student_id" name="student_id" autocomplete="off" required onpaste="return false;" oncopy="return false;">
              <br>
              <label for="password">Password</label>
              <input type="password" id="password" class="inputPW" name="password" autocomplete="off" required onpaste="return false;" oncopy="return false;">
              <br>
              <div id="showPassword" onclick="showPW()">
                <img src="Pics/show-icon.png" alt="show">
              </div>
              <button id="btn-login" type="submit">
                <p>LOGIN</p>
              </button>
              <br>
            </form>
            <script>
 const card = document.querySelector('.card'); 
   card.addEventListener('click', () => {
     card.classList.add('active');
   });

   document.addEventListener('click', (event) => {
     if (!card.contains(event.target)) { 
       card.classList.remove('active'); 
     }
   });
              
              document.getElementById('showPassword').addEventListener('click', function() {
                const passwordField = document.querySelector('.inputPW');
                passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
              });

              document.addEventListener("DOMContentLoaded", function() {
                const errorBox = document.getElementById("error-box");
                if (errorBox) {
                  setTimeout(() => {
                    errorBox.classList.add("show");
                  }, 10);

                  setTimeout(() => {
                    errorBox.classList.remove("show");
                  }, 3000);
                }
              });
            </script>
          </div>
        </div>
      </div>
      <div>
        <?php include 'footerindex.php'; ?>
      </div>

      <div id="container-partylist" class="target-div">
        <br>
        <?php include 'Voter_db/partylists.php'; ?>
        <br>
        <div class="arrow-up" onclick="scrollToVote()">
          <span></span>
          <span></span>
        </div>
        <br><br>
        <footer>
          <?php include 'footer.php'; ?>
        </footer>
      </div>
    </div>

    <!-- p2 container -->
    <div class="p2" style="display:none;">
      <br><br>
      <?php include 'Voter_db/voter-form.php'; ?>
    </div>

    <script>
      function scrollToDiv() {
        document.querySelector('.target-div').scrollIntoView({
          behavior: 'smooth'
        });
      }

      function scrollToVote() {
        document.querySelector('.target-vote').scrollIntoView({
          behavior: 'smooth'
        });
      }

      $('body').bind('copy paste', function(e) {
        e.preventDefault();
        return false;
      });


      document.addEventListener("DOMContentLoaded", function() {
        const errorBox = document.getElementById("error-box");
        if (errorBox) {
          setTimeout(function() {
            errorBox.classList.add("hidden");
          }, 3000);
        }
      });

      $(document).ready(function() {
        var loginSuccess = <?php echo $login_success ? 'true' : 'false'; ?>;
        var roleId = <?php echo isset($role_id) ? $role_id : 'null'; ?>;
        var seenAnimation = <?php echo isset($_SESSION['seen_animation']) && $_SESSION['seen_animation'] ? 'true' : 'false'; ?>;

        if (loginSuccess && roleId === 1 && !seenAnimation) {
          // Play animations
          $('#float').animate({
            left: '111%'
          }, 1000);
          $('#box').animate({
            right: '30%'
          }, 2000);
          $('#right-section').fadeOut(1000, function() {
            $('#left-section').fadeIn(1000);
          });
          $('#container-partylist').css('display', 'block').hide().fadeIn(1000);
          $('#change').fadeOut(500, function() {
            $(this).text('WELCOME, <?php echo $_SESSION['name']; ?>').fadeIn(500);
          });

          $.post("set_seen_animation.php");
        } else if (seenAnimation) {
          $('#float').css('left', '111%');
          $('#box').css('right', '30%');
          $('#right-section').hide();
          $('#left-section').show();
          $('#container-partylist').show();
          $('#change').text('WELCOME <?php echo $_SESSION['name']; ?>');
        }

        //GALIT SA AUTO LOGOUT

        document.addEventListener('keydown', function(event) {
          if (event.altKey && event.keyCode === 37) {
            event.preventDefault();
          }
        });

        history.pushState(null, null, location.href);


        window.addEventListener('popstate', function(event) {
          history.pushState(null, null, location.href);
        });

        //GALIT SA AUTO LOGOUT


        $('#vote-now-form').submit(function() {
          $('.p1').fadeOut(1000, function() {
            $('.p2').fadeIn(1000);
          });
        });
      });
    </script>
  </div>
</body>

</html>