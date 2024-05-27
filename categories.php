<?php
session_start();

include 'includes/header.php';
?>


<?php if (!isset($_SESSION['user'])) : ?>
  <div class="container guest">Please login in order to use the app (:</div>
  </body>

  </html>
<?php
  exit;
endif;

include 'includes/db.php';

$user = $_SESSION['user'];
$stmt = $conn->query("SELECT * FROM categories WHERE username = '$user' ORDER BY id DESC");
$cates = $stmt->fetchAll(PDO::FETCH_OBJ);

if (!empty($_SESSION['err'])) {
  $err = $_SESSION['err'];
  $_SESSION['err'] = '';
}

?>

<div class="container manage">
  <h2>Manage your Categories</h2>
  <div class="flex">
    <section>
      <?php
      if (!$cates) : ?>
        <p>No Categories ):</p>
      <?php
      endif;
      foreach ($cates as $cate) :
        $res = $conn->query("SELECT COUNT(*) FROM tasks WHERE category = '$cate->id'");
        $count = $res->fetchColumn();
        if ($count == '0') {
          $str = "No tasks";
        } else if ($count == '1') {
          $str = "One Task";
        } else {
          $str = $count . ' Tasks';
        }
      ?>
        <div>
          <h3><?= $cate->name ?></h3>
          <span><?= $str ?></span>
          <a href="handel/delete.php?t=1&id=<?= $cate->id ?>">&times;</a>
        </div>
      <?php endforeach; ?>
    </section>

    <div class="category">
      <h2>Add new Category</h2>
      <div class="add">
        <?php if (isset($err)) : ?>
          <div class="err"><?= $err ?></div>
        <?php endif; ?>
        <form action="handel/add-cate.php" method="post">
          <input type="text" name="name" placeholder="Home works">
          <button type="submit">Create Category</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>

</html>