<!-- app/Views/pages/pregnancy_records.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pregnancy Records</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Pregnancy Records</h1>

        <!-- Display any validation errors -->
        <?php if (isset($validation_errors) && !empty($validation_errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($validation_errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Display success message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Table to display pregnancy records -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cow ID</th>
                    <th>Pregnancy Start Date</th>
                    <th>Expected Delivery Date</th>
                    <th>Notes</th>
                    <th>Created By</th>
                    <th>Employee ID</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pregnancies as $pregnancy): ?>
                    <tr>
                        <td><?= $pregnancy['id'] ?></td>
                        <td><?= $pregnancy['cow_id'] ?></td>
                        <td><?= $pregnancy['pregnancy_start_date'] ?></td>
                        <td><?= $pregnancy['expected_delivery_date'] ?></td>
                        <td><?= $pregnancy['notes'] ?></td>
                        <td><?= $pregnancy['created_by'] ?></td>
                        <td><?= $pregnancy['employee_id'] ?></td>
                        <td><?= $pregnancy['created_at'] ?></td>
                        <td>
                            <a href="<?= base_url('edit_pregnancy/' . $pregnancy['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="<?= base_url('delete_pregnancy/' . $pregnancy['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this pregnancy record?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Form to add a new pregnancy record -->
        <h2>Add New Pregnancy Record</h2>
        <form action="<?= base_url('add_pregnancy') ?>" method="post">
            <div class="mb-3">
                <label for="cow_id">Cow ID:</label>
                <input type="text" name="cow_id" id="cow_id" class="form-control" value="<?= set_value('cow_id') ?>" required>
            </div>
            <div class="mb-3">
                <label for="pregnancy_start_date">Pregnancy Start Date:</label>
                <input type="date" name="pregnancy_start_date" id="pregnancy_start_date" class="form-control" value="<?= set_value('pregnancy_start_date') ?>" required>
            </div>
            <div class="mb-3">
                <label for="expected_delivery_date">Expected Delivery Date:</label>
                <input type="date" name="expected_delivery_date" id="expected_delivery_date" class="form-control" value="<?= set_value('expected_delivery_date') ?>" required>
            </div>
            <div class="mb-3">
                <label for="notes">Notes:</label>
                <textarea name="notes" id="notes" class="form-control"><?= set_value('notes') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Pregnancy Record</button>
        </form>
    </div>
</body>
</html>
