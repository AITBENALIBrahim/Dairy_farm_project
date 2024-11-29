<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Add New Routine</title>
    <link rel="shortcut icon" href="<?= base_url('images/logo.png') ?>" type="image/png" />
    <style>
        body {
            margin-top: 10px;
        }

        .routine-container {
            max-width: 700px;
            width: 100%;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .routine-container h3 {
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .btn-success {
            background-color: #27ae60;
            border-color: #27ae60;
            font-weight: 600;
            border-radius: 5px;
        }

        .btn-success:hover {
            background-color: #2ecc71;
            border-color: #2ecc71;
        }

        .invalid-feedback {
            display: block;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container">
        <div class="routine-container">
            <h3 class="text-center mb-4">Add New Routine</h3>

            <!-- Flash Message for Errors -->
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger text-center">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <!-- Add Routine Form -->
            <form action="<?= base_url('save-routine') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="animal_id">Animal ID</label>
                    <input type="text" name="animal_id" id="animal_id" class="form-control <?= $validation && $validation->hasError('animal_id') ? 'is-invalid' : '' ?>" required>
                    <?php if ($validation && $validation->hasError('animal_id')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('animal_id')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="animal_type">Animal Type</label>
                    <input type="text" name="animal_type" id="animal_type" class="form-control <?= $validation && $validation->hasError('animal_type') ? 'is-invalid' : '' ?>" required>
                    <?php if ($validation && $validation->hasError('animal_type')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('animal_type')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="routine_type">Routine Type</label>
                    <input type="text" name="routine_type" id="routine_type" class="form-control <?= $validation && $validation->hasError('routine_type') ? 'is-invalid' : '' ?>" required>
                    <?php if ($validation && $validation->hasError('routine_type')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('routine_type')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control <?= $validation && $validation->hasError('description') ? 'is-invalid' : '' ?>" required></textarea>
                    <?php if ($validation && $validation->hasError('description')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('description')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="frequency">Frequency</label>
                    <input type="text" name="frequency" id="frequency" class="form-control <?= $validation && $validation->hasError('frequency') ? 'is-invalid' : '' ?>" required>
                    <?php if ($validation && $validation->hasError('frequency')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('frequency')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="employee_id">Employee ID</label>
                    <input type="number" name="employee_id" id="employee_id" class="form-control <?= $validation && $validation->hasError('employee_id') ? 'is-invalid' : '' ?>" required>
                    <?php if ($validation && $validation->hasError('employee_id')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('employee_id')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-success btn-block">Save Routine</button>
            </form>
        </div>
    </div>
</body>

</html>
