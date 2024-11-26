<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Edit Supplier</title>
    <link rel="shortcut icon" href="<?= base_url('images/logo.png') ?>" type="image/png" />
    <style>
        body {
            margin-top: 50px;
        }

        .supplier-container {
            max-width: 700px;
            width: 500px;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: fadeIn 1s ease-in-out;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        .logo-title-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .supplier-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }

        .supplier-container h3 {
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
        <div class="supplier-container">
            <div class="logo-title-container">
                <img src="<?= base_url('images/logo.png') ?>" alt="Logo" class="supplier-logo">
                <h3 class="text-center">Edit Supplier</h3>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger text-center"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- Edit Supplier Form -->
            <form action="<?= base_url('update-supplier/' . $supplier['id']) ?>" method="POST">
                <?= csrf_field() ?>

                <!-- Name Field -->
                <div class="form-group">
                    <label for="name" class="d-block text-left">Name</label>
                    <div class="input-group <?= session('validation') && session('validation')->hasError('name') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-user"></span>
                        </div>
                        <input type="text" name="name" id="name" class="form-control <?= session('validation') && session('validation')->hasError('name') ? 'is-invalid' : '' ?>" value="<?= old('name', $supplier['name']) ?>" placeholder="Enter supplier name">
                    </div>
                    <?php if (session('validation') && session('validation')->hasError('name')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc(session('validation')->getError('name')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Contact Number Field -->
                <div class="form-group">
                    <label for="contact_number" class="d-block text-left">Contact Number</label>
                    <div class="input-group <?= session('validation') && session('validation')->hasError('contact_number') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-phone"></span>
                        </div>
                        <input type="text" name="contact_number" id="contact_number" class="form-control <?= session('validation') && session('validation')->hasError('contact_number') ? 'is-invalid' : '' ?>" value="<?= old('contact_number', $supplier['contact_number']) ?>" placeholder="Enter contact number">
                    </div>
                    <?php if (session('validation') && session('validation')->hasError('contact_number')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc(session('validation')->getError('contact_number')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Address Field -->
                <div class="form-group">
                    <label for="address" class="d-block text-left">Address</label>
                    <div class="input-group <?= session('validation') && session('validation')->hasError('address') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-map-marker-alt"></span>
                        </div>
                        <textarea name="address" id="address" class="form-control <?= session('validation') && session('validation')->hasError('address') ? 'is-invalid' : '' ?>" placeholder="Enter supplier address"><?= old('address', $supplier['address']) ?></textarea>
                    </div>
                    <?php if (session('validation') && session('validation')->hasError('address')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc(session('validation')->getError('address')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Supplied Items Field -->
                <div class="form-group">
                    <label for="supplied_items" class="d-block text-left">Supplied Items</label>
                    <div class="input-group <?= session('validation') && session('validation')->hasError('supplied_items') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-box"></span>
                        </div>
                        <textarea name="supplied_items" id="supplied_items" class="form-control <?= session('validation') && session('validation')->hasError('supplied_items') ? 'is-invalid' : '' ?>" placeholder="Enter supplied items"><?= old('supplied_items', $supplier['supplied_items']) ?></textarea>
                    </div>
                    <?php if (session('validation') && session('validation')->hasError('supplied_items')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc(session('validation')->getError('supplied_items')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-success btn-block">Update Supplier</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
