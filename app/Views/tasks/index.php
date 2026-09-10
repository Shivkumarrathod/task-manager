<?php

/**
 * @var array $tasks List of task arrays with keys: id, title, description, status, created_at
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>TaskFlow</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1>TaskFlow</h1>
      <div>
        <a href="/tasks/add" class="btn btn-primary">+ New Task</a>
        <a href="/users" class="btn btn-primary">List Users</a>
        <a href="/logout" class="btn btn-danger">Logout</a>
      </div>
    </div>

    <?php foreach ($tasks as $task): ?>
      <div class="grid gap-3" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));" >
        <?php require __DIR__ . '/../components/taskCards.php'; ?>
      </div>
    <?php endforeach; ?>
 
  </div>
</body>
<script > 
  console.log(<?= json_encode($tasks) ?>);
</script>
</html>