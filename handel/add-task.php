<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  die("Access denied");
}

$username = filter_var(trim($_POST['username']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$category = intval(filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$description = filter_var(trim($_POST['description']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (empty($username) || empty($category) || empty($description)) {
  header("Location: /");
  exit;
}

try {
  include '../includes/db.php';


  $stmt = $conn->prepare("INSERT INTO `tasks` (`username`, `description`, `category`) VALUES (:u, :d, :c)");
  $stmt->bindParam(":u", $username);
  $stmt->bindParam(":d", $description);
  $stmt->bindParam(":c", $category);

  $stmt->execute();
  header("Location: /");
} catch (PDOException $e) {
  echo $e->getMessage();
}
