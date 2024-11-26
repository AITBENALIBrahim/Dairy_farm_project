<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cows</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Cows</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tag Number</th>
                    <th>Date of Birth</th>
                    <th>Health Status</th>
                    <th>Stall ID</th>
                    <th>Sale Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cows as $cow): ?>
                    <tr>
                        <td><?= $cow['id'] ?></td>
                        <td><?= $cow['tag_number'] ?></td>
                        <td><?= $cow['date_of_birth'] ?></td>
                        <td><?= $cow['health_status'] ?></td>
                        <td><?= $cow['stall_id'] ?></td>
                        <td><?= $cow['sale_status'] ?></td>
                        <td>
                            <a href="<?= base_url('edit_cow/' . $cow['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="<?= base_url('delete_cow/' . $cow['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this cow?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Add New Cow</h2>
        <?php if (isset($validation_errors) && !empty($validation_errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($validation_errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('add_cow') ?>" method="post">
            <div class="mb-3">
                <label for="tag_number">Tag Number:</label>
                <input type="text" name="tag_number" id="tag_number" class="form-control" value="<?= set_value('tag_number') ?>">
            </div>
            <div class="mb-3">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="<?= set_value('date_of_birth') ?>">
            </div>
            <div class="mb-3">
                <label for="health_status">Health Status:</label>
                <input type="text" name="health_status" id="health_status" class="form-control" value="<?= set_value('health_status') ?>">
            </div>
            <div class="mb-3">
                <label for="stall_id">Stall ID:</label>
                <input type="text" name="stall_id" id="stall_id" class="form-control" value="<?= set_value('stall_id') ?>">
            </div>
            <div class="mb-3">
                <label for="sale_status">Sale Status:</label>
                <input type="text" name="sale_status" id="sale_status" class="form-control" value="<?= set_value('sale_status') ?>">
            </div>
            <button type="submit" class="btn btn-primary">Add Cow</button>
        </form>
    </div>
</body>
</html>