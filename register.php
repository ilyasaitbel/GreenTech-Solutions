<?php
require 'config/database.php';
session_start();

$conn = db_connect();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];
    $date = date("Y-m-d");

    if (strlen($username) < 3)
        $errors[] = "Username doit contenir au moins 3 caractères.";

    if (strlen($password) < 6)
        $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";

    if ($password !== $confirm)
        $errors[] = "Les mots de passe ne correspondent pas.";

    if (empty($errors)) {

        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $check = $stmt->get_result();

        if ($check->num_rows > 0) {
            $errors[] = "Ce nom d'utilisateur existe déjà.";
        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, password_hash, date_created)
                    VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $hash, $date);

            if ($stmt->execute()) {
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
                exit;
            } else {
                $errors[] = "Erreur lors de l'inscription.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.page-center{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}
</style>

</head>

<body class="bg-light">

<div class="container page-center">

<div class="col-md-5">

<h2 class="text-center mb-4 text-success">Créer un compte 🌱</h2>

<?php foreach($errors as $e): ?>
    <div class="alert alert-danger"><?= $e ?></div>
<?php endforeach; ?>

<form method="POST" class="p-4 shadow-lg rounded bg-white">

    <label class="form-label">Nom d'utilisateur</label>
    <input type="text" name="username" class="form-control mb-1"
           placeholder="Ex: user123" required>
    <span id="err_username" class="text-danger mb-3 d-block"></span>

    <label class="form-label">Mot de passe</label>
    <input type="password" name="password" class="form-control mb-1"
           placeholder="******" required>
    <span id="err_password" class="text-danger mb-3 d-block"></span>

    <label class="form-label">Confirmer mot de passe</label>
    <input type="password" name="confirm_password" class="form-control mb-1"
           placeholder="******" required>
    <span id="err_confirm" class="text-danger mb-3 d-block"></span>

    <button class="btn btn-success w-100">S'inscrire</button>

    <p class="mt-3 text-center">
        Déjà un compte ?
        <a href="login.php">Se connecter</a>
    </p>

</form>

</div>
</div>

<script src="script.js" defer></script>

</body>
</html>
