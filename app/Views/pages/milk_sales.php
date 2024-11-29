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
        margin-bottom: 0;
    }

    .btn-success {
        background-color: #27ae60;
        border-color: #27ae60;
        font-weight: 600;
        border-radius: 5px;
        padding: 5px 15px;
        font-size: 0.9rem;
        transition: transform 0.3s;
        margin-left: 10px;
    }

    .btn-success:hover {
        background-color: #2ecc71;
        border-color: #2ecc71;
        transform: scale(1.05);
    }

    .header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
</style>
</head>

<body class="bg-light">
    <div class="container">
        <div class="sales-container">
            <div class="header-row">
                <h3>Milk Sales</h3>
                <a href="<?= base_url('add-sale') ?>" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add Sale
                </a>
            </div><br><br>



            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Animal ID</th>
                        <th>Sale Date</th>
                        <th>Quantity (Liters)</th>
                        <th>Price/Liter (DH)</th>
                        <th>Total Price (DH)</th>
                        <th>Buyer Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $sale): ?>
                        <tr>
                            <td><?= $sale['animal_id'] ?></td>
                            <td><?= $sale['sale_date'] ?></td>
                            <td><?= $sale['quantity_liters'] ?></td>
                            <td><?= $sale['price_per_liter'] ?></td>
                            <td><?= $sale['quantity_liters']*$sale['price_per_liter']?> DH</td>
                            <td><?= $sale['buyer_name'] ?></td>
                            <td>
                                <a href="<?= base_url('edit-sale/' . $sale['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="<?= base_url('delete-sale/' . $sale['id']) ?>" class="btn btn-danger btn-sm">Delete</a>
                                <a href="<?= base_url('download-invoice/' . $sale['id']) ?>" class="btn btn-info btn-sm">Download Invoice</a>

                            </td>
                            <td>
</td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>
