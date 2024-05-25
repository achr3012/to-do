<?php

require_once "includes/config.php";
$pageTitle = "To Do App";

if (!isset($_SESSION['user'])) {
  getHeader();
  echo "</body></html>";
  exit();
}

getHeader();

include 'includes/add-task.php';
include 'includes/tasks.php';
?>

</body>

</html>