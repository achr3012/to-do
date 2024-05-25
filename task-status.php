<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  die('Access Denied');
}

require_once "includes/config.php";

$id = intval($_GET['id']);
$status = intval($_POST['status']);

$status = $status > 0 ? 0 : 1;

$stmt = $conn->prepare("UPDATE `tasks` SET `status` = '$status' WHERE `tasks`.`id` = $id");

if ($stmt->execute()) {
  header("Location: index.php?updated=$id");
}
