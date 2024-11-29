<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Milk Sale</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h2 class="text-center">Edit Milk Sale</h2>

        <?php if (isset($validation_errors) && !empty($validation_errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($validation_errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('update-sale/' . $sale['id']) ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="sale_type" class="form-label">Sale Type:</label>
                <select name="sale_type" id="sale_type" class="form-select">
                    <option value="wholesale" <?= $sale['sale_type'] === 'wholesale' ? 'selected' : '' ?>>Wholesale</option>
                    <option value="retail" <?= $sale['sale_type'] === 'retail' ? 'selected' : '' ?>>Retail</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="animal_id" class="form-label">Animal ID:</label>
                <input type="text" name="animal_id" id="animal_id" class="form-control" value="<?= esc($sale['animal_id']) ?>">
            </div>

            <div class="mb-3">
                <label for="sale_date" class="form-label">Sale Date:</label>
                <input type="date" name="sale_date" id="sale_date" class="form-control" value="<?= esc($sale['sale_date']) ?>">
            </div>

            <div class="mb-3">
                <label for="quantity_liters" class="form-label">Quantity (Liters):</label>
                <input type="number" step="0.01" name="quantity_liters" id="quantity_liters" class="form-control" value="<?= esc($sale['quantity_liters']) ?>">
            </div>

            <div class="mb-3">
                <label for="price_per_liter" class="form-label">Price per Liter:</label>
                <input type="number" step="0.01" name="price_per_liter" id="price_per_liter" class="form-control" value="<?= esc($sale['price_per_liter']) ?>">
            </div>

            <div class="mb-3">
                <label for="buyer_name" class="form-label">Buyer Name:</label>
                <input type="text" name="buyer_name" id="buyer_name" class="form-control" value="<?= esc($sale['buyer_name']) ?>">
            </div>

            <div class="mb-3">
                <label for="invoice_number" class="form-label">Invoice Number:</label>
                <input type="text" name="invoice_number" id="invoice_number" class="form-control" value="<?= esc($sale['invoice_number']) ?>">
            </div>

            <div class="mb-3">
                <label for="payment_status" class="form-label">Payment Status:</label>
                <select name="payment_status" id="payment_status" class="form-select">
                    <option value="pending" <?= $sale['payment_status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="partially_paid" <?= $sale['payment_status'] === 'partially_paid' ? 'selected' : '' ?>>Partially Paid</option>
                    <option value="fully_paid" <?= $sale['payment_status'] === 'fully_paid' ? 'selected' : '' ?>>Fully Paid</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update Sale</button>
            <a href="<?= base_url('milk-sales') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
