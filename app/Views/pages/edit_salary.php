<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Edit Salary</title>
    <link rel="shortcut icon" href="<?= base_url('images/logo.png') ?>" type="image/png" />
    <style>
        body {
            margin-top: 60px;
        }

        .salary-container {
            max-width: 700px;
            width: 500px;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: fadeIn 1s ease-in-out;
            margin-top: 70px;
            margin-bottom: 30px;
        }

        .logo-title-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .salary-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }

        .salary-container h3 {
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
        <div class="salary-container">
            <div class="logo-title-container">
                <img src="<?= base_url('images/logo.png') ?>" alt="Logo" class="salary-logo">
                <h3 class="text-center">Edit Salary</h3>
            </div>

            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger text-center">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('update-salary/' . $salary['id']) ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="employee_id">Select Employee</label>
                    <div class="input-group <?= $validation && $validation->hasError('employee_id') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-user-tie"></span>
                        </div>
                        <select name="employee_id" id="employee_id" class="form-control <?= $validation && $validation->hasError('employee_id') ? 'is-invalid' : '' ?>">
                            <option value="">Select an employee</option>
                            <?php foreach ($employees as $employee): ?>
                                <option value="<?= $employee['id'] ?>" <?= $employee['id'] == old('employee_id', $salary['employee_id']) ? 'selected' : '' ?>>
                                    <?= esc($employee['name'] . ' (' . $employee['id'] . ')') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php if ($validation && $validation->hasError('employee_id')): ?>
                        <div class="invalid-feedback"><?= esc($validation->getError('employee_id')) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="amount_paid">Amount Paid</label>
                    <div class="input-group <?= $validation && $validation->hasError('amount_paid') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-money-bill-wave"></span>
                        </div>
                        <input type="number" name="amount_paid" id="amount_paid" class="form-control <?= $validation && $validation->hasError('amount_paid') ? 'is-invalid' : '' ?>" value="<?= old('amount_paid', $salary['amount_paid']) ?>" placeholder="Enter amount paid">
                    </div>
                    <?php if ($validation && $validation->hasError('amount_paid')): ?>
                        <div class="invalid-feedback"><?= esc($validation->getError('amount_paid')) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="payment_date">Payment Date</label>
                    <div class="input-group <?= $validation && $validation->hasError('payment_date') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-calendar-day"></span>
                        </div>
                        <input type="date" name="payment_date" id="payment_date" class="form-control <?= $validation && $validation->hasError('payment_date') ? 'is-invalid' : '' ?>" value="<?= old('payment_date', $salary['payment_date']) ?>">
                    </div>
                    <?php if ($validation && $validation->hasError('payment_date')): ?>
                        <div class="invalid-feedback"><?= esc($validation->getError('payment_date')) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <div class="input-group <?= $validation && $validation->hasError('payment_method') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-credit-card"></span>
                        </div>
                        <input type="text" name="payment_method" id="payment_method" class="form-control <?= $validation && $validation->hasError('payment_method') ? 'is-invalid' : '' ?>" value="<?= old('payment_method', $salary['payment_method']) ?>" placeholder="Enter payment method">
                    </div>
                    <?php if ($validation && $validation->hasError('payment_method')): ?>
                        <div class="invalid-feedback"><?= esc($validation->getError('payment_method')) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="note">Note</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="fas fa-comment-dots"></span>
                        </div>
                        <textarea name="note" id="note" class="form-control" placeholder="Optional note"><?= old('note', $salary['note']) ?></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-block">Save Changes</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>