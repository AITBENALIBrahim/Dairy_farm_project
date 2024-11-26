<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milk Collection - Dairy Farm</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJ9vM9vYd8m5U6tMZgZj5yTc+LhT1kF0kLZPeJwN1gEuK27u27oK9Z8A6v7M" crossorigin="anonymous">

    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS for styling -->
    <style>
        .container {
            background-color: #ffffff;
            padding: 0.5rem 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: fadeIn 1s ease-in-out;
            overflow-x: hidden;
            min-height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        h1,
        h2 {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .btn {
            margin-right: 5px;
        }

        .table {
            border: none;
            table-layout: fixed;
        }

        .table th,
        .table td {
            vertical-align: middle;
            color: #2c3e50;
        }

        /* Reduce table row height */
        .table th,
        .table td {
            padding: 0.25rem 0.5rem;
            /* Adjust the padding to reduce row height */
            font-size: 0.9rem;
            /* Optional: reduce font size for better fit */
            overflow: hidden;
            /* Prevent content from overflowing */
            text-overflow: ellipsis;
        }

        /* Optional: Adjust table header height */
        .table th {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }

        /* Fade-in effect */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Success/Error Message */
        .alert {
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }

        /* Table and Button Colors */
        .btn-success {
            background-color: #27ae60;
            border-color: #27ae60;
            font-weight: 600;
            border-radius: 5px;
            transition: transform 0.3s;
        }

        .btn-success:hover {
            transform: scale(1.05);
        }

        .form-control,
        .form-select {
            font-size: 0.9rem;
        }

        /* Center alignment for form elements */
        .form-container {
            margin-bottom: 2rem;
        }

        /* Pagination container */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }
    </style>
</head>

<body class="d-flex align-items-center bg-light" style="height: 100vh;">
    <div class="container">

        <!-- Success/Error Messages -->
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success text-center"><?= session()->getFlashdata('message') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger text-center"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <h1>Milk Collection</h1>

        <!-- Table for displaying milk collections -->
        <?php if (isset($milk_collections) && !empty($milk_collections)) : ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th style="width: 90px;">Cow ID</th>
                        <th>Collection Date</th>
                        <th>Quantity</th>
                        <th>Milk Type</th>
                        <th>Employee ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($milk_collections as $collection): ?>
                        <tr>
                            <td><?= $collection['id'] ?></td>
                            <td><?= $collection['cow_id'] ?></td>
                            <td><?= $collection['collection_date'] ?></td>
                            <td><?= $collection['quantity'] ?></td>
                            <td><?= ucfirst($collection['milk_type']) ?></td>
                            <td><?= $collection['employee_id'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="alert alert-info">No milk collections found.</p>
        <?php endif; ?>

        <!-- Form to add a new milk collection -->
        <h2>Add New Milk Collection</h2>
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger">
                <?php foreach (validation_errors() as $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('add_milk_collection') ?>" method="post">
            <div class="form-container">
                <div class="mb-3">
                    <label for="cow_id">Cow ID:</label>
                    <input type="text" name="cow_id" id="cow_id" class="form-control" value="<?= set_value('cow_id') ?>">
                </div>
                <div class="mb-3">
                    <label for="quantity">Quantity:</label>
                    <input type="text" name="quantity" id="quantity" class="form-control" value="<?= set_value('quantity') ?>">
                </div>
                <div class="mb-3">
                    <label for="milk_type">Milk Type:</label>
                    <select name="milk_type" id="milk_type" class="form-select">
                        <option value="cow">Cow</option>
                        <option value="buffalo">Buffalo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="employee_id">Employee ID:</label>
                    <input type="text" name="employee_id" id="employee_id" class="form-control" value="<?= set_value('employee_id') ?>">
                </div>
                <button type="submit" class="btn btn-success">Add Collection</button>
            </div>
        </form>

    </div>

    <!-- Bootstrap JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybT1j3sA5b7Kydn9beDcih0z8zkP8fGGp1p4v9rfOnqv7t8d47" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0M8Fq1hnwz8d8Ck93k0xt0Q4LmZOL2BxDd6DTRt+ro+/pz8D" crossorigin="anonymous"></script>

</body>

</html>
