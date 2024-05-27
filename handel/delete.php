<?php

if (
  (!isset($_GET['t']) || !isset($_GET['id']) || !isset($_SERVER['HTTP_REFERER']))
  || ($_GET['t'] !== '1' && $_GET['t'] !== '2')
) {
  die("Access denied");
}


$t = filter_var(intval($_GET['t']), FILTER_SANITIZE_NUMBER_INT);
$id = filter_var(intval($_GET['id']), FILTER_SANITIZE_NUMBER_INT);

$t = $_GET['t'] == '1' ? 'categories' : 'tasks';
include '../includes/db.php';

try {
  $stmt = $conn->prepare("DELETE from $t WHERE id = :id");
  $stmt->bindParam(':id', $id);

  $stmt->execute();
  header("Location: " . $_SERVER['HTTP_REFERER']);
} catch (PDOException $e) {
  echo $e->getMessage();
}
