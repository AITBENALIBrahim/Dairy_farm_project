<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Add New Expense</title>
    <link rel="shortcut icon" href="<?= base_url('images/logo.png') ?>" type="image/png" />
    <style>
        body {
            margin-top: 20px;
        }

        .expense-container {
            max-width: 700px;
            width: 500px;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: fadeIn 1s ease-in-out;
            margin-top: 90px;
            margin-bottom: 30px;
        }

        .logo-title-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .expense-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }

        .expense-container h3 {
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .form-group label {
            font-weight: 600;
            color: #2c3e50;
        }

        .input-group .form-control {
            padding-left: 40px;
        }

        .input-group .input-group-prepend {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2rem;
            color: #27ae60;
            z-index: 10;
        }

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

        .invalid-feedback {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="d-flex align-items-center bg-light" style="height: 100vh;">
    <div class="container d-flex justify-content-center">
        <div class="expense-container">
            <div class="logo-title-container">
                <img src="<?= base_url('images/logo.png') ?>" alt="Logo" class="expense-logo">
                <h3 class="text-center">Add New Expense</h3>
            </div>

            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger text-center">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <!-- Add Expense Form -->
            <form action="<?= base_url('save-expense') ?>" method="POST">
                <?= csrf_field() ?>

                <!-- Expense Type -->
                <div class="form-group">
                    <label for="expense_type">Expense Type</label>
                    <div class="input-group <?= $validation && $validation->hasError('expense_type') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-dollar-sign"></span>
                        </div>
                        <input type="text" name="expense_type" id="expense_type" class="form-control <?= $validation && $validation->hasError('expense_type') ? 'is-invalid' : '' ?>" value="<?= old('expense_type') ?>" placeholder="Enter expense type">
                    </div>
                    <?php if ($validation && $validation->hasError('expense_type')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('expense_type')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Expense Date -->
                <div class="form-group">
                    <label for="expense_date">Expense Date</label>
                    <div class="input-group <?= $validation && $validation->hasError('expense_date') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-calendar-alt"></span>
                        </div>
                        <input type="date" name="expense_date" id="expense_date" class="form-control <?= $validation && $validation->hasError('expense_date') ? 'is-invalid' : '' ?>" value="<?= old('expense_date') ?>">
                    </div>
                    <?php if ($validation && $validation->hasError('expense_date')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('expense_date')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Amount -->
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <div class="input-group <?= $validation && $validation->hasError('amount') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-money-bill-wave"></span>
                        </div>
                        <input type="number" step="0.01" name="amount" id="amount" class="form-control <?= $validation && $validation->hasError('amount') ? 'is-invalid' : '' ?>" value="<?= old('amount') ?>" placeholder="Enter amount">
                    </div>
                    <?php if ($validation && $validation->hasError('amount')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('amount')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <div class="input-group <?= $validation && $validation->hasError('description') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-comment"></span>
                        </div>
                        <textarea name="description" id="description" class="form-control <?= $validation && $validation->hasError('description') ? 'is-invalid' : '' ?>" placeholder="Enter expense description"><?= old('description') ?></textarea>
                    </div>
                    <?php if ($validation && $validation->hasError('description')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('description')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-success btn-block">Save Expense</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>