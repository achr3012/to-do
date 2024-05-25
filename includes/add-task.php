<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $descr = filter_var(trim($_POST['descr']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (strlen($descr) > 3) {
    $stmt = $conn->prepare("INSERT INTO `tasks` (`description`) VALUES (:descr)");
    $stmt->bindParam(':descr', $descr);
    if (!$stmt->execute()) {
      $err = "Something went wrong";
    }
  }
}
?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="add-task">
  <div class="container mx-auto p-4 flex gap-3 justify-center flex-col sm:flex-row">
    <input type="text" name="descr" placeholder="Description" class="w-full sm:w-96	p-2 border-2 border-gray-500 outline-none focus:border-gray-900" />
    <button type="submit" class="bg-gray-600 text-white font-bold py-2 px-4 transition ease-in-out hover:bg-gray-900">Add Task</button>
  </div>
  <?php if (isset($err)) : ?>
    <div class="text-red-800"><?= $error ?></div>
  <?php endif; ?>
</form>