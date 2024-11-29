<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milk Collection - Dairy Farm</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJ9vM9vYd8m5U6tMZgZj5yTc+LhT1kF0kLZPeJwN1gEuK27u27oK9Z8A6v7M" crossorigin="anonymous">

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

        .btn-success {
            background-color: #27ae60;
            border-color: #27ae60;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .btn-success:hover {
            background-color: #219150;
            border-color: #219150;
        }

        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }
    </style>
</head>

<body>
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
                        <th>Collection ID</th>
                        <th>Cow ID</th>
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
        <div class="form-container">
            <h2>Add New Milk Collection</h2>

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger">
                    <?php foreach (validation_errors() as $error) : ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('add_milk_collection') ?>" method="post">
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
            </form>
        </div>

    </div>

    <!-- Bootstrap JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybT1j3sA5b7Kydn9beDcih0z8zkP8fGGp1p4v9rfOnqv7t8d47" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0M8Fq1hnwz8d8Ck93k0xt0Q4LmZOL2BxDd6DTRt+ro+/pz8D" crossorigin="anonymous"></script>

</body>

</html>
