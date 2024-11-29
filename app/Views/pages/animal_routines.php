<!-- app/Views/animal_routines.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Animal Routines</title>
    <link rel="shortcut icon" href="<?= base_url('images/logo.png') ?>" type="image/png" />
    <style>
        body {
            margin-top: 10px;
        }

        .routine-container {
            max-width: 900px;
            width: 100%;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin-top: 20px;
        }

        .routine-container h3 {
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            font-weight: 600;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .table td, .table th {
            text-align: center;
        }

        .invalid-feedback {
            display: block;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container">
        <div class="routine-container">
            <h3 class="text-center mb-4">Animal Routines</h3>

            <!-- Flash Message for Errors -->
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger text-center">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <a href="<?= base_url('add-routine') ?>" class="btn btn-primary mb-4">Add Routine</a>

            <!-- Animal Routine Table -->
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Animal</th>
                        <th>Routine Type</th>
                        <th>Description</th>
                        <th>Frequency</th>
                        <th>Employee</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($routines)): ?>
                        <?php foreach ($routines as $routine): ?>
                            <tr>
                                <td><?= $routine['id'] ?></td>
                                <td><?= $routine['animal_type'] ?> - <?= $routine['animal_id'] ?></td>
                                <td><?= $routine['routine_type'] ?></td>
                                <td><?= $routine['description'] ?></td>
                                <td><?= $routine['frequency'] ?></td>
                                <td><?= $routine['employee_id'] ?></td>
                                <td>
                                    <!-- Add Edit and Delete Actions -->
                                    <a href="<?= base_url('edit-routine/'.$routine['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('delete-routine/'.$routine['id']) ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No routines found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
