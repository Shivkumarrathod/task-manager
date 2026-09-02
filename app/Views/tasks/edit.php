<?php
/**
 * @var array $task Task data with keys: id, title, description, status
 * @var string $error Optional error message
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Task</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5" style="max-width:500px;">
  <h1 class="mb-4">Edit Task</h1>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="post" action="/tasks/edit?id=<?= $task['id'] ?>">
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($task['title']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control"><?= htmlspecialchars($task['description']) ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select">
        <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
        <option value="done" <?= $task['status'] === 'done' ? 'selected' : '' ?>>Done</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="/" class="btn btn-link">Cancel</a>
  </form>
</div>
</body>
</html>
