<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stalls</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container"> 1 
        <h1>Stalls</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Stall Number</th>
                    <th>Capacity</th>
                    <th>Occupied</th>
                    <th>Created By</th>
                    <th>Employee ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stalls as $stall): ?>
                    <tr>
                        <td><?= $stall['stall_number'] ?></td>
                        <td><?= $stall['capacity'] ?></td>
                        <td><?= $stall['occupied'] ? 'Yes' : 'No' ?></td>
                        <td><?= $stall['created_by'] ?></td>
                        <td><?= $stall['employee_id'] ?></td>
                        <td>
                            <a href="<?= base_url('edit_stall/' . $stall['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="<?= base_url('delete_stall/' . $stall['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this stall?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Add New Stall</h2>
        <?php if (isset($validation_errors) && !empty($validation_errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($validation_errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('add_stall') ?>" method="post">
            <div class="mb-3">
                <label for="stall_number">Stall Number:</label>
                <input type="text" name="stall_number" id="stall_number" class="form-control" value="<?= set_value('stall_number') ?>">
            </div>
            <div class="mb-3">
                <label for="capacity">Capacity:</label>
                <input type="number" name="capacity" id="capacity" class="form-control" value="<?= set_value('capacity') ?>">
            </div>
            <div class="mb-3">
                <label for="occupied">Occupied:</label>
                <select name="occupied" id="occupied" class="form-select">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="employee_id">Employee ID:</label>
                <input type="text" name="employee_id" id="employee_id" class="form-control" value="<?= set_value('employee_id') ?>">
            </div>
            <button type="submit" class="btn btn-primary">Add Stall</button>
        </form>
    </div>
</body>
</html>