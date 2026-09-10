<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>List Users</title>
</head>

<body >
    <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="/" class="btn btn-primary">Go back</a>
        <div>
            <button onclick="submitForm()" class="btn btn-primary">List Users</button>
        </div>
    </div>
    <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">click on list user button to list all the registered users</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script>
        function submitForm() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/users';
            document.body.appendChild(form);
            form.submit();
        }

    </script>
</body>

</html>