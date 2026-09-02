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
        <a href="/logout" class="btn btn-danger">Logout</a>
      </div>
    </div>


    <table class="table table-bordered bg-white">
      <thead>
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Status</th>
          <th>Created</th>
          <th style="width:160px;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tasks as $task): ?>
          <tr>
            <td><?= htmlspecialchars($task['title']) ?></td>
            <td><?= htmlspecialchars($task['description']) ?></td>
            <td>
              <span class="badge <?= $task['status'] === 'done' ? 'bg-success' : 'bg-warning text-dark' ?>">
                <?= htmlspecialchars($task['status']) ?>
              </span>
            </td>
            <td><?= htmlspecialchars($task['created_at']) ?></td>
            <td>
              <a href="/tasks/edit?id=<?= $task['id'] ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
              <a href="/tasks/delete?id=<?= $task['id'] ?>" class="btn btn-sm btn-outline-danger"
                onclick="return confirm('Delete this task?')">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>

</html>