<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stalls</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding-top: 30px;
        }

        h1, h2 {
            color: #333;
            font-weight: 700;
            margin-bottom: 20px;
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

        .btn {
            transition: all 0.3s ease-in-out;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .alert-danger {
            margin-bottom: 20px;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container label {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        .add-stall-button {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .add-stall-button:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Stalls</h1>

        <!-- Table with Stalls -->
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

        <!-- Add New Stall Section -->
        <div class="form-container">
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
                <button type="submit" class="btn add-stall-button">Add Stall</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
