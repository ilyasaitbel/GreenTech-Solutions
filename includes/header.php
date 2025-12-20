<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="public/css/style.css">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<nav class="navbar navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand" href="index.php">🌱 Digital Garden</a>

    <div>
        
      <?php if(isset($_SESSION['user_id'])): ?>
        <a href="dashboard.php" class="btn btn-light btn-sm">Dashboard</a>
        <a href="themes.php" class="btn btn-light btn-sm">Themes</a>
        <a href="notes.php" class="btn btn-light btn-sm">Notes</a>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
      <?php else: ?>
        <a href="login.php" class="btn btn-light btn-sm">Login</a>
        <a href="register.php" class="btn btn-outline-light btn-sm">Register</a>
      <?php endif;?>
    </div>
  </div>
</nav>

<div class="container mt-4">

