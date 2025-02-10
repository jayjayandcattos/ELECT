<?php
session_start();


include 'db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$login_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $student_id = $_POST['student_id'];
  $password = $_POST['password'];

  
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

    
      if ($db_role_id == 0) {
        
        header("Location: ../admin/admin-dashboard.php");
        exit();
      }
    
    }
  }
}

if (!$login_success) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
</head>
<body>
  <form action="login.php" method="POST">
    <label for="student_id">Enter ID Number</label>
    <input type="text" id="student_id" name="student_id" required>
    <br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
    <br><br>
    <button id="btn-login" type="submit">LOGIN</button>
  </form>
</body>
</html>
<?php
}
?>