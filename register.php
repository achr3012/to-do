<?php

session_start();

if (isset($_SESSION['user'])) {
  header("Location: /");
  exit;
}

if (!empty($_SESSION['err'])) {
  $err = $_SESSION['err'];
  $_SESSION['err'] = '';
}

include 'includes/header.php';
?>

<div class="container login">
  <div class="category">
    <h2>Create a new Account</h2>
    <?php if (isset($err)) : ?>
      <div class="err"><?= $err ?></div>
    <?php endif; ?>
    <form action="handel/register.php" method="post">
      <div class="f-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="achr">
      </div>

      <div class="f-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="••••••••">
      </div>

      <div class="f-group">
        <label for="repassword">Repeat password</label>
        <input type="password" name="repassword" id="repassword" placeholder="••••••••">
      </div>
      <button type="submit">Create my Account</button>
    </form>
  </div>
</div>

</body>

</html>