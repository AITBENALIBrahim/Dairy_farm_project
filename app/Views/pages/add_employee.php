<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Add New Employee</title>
    <link rel="shortcut icon" href="<?= base_url('images/logo.png') ?>" type="image/png" />
    <style>
        body {
            margin-top: 60px;
        }

        .employee-container {
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

        .employee-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }

        .employee-container h3 {
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
        <div class="employee-container">
            <div class="logo-title-container">
                <img src="<?= base_url('images/logo.png') ?>" alt="Logo" class="employee-logo">
                <h3 class="text-center">Add New Employee</h3>
            </div>

            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger text-center">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('save-employee') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="name">Employee Name</label>
                    <div class="input-group <?= $validation && $validation->hasError('name') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-user"></span>
                        </div>
                        <input type="text" name="name" id="name" class="form-control <?= $validation && $validation->hasError('name') ? 'is-invalid' : '' ?>" value="<?= old('name') ?>" placeholder="Enter employee name">
                    </div>
                    <?php if ($validation && $validation->hasError('name')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('name')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="position">Position</label>
                    <div class="input-group <?= $validation && $validation->hasError('position') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-briefcase"></span>
                        </div>
                        <input type="text" name="position" id="position" class="form-control <?= $validation && $validation->hasError('position') ? 'is-invalid' : '' ?>" value="<?= old('position') ?>" placeholder="Enter position">
                    </div>
                    <?php if ($validation && $validation->hasError('position')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('position')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="salary">Salary</label>
                    <div class="input-group <?= $validation && $validation->hasError('salary') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-dollar-sign"></span>
                        </div>
                        <input type="number" name="salary" id="salary" class="form-control <?= $validation && $validation->hasError('salary') ? 'is-invalid' : '' ?>" value="<?= old('salary') ?>" placeholder="Enter salary">
                    </div>
                    <?php if ($validation && $validation->hasError('salary')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('salary')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="hire_date">Hire Date</label>
                    <div class="input-group <?= $validation && $validation->hasError('hire_date') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-calendar-alt"></span>
                        </div>
                        <input type="date" name="hire_date" id="hire_date" class="form-control <?= $validation && $validation->hasError('hire_date') ? 'is-invalid' : '' ?>" value="<?= old('hire_date') ?>">
                    </div>
                    <?php if ($validation && $validation->hasError('hire_date')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('hire_date')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="fas fa-info-circle"></span>
                        </div>
                        <select name="status" id="status" class="form-control">
                            <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-block">Save Employee</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>