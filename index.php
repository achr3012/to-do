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
$stmt = $conn->query("SELECT * FROM categories WHERE username = '$user'");
$cates = $stmt->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container categories">
  <?php
  if (!$cates) : ?>
    <p>Nothing to show ):</p>
  <?php
  endif;
  foreach ($cates as $cate) :
    $stmt = $conn->query("SELECT * FROM tasks WHERE category = '$cate->id'");
    $tasks = $stmt->fetchAll(PDO::FETCH_OBJ);
  ?>
    <div class="category" id="<?= 'cate-' . $cate->id ?>">
      <h2><?= $cate->name ?></h2>
      <div class="tasks">

        <?php
        if (!$tasks) : ?>
          <p>No tasks ):</p>
        <?php
        endif;
        foreach ($tasks as $task) :
          $check = $task->status ? " checked='checked' " : "";

        ?>
          <div class="task">
            <form action="handel/status.php" method="post">
              <label for="<?= 't' . $task->id ?>">
                <input type="hidden" name="id" value="<?= $task->id ?>">
                <input type="hidden" name="status" value="<?= $task->status ?>">
                <input type="checkbox" name="" id="<?= 't' . $task->id ?>" onchange="sendForm(this)" <?= $check ?>>
                <span class="checkmark"></span>
              </label>
            </form>
            <label for="<?= 't' . $task->id ?>" class="desc"><?= $task->description ?></label>
            <a href="handel/delete.php?t=2&id=<?= $task->id ?>">&times</a>
          </div>
        <?php endforeach; ?>

      </div>
      <div class="add">
        <button type="button" onclick="openForm(this)">Add task</button>
        <form action="handel/add-task.php" method="post">
          <input type="hidden" name="username" value="<?= $_SESSION['user'] ?>">
          <input type="hidden" name="category" value="<?= $cate->id ?>">
          <input type="text" name="description" placeholder=". . . . . . . . . . .">
          <button type="submit">Add</button>
        </form>
      </div>
    </div>

    <?php
    if (!$tasks) : ?>
      <script>
        // self executing function
        (function() {
          const cate = document.getElementById('<?= 'cate-' . $cate->id ?>');
          cate.querySelector('button[type="button"]').style.display = "none";
          cate.querySelector('form').style.display = "flex";
        })();
      </script>

  <?php
    endif;
  endforeach; ?>

</div>

<script>
  function sendForm(checkbox) {
    checkbox.closest('form').submit();
  }

  function openForm(button) {
    button.style.display = "none";
    button.nextElementSibling.style.display = "flex";
  }

  const addForms = document.querySelectorAll('.add form');
  for (let form of addForms) {
    form.addEventListener('submit', (event) => {
      event.preventDefault();
      if (form.querySelectorAll('input')[2].value.trim() === "") {
        form.style.display = "none";
        form.previousElementSibling.style.display = "flex";
      } else {
        form.submit();
      }
    });
  }
</script>
</body>

</html>