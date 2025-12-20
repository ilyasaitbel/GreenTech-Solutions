<?php
require 'config/database.php';
session_start();

$conn = db_connect();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (strlen($username) < 3) {
        $errors[] = "Nom d'utilisateur invalide.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Mot de passe invalide.";
    }

    if (empty($errors)) {
        $sql = "SELECT id, password_hash FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password_hash'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username;
                $_SESSION['login_time'] = date("H:i:s");

                header("Location: dashboard.php");
                exit;
            } else {
                $errors[] = "Mot de passe incorrect.";
            }
        } else {
            $errors[] = "Utilisateur introuvable.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.page-center {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>

</head>

<body class="bg-light">

<div class="container page-center">
    
    <div class="col-md-5">
    
        <h2 class="text-center mb-4 text-primary">Se connecter</h2>

        <?php foreach ($errors as $e): ?>
            <div class="alert alert-danger"><?= $e ?></div>
        <?php endforeach; ?>

        <form method="POST" class="p-4 shadow-lg rounded bg-white">

            <label class="form-label">Nom d'utilisateur</label>
            <input type="text" name="username" class="form-control mb-3"
                   placeholder="Ex: user123" required>

            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control mb-4"
                   placeholder="******" required>

            <button class="btn btn-primary w-100">Se connecter</button>

            <p class="mt-3 text-center">
                Pas de compte ?
                <a href="register.php">S'inscrire</a>
            </p>

        </form>
    </div>

</div>

</body>
</html>

