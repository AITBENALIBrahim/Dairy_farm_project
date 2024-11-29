<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pregnancy Records</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding-top: 30px;
        }

        .pregnancy-form-container {
            max-width: 700px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .pregnancy-form-container h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            text-align: center;
        }

        .form-group label {
            font-weight: 600;
            color: #2c3e50;
        }

        .input-group .form-control {
            padding-left: 40px;
        }

        .input-group .input-group-prepend {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2rem;
            color: #27ae60;
            z-index: 10;
        }

        .btn-primary {
            background-color: #27ae60;
            border-color: #27ae60;
            font-weight: 600;
            border-radius: 5px;
            transition: transform 0.3s;
        }

        .btn-primary:hover {
            transform: scale(1.05);
        }

        .table {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table th {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
        }

        .table td {
            padding: 10px;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f1f1f1;
        }

        .alert {
            margin-bottom: 20px;
        }

        .invalid-feedback {
            display: block;
        }
    </style>
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
        <div class="pregnancy-form-container">
            <h2>Add New Pregnancy Record</h2>
            <form action="<?= base_url('add_pregnancy') ?>" method="post">
                <div class="form-group">
                    <label for="cow_id">Cow ID</label>
                    <div class="input-group <?= isset($validation) && $validation->hasError('cow_id') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-cow"></span>
                        </div>
                        <input type="text" name="cow_id" id="cow_id" class="form-control <?= isset($validation) && $validation->hasError('cow_id') ? 'is-invalid' : '' ?>" value="<?= set_value('cow_id') ?>" required placeholder="Enter cow ID">
                    </div>
                    <?php if (isset($validation) && $validation->hasError('cow_id')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('cow_id')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="pregnancy_start_date">Pregnancy Start Date</label>
                    <div class="input-group <?= isset($validation) && $validation->hasError('pregnancy_start_date') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-calendar-day"></span>
                        </div>
                        <input type="date" name="pregnancy_start_date" id="pregnancy_start_date" class="form-control <?= isset($validation) && $validation->hasError('pregnancy_start_date') ? 'is-invalid' : '' ?>" value="<?= set_value('pregnancy_start_date') ?>" required>
                    </div>
                    <?php if (isset($validation) && $validation->hasError('pregnancy_start_date')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('pregnancy_start_date')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="expected_delivery_date">Expected Delivery Date</label>
                    <div class="input-group <?= isset($validation) && $validation->hasError('expected_delivery_date') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-calendar-alt"></span>
                        </div>
                        <input type="date" name="expected_delivery_date" id="expected_delivery_date" class="form-control <?= isset($validation) && $validation->hasError('expected_delivery_date') ? 'is-invalid' : '' ?>" value="<?= set_value('expected_delivery_date') ?>" required>
                    </div>
                    <?php if (isset($validation) && $validation->hasError('expected_delivery_date')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('expected_delivery_date')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="notes" class="form-control"><?= set_value('notes') ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Add Pregnancy Record</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
