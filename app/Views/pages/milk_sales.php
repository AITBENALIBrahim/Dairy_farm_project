<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Milk Sales</title>
    <style>
        body {
            margin-top: 10px;
        }

        .sales-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .sales-container h3 {
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .btn-success,
        .btn-primary {
            font-weight: 600;
            border-radius: 5px;
        }

        .btn-success {
            background-color: #27ae60;
            border-color: #27ae60;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }

        .btn-success:hover {
            background-color: #2ecc71;
            border-color: #2ecc71;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container">
        <div class="sales-container">
            <h3 class="text-center mb-4">Milk Sales</h3>

            <?php if (session()->has('success')): ?>
                <div class="alert alert-success text-center">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Sale ID</th>
                        <th>Sale Type</th>
                        <th>Animal ID</th>
                        <th>Sale Date</th>
                        <th>Quantity (Liters)</th>
                        <th>Price/Liter</th>
                        <th>Total Sale Price</th>
                        <th>Buyer Name</th>
                        <th>Invoice Number</th>
                        <th>Payment Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $sale): ?>
                        <tr>
                            <td><?= $sale['id'] ?></td>
                            <td><?= $sale['sale_type'] ?></td>
                            <td><?= $sale['animal_id'] ?></td>
                            <td><?= $sale['sale_date'] ?></td>
                            <td><?= $sale['quantity_liters'] ?></td>
                            <td><?= $sale['price_per_liter'] ?></td>
                            <td><?= $sale['sale_price'] ?></td>
                            <td><?= $sale['buyer_name'] ?></td>
                            <td><?= $sale['invoice_number'] ?></td>
                            <td><?= $sale['payment_status'] ?></td>
                            <td>
                                <a href="<?= base_url('edit-sale/' . $sale['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="<?= base_url('delete-sale/' . $sale['id']) ?>" class="btn btn-danger btn-sm">Delete</a>
                                
                            </td>
                            <td>
    <a href="<?= base_url('download-invoice/' . $sale['id']) ?>" class="btn btn-info btn-sm">Download Invoice</a>
</td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h4>Add New Sale</h4>
            <a href="<?= base_url('add-sale') ?>" class="btn btn-success btn-block">Add Sale</a>
        </div>
    </div>
</body>

</html>
