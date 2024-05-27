<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  die("Access denied");
}

session_start();

$user = filter_var(trim($_POST['username']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pass = filter_var(trim($_POST['password']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);


if (strlen($user) < 4 || strlen($pass) < 4) {

  $_SESSION['err'] = 'Please fill all the fields!';
  header("Location: /login.php");
  exit;
}

require '../includes/db.php';

$stmt = $conn->prepare("SELECT * FROM users WHERE username = :user");
$stmt->bindParam(':user', $user);
$stmt->execute();

$dbUser = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$dbUser || !password_verify($pass, $dbUser[0]['password'])) {
  $_SESSION['err'] = 'Wrong username or password!';
  header("Location: /login.php");
  exit;
}

$_SESSION['user'] = $user;
header("Location: /");
