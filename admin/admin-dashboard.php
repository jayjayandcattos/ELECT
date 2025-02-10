<?php
session_start();

if (!isset($_SESSION['student_id']) || $_SESSION['role_id'] !== 0) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ELECT</title>
  <link rel="icon" type="image/png" href="../Pics/ELECT-icon.png">
  <link rel="stylesheet" href="../css/HeaderAdmin.css">
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600&display=swap">
</head>

<body>

  <?php include '../backend/HeaderAdmin.php'; ?>

  <div class="content">
    <h1>Welcome, Admin <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>

    <div class="admin-container">
      <?php include 'admin.php'; ?>
    </div>
  </div>


</body>

</body>

</html>