<!-- app/Views/add_cow.php -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Add New Cow</title>
    <link rel="shortcut icon" href="<?= base_url('images/logo.png') ?>" type="image/png" />
    <style>
        /* Body margin adjustment */
        body {
            margin-top: 10px;
        }

        .cow-container {
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

        .cow-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }

        .cow-container h3 {
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
        <div class="cow-container">
            <div class="logo-title-container">
                <img src="<?= base_url('images/logo.png') ?>" alt="Logo" class="cow-logo">
                <h3 class="text-center">Add New Cow</h3>
            </div>

            <!-- Flash Message for Errors -->
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger text-center">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <!-- Add Cow Form -->
            <form action="<?= base_url('save-cow') ?>" method="POST">
                <?= csrf_field() ?>

                <!-- Tag Number Field -->
                <div class="form-group">
                    <label for="tag_number" class="d-block text-left">Tag Number</label>
                    <div class="input-group <?= $validation && $validation->hasError('tag_number') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-id-badge"></span>
                        </div>
                        <input autocomplete="off" type="text" name="tag_number" id="tag_number" class="form-control <?= $validation && $validation->hasError('tag_number') ? 'is-invalid' : '' ?>" value="<?= old('tag_number') ?>" placeholder="Enter tag number">
                    </div>
                    <?php if ($validation && $validation->hasError('tag_number')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('tag_number')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Date of Birth Field -->
                <div class="form-group">
                    <label for="date_of_birth" class="d-block text-left">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control <?= $validation && $validation->hasError('date_of_birth') ? 'is-invalid' : '' ?>" value="<?= old('date_of_birth') ?>" />
                    <?php if ($validation && $validation->hasError('date_of_birth')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('date_of_birth')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Health Status Field -->
                <div class="form-group">
                    <label for="health_status" class="d-block text-left">Health Status</label>
                    <div class="input-group <?= $validation && $validation->hasError('health_status') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-heartbeat"></span>
                        </div>
                        <input autocomplete="off" type="text" name="health_status" id="health_status" class="form-control <?= $validation && $validation->hasError('health_status') ? 'is-invalid' : '' ?>" value="<?= old('health_status') ?>" placeholder="Enter health status">
                    </div>
                    <?php if ($validation && $validation->hasError('health_status')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('health_status')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Stall ID Field -->
                <div class="form-group">
    <label for="stall_id" class="d-block text-left">Stall</label>
    <select name="stall_id" id="stall_id" class="form-control <?= $validation && $validation->hasError('stall_id') ? 'is-invalid' : '' ?>">
        <option value="">Select a Stall</option>
        <?php foreach ($stalls as $stall): ?>
            <option value="<?= $stall['id'] ?>" <?= old('stall_id') == $stall['id'] ? 'selected' : '' ?>>
                <?= esc($stall['stall_name']) ?>  <!-- Assuming 'stall_name' is the column for stall names -->
            </option>
        <?php endforeach; ?>
    </select>
    <?php if ($validation && $validation->hasError('stall_id')): ?>
        <div class="invalid-feedback text-left">
            <?= esc($validation->getError('stall_id')) ?>
        </div>
    <?php endif; ?>
</div>


                <!-- Sale Status Field -->
                <div class="form-group">
                    <label for="sale_status" class="d-block text-left">Sale Status</label>
                    <input autocomplete="off" type="text" name="sale_status" id="sale_status" class="form-control <?= $validation && $validation->hasError('sale_status') ? 'is-invalid' : '' ?>" value="<?= old('sale_status') ?>" placeholder="Enter sale status">
                    <?php if ($validation && $validation->hasError('sale_status')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('sale_status')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-success btn-block">Save Cow</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
