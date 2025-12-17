<?php
require 'config/database.php';
session_start();
// echo $_SERVER['REQUEST_METHOD'];
// SERVER Superglobal variable
// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
$conn = db_connect();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_SERVER);
    // print_r($_SERVER['REQUEST_METHOD']);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $date = date("Y-m-d");

    if (strlen($username) < 3) {
        $errors[] = "Username 3 caractere or more.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password 6 caractere or more.";
    }
    if ($confirmpassword != $password)
    {
        $errors[] = "password is not correct";
    }

    if (empty($errors)) {

        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $chek = $stmt->fetch();
        // var_dump($chek);
        if($chek == NULL){
        //   var_dump($chek);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password_hash, date_created)
                VALUES (?, ?, ?)";
        // $conn->query($sql);
        // SQL Injection
        $stmt = $conn->prepare($sql);
        // prepared statement
        $stmt->bind_param("sss", $username, $hash, $date);
        if ($stmt->execute()) {
            // $_SESSION['user_id'] = $stmt->insert_id;
            // $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        }
       }else {
        $errors[] = "user deja kayn";
       }
        
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="confirmpassword" placeholder="Confirm Password">
    <button type="submit">Register</button>

    <?php
    foreach ($errors as $e) {
        echo "<p>$e</p>";
    }
    ?>
</form>
