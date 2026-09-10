<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php $task = $task ?? []; ?>
    <div class="card mb-3 hieght-100" >
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($task['title'] ?? '') ?></h5>
              <p class="card-text"><?= htmlspecialchars($task['description'] ?? '') ?></p>
              <p class="card-text">
                <span class="badge <?= ($task['status'] ?? '') === 'done' ? 'bg-success' : 'bg-warning text-dark' ?>">
                  <?= htmlspecialchars($task['status'] ?? '') ?>
                </span>
                <small class="text-muted">Created: <?= htmlspecialchars($task['created_at'] ?? '') ?></small>
              </p>
              <a href="/tasks/edit?id=<?= $task['id'] ?? '' ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
              <a href="/tasks/delete?id=<?= $task['id'] ?? '' ?>" class="btn btn-sm btn-outline-danger"
                onclick="return confirm('Delete this task?')">Delete</a>
    </div>
</body>
</html>