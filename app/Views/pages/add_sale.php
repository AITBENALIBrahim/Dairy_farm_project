<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Add Milk Sale</title>
    <style>
        body {
            margin-top: 10px;
        }

        .sales-container {
            max-width: 700px;
            width: 100%;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .sales-container h3 {
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .btn-success {
            background-color: #27ae60;
            border-color: #27ae60;
            font-weight: 600;
            border-radius: 5px;
        }

        .btn-success:hover {
            background-color: #2ecc71;
            border-color: #2ecc71;
        }

        .invalid-feedback {
            display: block;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container">
        <div class="sales-container">
            <h3 class="text-center mb-4">Add New Milk Sale</h3>

            <?php if (isset($validation_errors) && !empty($validation_errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($validation_errors as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

            <form action="<?= base_url('add-sale') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="sale_type">Sale Type</label>
                    <select name="sale_type" id="sale_type" class="form-control <?= isset($validation) && $validation->hasError('sale_type') ? 'is-invalid' : '' ?>" required>
                        <option value="wholesale" <?= set_value('sale_type') == 'wholesale' ? 'selected' : '' ?>>Wholesale</option>
                        <option value="retail" <?= set_value('sale_type') == 'retail' ? 'selected' : '' ?>>Retail</option>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('sale_type')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('sale_type')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="animal_id">Animal ID</label>
                    <input type="text" name="animal_id" id="animal_id" class="form-control <?= isset($validation) && $validation->hasError('animal_id') ? 'is-invalid' : '' ?>" value="<?= set_value('animal_id') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('animal_id')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('animal_id')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="sale_date">Sale Date</label>
                    <input type="date" name="sale_date" id="sale_date" class="form-control <?= isset($validation) && $validation->hasError('sale_date') ? 'is-invalid' : '' ?>" value="<?= set_value('sale_date') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('sale_date')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('sale_date')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="quantity_liters">Quantity (Liters)</label>
                    <input type="number" step="0.01" name="quantity_liters" id="quantity_liters" class="form-control <?= isset($validation) && $validation->hasError('quantity_liters') ? 'is-invalid' : '' ?>" value="<?= set_value('quantity_liters') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('quantity_liters')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('quantity_liters')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="price_per_liter">Price per Liter</label>
                    <input type="number" step="0.01" name="price_per_liter" id="price_per_liter" class="form-control <?= isset($validation) && $validation->hasError('price_per_liter') ? 'is-invalid' : '' ?>" value="<?= set_value('price_per_liter') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('price_per_liter')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('price_per_liter')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="buyer_name">Buyer Name</label>
                    <input type="text" name="buyer_name" id="buyer_name" class="form-control <?= isset($validation) && $validation->hasError('buyer_name') ? 'is-invalid' : '' ?>" value="<?= set_value('buyer_name') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('buyer_name')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('buyer_name')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="invoice_number">Invoice Number</label>
                    <input type="text" name="invoice_number" id="invoice_number" class="form-control <?= isset($validation) && $validation->hasError('invoice_number') ? 'is-invalid' : '' ?>" value="<?= set_value('invoice_number') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('invoice_number')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('invoice_number')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="payment_status">Payment Status</label>
                    <select name="payment_status" id="payment_status" class="form-control <?= isset($validation) && $validation->hasError('payment_status') ? 'is-invalid' : '' ?>" required>
                        <option value="pending" <?= set_value('payment_status') == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="partially_paid" <?= set_value('payment_status') == 'partially_paid' ? 'selected' : '' ?>>Partially Paid</option>
                        <option value="fully_paid" <?= set_value('payment_status') == 'fully_paid' ? 'selected' : '' ?>>Fully Paid</option>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('payment_status')): ?>
                        <div class="invalid-feedback">
                            <?= esc($validation->getError('payment_status')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-success btn-block">Add Sale</button>
            </form>
        </div>
    </div>
</body>

</html>
