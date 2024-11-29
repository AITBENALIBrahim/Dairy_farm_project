<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Add New Feed</title>
    <link rel="shortcut icon" href="<?= base_url('images/logo.png') ?>" type="image/png" />
    <style>
        /* Body margin adjustment */
        body {
            margin-top: 10px;
        }

        .feed-container {
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

        .feed-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }

        .feed-container h3 {
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
        <div class="feed-container">
            <div class="logo-title-container">
                <img src="<?= base_url('images/logo.png') ?>" alt="Logo" class="feed-logo">
                <h3 class="text-center">Add New Feed</h3>
            </div>

            <!-- Flash Message for Errors -->
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger text-center">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <!-- Add Feed Form -->
            <form action="<?= base_url('add-feed') ?>" method="POST">
                <?= csrf_field() ?>

                <!-- Cow Selection -->
                <div class="form-group">
                    <label for="cow_id" class="d-block text-left">Cow</label>
                    <select name="cow_id" id="cow_id" class="form-control <?= $validation && $validation->hasError('cow_id') ? 'is-invalid' : '' ?>" required>
                        <option value="">Select Cow</option>
                        <?php foreach ($cows as $cow): ?>
                            <option value="<?= $cow['id'] ?>"><?= $cow['tag_number'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($validation && $validation->hasError('cow_id')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('cow_id')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Feed Time Field -->
                <div class="form-group">
                    <label for="feed_time" class="d-block text-left">Feed Time</label>
                    <input type="time" name="feed_time" id="feed_time" class="form-control <?= $validation && $validation->hasError('feed_time') ? 'is-invalid' : '' ?>" required>
                    <?php if ($validation && $validation->hasError('feed_time')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('feed_time')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Feed Type Field -->
                <div class="form-group">
                    <label for="feed_type" class="d-block text-left">Feed Type</label>
                    <input type="text" name="feed_type" id="feed_type" class="form-control <?= $validation && $validation->hasError('feed_type') ? 'is-invalid' : '' ?>" required>
                    <?php if ($validation && $validation->hasError('feed_type')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('feed_type')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Quantity Field -->
                <div class="form-group">
                    <label for="quantity" class="d-block text-left">Quantity (kg)</label>
                    <input type="number" name="quantity" id="quantity" class="form-control <?= $validation && $validation->hasError('quantity') ? 'is-invalid' : '' ?>" required>
                    <?php if ($validation && $validation->hasError('quantity')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('quantity')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Date Field -->
                <div class="form-group">
                    <label for="date" class="d-block text-left">Date</label>
                    <input type="date" name="date" id="date" class="form-control <?= $validation && $validation->hasError('date') ? 'is-invalid' : '' ?>" required>
                    <?php if ($validation && $validation->hasError('date')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('date')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Employee ID Field -->
                <div class="form-group">
                    <label for="employee_id" class="d-block text-left">Employee ID</label>
                    <input type="number" name="employee_id" id="employee_id" class="form-control <?= $validation && $validation->hasError('employee_id') ? 'is-invalid' : '' ?>" required>
                    <?php if ($validation && $validation->hasError('employee_id')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('employee_id')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-success btn-block">Add Feed</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
