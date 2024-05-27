<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  die("Access denied");
}

session_start();

$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (strlen($name) < 4) {
  $_SESSION['err'] = 'Please fill the field!';
  header("Location: /categories.php");
  exit;
}

include '../includes/db.php';

$stmt = $conn->prepare("INSERT INTO categories (`name`, username) VALUES (:name, :user)");
$stmt->bindParam(":name", $name);
$stmt->bindParam(":user", $_SESSION['user']);

if ($stmt->execute()) {
  header("Location: /categories.php");
}
