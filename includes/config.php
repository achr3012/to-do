<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=to-do", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


function getHeader()
{
  global $pageTitle;
  if (true) : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?= $pageTitle ?></title>
      <link href="includes/tw.css" rel="stylesheet">
    </head>

    <body>
      <header class="h-56	flex flex-col justify-center text-center">
        <h1 class="text-5xl"><a href="/">To Do List</a></h1>
        <ul class="flex items-center justify-center gap-3 mt-4">
          <li><a href="/create-account.php" class="hover:underline">Create an Account</a></li>
          <li><a href="/login.php" class="hover:underline">Login</a></li>
          <!-- <li><a href="/categories.php">Categories</a></li>
      <li><a href="/logout.php">Logout</a></li> -->
        </ul>
      </header>

  <?php endif;
}
