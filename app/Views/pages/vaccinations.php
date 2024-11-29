<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Vaccinations</title>
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

        .add-vaccination-button {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .add-vaccination-button:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Animal Vaccinations</h1>

        <!-- Table with Vaccinations -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Animal ID</th>
                    <th>Animal Type</th>
                    <th>Vaccine Name</th>
                    <th>Vaccination Date</th>
                    <th>Next Vaccine Date</th>
                    <th>Administered By</th>
                    <th>Created By</th>
                    <th>Employee ID</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vaccinations as $vaccination): ?>
                    <tr>
                        <td><?= $vaccination['id'] ?></td>
                        <td><?= $vaccination['animal_id'] ?></td>
                        <td><?= $vaccination['animal_type'] ?></td>
                        <td><?= $vaccination['vaccine_name'] ?></td>
                        <td><?= $vaccination['vaccination_date'] ?></td>
                        <td><?= $vaccination['next_vaccine_date'] ?></td>
                        <td><?= $vaccination['administered_by'] ?></td>
                        <td><?= $vaccination['created_by'] ?></td>
                        <td><?= $vaccination['employee_id'] ?></td>
                        <td><?= $vaccination['notes'] ?></td>
                        <td>
                            <a href="<?= base_url('edit_vaccination/' . $vaccination['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="<?= base_url('delete_vaccination/' . $vaccination['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this vaccination?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Add New Vaccination Section -->
        <div class="form-container">
            <h2>Add New Vaccination</h2>
            <?php if (isset($validation_errors) && !empty($validation_errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($validation_errors as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('add_vaccination') ?>" method="post">
                <div class="mb-3">
                    <label for="animal_id">Animal ID:</label>
                    <input type="text" name="animal_id" id="animal_id" class="form-control" value="<?= set_value('animal_id') ?>">
                </div>
                <div class="mb-3">
                    <label for="animal_type">Animal Type:</label>
                    <input type="text" name="animal_type" id="animal_type" class="form-control" value="<?= set_value('animal_type') ?>">
                </div>
                <div class="mb-3">
                    <label for="vaccine_name">Vaccine Name:</label>
                    <input type="text" name="vaccine_name" id="vaccine_name" class="form-control" value="<?= set_value('vaccine_name') ?>">
                </div>
                <div class="mb-3">
                    <label for="vaccination_date">Vaccination Date:</label>
                    <input type="date" name="vaccination_date" id="vaccination_date" class="form-control" value="<?= set_value('vaccination_date') ?>">
                </div>
                <button type="submit" class="btn add-vaccination-button">Add Vaccination</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
