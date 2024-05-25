<?php

require_once "includes/config.php";

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM tasks WHERE `tasks`.`id` = $id");

if ($stmt->execute()) {
  header("Location: index.php?deleted=1");
}
