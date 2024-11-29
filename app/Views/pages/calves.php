<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Calves</title>
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

        .add-calf-button {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .add-calf-button:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>List of Calves</h1>

        <!-- Table with Calves -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tag Number</th>
                    <th>Date of Birth</th>
                    <th>Health Status</th>
                    <th>Mother's Tag Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($calves)): ?>
                    <tr>
                        <td colspan="5" class="text-center">No calves found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($calves as $calf): ?>
                        <tr>
                            <td><?= esc($calf['tag_number']) ?></td>
                            <td><?= esc($calf['date_of_birth']) ?></td>
                            <td><?= esc($calf['health_status']) ?></td>
                            <td>
                                <?php 
                                    // Assuming you have the cow's tag_number in the database
                                    $motherCow = array_filter($cows, function($cow) use ($calf) {
                                        return $cow['id'] == $calf['cow_id'];
                                    });
                                    echo esc($motherCow ? reset($motherCow)['tag_number'] : 'Unknown');
                                ?>
                            </td>
                            <td>
                                <a href="<?= base_url('edit-calf/' . $calf['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= base_url('delete-calf/' . $calf['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this calf?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Add New Calf Section -->
        <div class="form-container">
            <h2>Add New Calf</h2>
            <?php if (isset($validation_errors) && !empty($validation_errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($validation_errors as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('save-calf') ?>" method="post">
                <div class="mb-3">
                    <label for="cow_id">Cow ID (Mother):</label>
                    <select name="cow_id" id="cow_id" class="form-select">
                        <option value="">Select a Cow</option>
                        <?php foreach ($cows as $cow): ?>
                            <option value="<?= $cow['id'] ?>" <?= old('cow_id') == $cow['id'] ? 'selected' : '' ?>>
                                <?= esc($cow['tag_number']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tag_number">Tag Number:</label>
                    <input type="text" name="tag_number" id="tag_number" class="form-control" value="<?= old('tag_number') ?>">
                </div>

                <div class="mb-3">
                    <label for="date_of_birth">Date of Birth:</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="<?= old('date_of_birth') ?>">
                </div>

                <div class="mb-3">
                    <label for="health_status">Health Status:</label>
                    <input type="text" name="health_status" id="health_status" class="form-control" value="<?= old('health_status') ?>">
                </div>

                <button type="submit" class="btn add-calf-button">Add Calf</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
