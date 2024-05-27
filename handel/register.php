<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  die("Access denied");
}

session_start();

$user = filter_var(trim($_POST['username']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pass = filter_var(trim($_POST['password']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$repa = filter_var(trim($_POST['repassword']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$hapa = password_hash($pass, PASSWORD_DEFAULT);


if (strlen($user) < 4 || strlen($pass) < 4 || strlen($repa) < 4) {

  $_SESSION['err'] = 'Please fill all the fields!';
  header("Location: /register.php");
  exit;
}

if ($pass !== $repa && $err == 0) {
  $_SESSION['err'] = 'Please Check Your password repeat!';
  header("Location: /register.php");
  exit;
}

require '../includes/db.php';

$stmt = $conn->prepare("SELECT * FROM users WHERE username = :user");
$stmt->bindParam(':user', $user);
$stmt->execute();
$exists = $stmt->fetchAll(PDO::FETCH_OBJ);
if ($exists && $err == 0) {
  $_SESSION['err'] = 'This username already exists!';
  header("Location: /register.php");
  exit;
}


$stmt = $conn->prepare("INSERT INTO users (username, `password`) VALUES (:user, :pass)");
$stmt->bindParam(":user", $user);
$stmt->bindParam(":pass", $hapa);
if ($stmt->execute()) {
  $_SESSION['user'] = $user;
  header("Location: /");
  exit;
}
