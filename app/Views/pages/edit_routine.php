<!-- app/Views/edit_routine.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Routine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Edit Routine</h1>

        <!-- Flash message for errors -->
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <form action="<?= base_url('update-routine/' . $routine['id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group mb-3">
                <label for="animal_id">Animal ID</label>
                <input type="text" name="animal_id" id="animal_id" class="form-control" value="<?= esc($routine['animal_id']) ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="routine_type">Routine Type</label>
                <input type="text" name="routine_type" id="routine_type" class="form-control" value="<?= esc($routine['routine_type']) ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required><?= esc($routine['description']) ?></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="frequency">Frequency</label>
                <input type="text" name="frequency" id="frequency" class="form-control" value="<?= esc($routine['frequency']) ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="employee_id">Employee ID</label>
                <input type="number" name="employee_id" id="employee_id" class="form-control" value="<?= esc($routine['employee_id']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Routine</button>
        </form>
    </div>
</body>

</html>
