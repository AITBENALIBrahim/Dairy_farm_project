<!DOCTYPE html>
<html lang="en">
<head>
    <title>Milk Sales</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Milk Sales</h1>

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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Add New Milk Sale</h2>

        <?php if (isset($validation_errors) && !empty($validation_errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($validation_errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('add_sale') ?>" method="post">
            <div class="mb-3">
                <label for="sale_type">Sale Type:</label>
                <select name="sale_type" id="sale_type" class="form-select">
                    <option value="wholesale">Wholesale</option>
                    <option value="retail">Retail</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="animal_id">Animal ID:</label>
                <input type="text" name="animal_id" id="animal_id" class="form-control" value="<?= set_value('animal_id') ?>">
            </div>
            <div class="mb-3">
                <label for="sale_date">Sale Date:</label>
                <input type="date" name="sale_date" id="sale_date" class="form-control" value="<?= set_value('sale_date') ?>">
            </div>
            <div class="mb-3">
                <label for="quantity_liters">Quantity (Liters):</label>
                <input type="number" step="0.01" name="quantity_liters" id="quantity_liters" class="form-control" value="<?= set_value('quantity_liters') ?>">
            </div>
            <div class="mb-3">
                <label for="price_per_liter">Price per Liter:</label>
                <input type="number" step="0.01" name="price_per_liter" id="price_per_liter" class="form-control" value="<?= set_value('price_per_liter') ?>">
            </div>
            <div class="mb-3">
                <label for="buyer_name">Buyer Name:</label>
                <input type="text" name="buyer_name" id="buyer_name" class="form-control" value="<?= set_value('buyer_name') ?>">
            </div>
            <div class="mb-3">
                <label for="invoice_number">Invoice Number:</label>
                <input type="text" name="invoice_number" id="invoice_number" class="form-control" value="<?= set_value('invoice_number') ?>">
            </div>
            <div class="mb-3">
                <label for="payment_status">Payment Status:</label>
                <select name="payment_status" id="payment_status" class="form-select">
                <div class="mb-3">
    <label for="payment_status">Payment Status:</label>
    <select name="payment_status" id="payment_status" class="form-select">
        <option value="pending">Pending</option>
        <option value="partially_paid">Partially Paid</option>
        <option value="fully_paid">Fully Paid</option>
    </select>
</div>
<button 1  type="submit" class="btn btn-primary">Add Sale</button>
</form>
</div>
</body>
</html>