<?php
$stmt = $conn->query("SELECT * FROM `tasks` ORDER BY id DESC");
$tasks = $stmt->fetchAll(PDO::FETCH_OBJ);
function check($a, $b)
{
  if ($a > 0) {
    return $b;
  }
}
?>
<section class="mt-8 container mx-auto flex flex-col items-center gap-1">
  <?php if (!$tasks) : ?>
    <p>Nothing, try to add some To Do</p>
  <?php endif; ?>
  <?php foreach ($tasks as $task) : ?>
    <div class="w-full sm:w-3/4 lg:w-2/3 px-4 py-2	flex justify-between items-center text-lg">
      <form action="task-status.php?id=<?= $task->id ?>" method="POST">
        <label class="cursor-pointer flex items-center gap-4 <?= check($task->status, "line-through") ?>">
          <input type="hidden" name="status" value="<?= $task->status ?>">
          <input type="checkbox" class="scale-150 cursor-pointer" onchange="submitForm(this)" <?= check($task->status, " checked ") ?>>
          <?= $task->description ?>
        </label>
      </form>
      <a href="delete-task.php?id=<?= $task->id ?>" class="text-3xl font-bold px-2 text-gray-700 hover:text-red-400">&times;</a>
    </div>
  <?php endforeach; ?>
</section>
<script>
  function submitForm(checkbox) {
    checkbox.closest('form').submit();
  }
</script>