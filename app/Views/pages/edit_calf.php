<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Calf</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Edit Calf</h2>

        <?php if (isset($validation_errors) && !empty($validation_errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($validation_errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('update-calf/' . $calf['id']) ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="cow_id">Cow ID:</label>
                <input type="text" name="cow_id" id="cow_id" class="form-control" value="<?= esc($calf['cow_id']) ?>">
            </div>

            <div class="mb-3">
                <label for="tag_number">Tag Number:</label>
                <input type="text" name="tag_number" id="tag_number" class="form-control" value="<?= esc($calf['tag_number']) ?>">
            </div>

            <div class="mb-3">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="<?= esc($calf['date_of_birth']) ?>">
            </div>

            <div class="mb-3">
                <label for="health_status">Health Status:</label>
                <input type="text" name="health_status" id="health_status" class="form-control" value="<?= esc($calf['health_status']) ?>">
            </div>

            <div class="mb-3">
                <label for="stall_id">Stall ID:</label>
                <input type="text" name="stall_id" id="stall_id" class="form-control" value="<?= esc($calf['stall_id']) ?>">
            </div>

            <div class="mb-3">
                <label for="sale_status">Sale Status:</label>
                <input type="text" name="sale_status" id="sale_status" class="form-control" value="<?= esc($calf['sale_status']) ?>">
            </div>

            <button type="submit" class="btn btn-success">Update Calf</button>
            <a href="<?= base_url('calves') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
