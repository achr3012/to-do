<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  die("Access denied");
}

$id = filter_var(trim($_POST['id']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$status = filter_var(trim($_POST['status']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

try {
  include '../includes/db.php';

  $stmt = $conn->prepare("UPDATE `tasks` SET `status` = :s WHERE `id` = :id");

  $status = $status > 0 ? 0 : 1;

  $stmt->bindParam(":s", $status);
  $stmt->bindParam(":id", $id);

  $stmt->execute();
  header("Location: /");
} catch (PDOException $e) {
  echo $e->getMessage();
}
