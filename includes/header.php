<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To Do List</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <a href="https://github.com/achr3012" target="_blank" id="achref">#AcHReF</a>
  <h1><a href="/">To Do List</a></h1>
  <nav>
    <div class="container">
      <ul>
        <?php if (!isset($_SESSION['user'])) : ?>
          <li><a href="register.php" class="special">Create a new Account</a></li>
          <li><a href="login.php">Login</a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['user'])) : ?>
          <li><a href="categories.php" class="special">Categories</a></li>
          <li><a href="logout.php">LogOut</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>