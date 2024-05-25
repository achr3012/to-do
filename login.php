<?php

require_once 'includes/config.php';

if (isset($_SESSION['user'])) {
  header("Location: index.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $user = filter_var(trim($_POST['username']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $pass = filter_var(trim($_POST['password']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $err = 0;
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = :user");
  $stmt->bindParam(':user', $user);
  $stmt->execute();
  $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (!$user || !password_verify($pass, $user[0]['password'])) {
    $err++;
    echo "<script>alert('Wrong username or password!')</script>";
  }

  if ($err == 0) {
    $_SESSION['user'] = $user[0]['username'];
    header("Location: /");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | To Do App</title>
  <link href="includes/tw.css" rel="stylesheet">
</head>

<body>
  <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-5xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
        To Do App
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Log in to your account
          </h1>
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="space-y-4 md:space-y-6">
            <div>
              <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Username</label>
              <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name">
            </div>
            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
              <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login</button>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
              Dont have an account? <a href="login.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Register</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>

</html>