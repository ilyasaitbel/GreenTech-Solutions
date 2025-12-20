<?php require 'includes/auth.php'; ?>
<?php require 'includes/header.php'; ?>

<h2>Bienvenue <?= htmlspecialchars($_SESSION['username']) ?> 🌿</h2>

<a class="btn btn-success" href="themes.php">Themes</a>
<a class="btn btn-primary" href="notes.php">Notes</a>

<?php require 'includes/footer.php'; ?>
