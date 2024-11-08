<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Registration</title>
    <link rel="shortcut icon" href="<?= base_url('images/logo.png') ?>" type="image/png" />
    <style>
        /* Body margin adjustment */
        body {
            margin-top: 50px; /* Adjust this as needed */
        }

        .login-container {
            max-width: 700px;
            width: 500px;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: fadeIn 1s ease-in-out;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .logo-title-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }

        .login-container h3 {
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

        .login-title {
            font-weight: 700;
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
        <div class="login-container">
            <div class="logo-title-container">
                <img src="<?= base_url('images/logo.png') ?>" alt="Logo" class="login-logo">
                <h3 class="login-title">Registration</h3>
            </div>

            <!-- Registration Form -->
            <form action="<?= base_url('auth/register') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email" class="d-block text-left">Email</label>
                    <div class="input-group <?= $validation && $validation->hasError('email') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-envelope"></span>
                        </div>
                        <input autocomplete="off" type="text" name="email" id="email" class="form-control <?= $validation && $validation->hasError('email') ? 'is-invalid' : '' ?>" value="<?= old('email') ?>">
                    </div>
                    <?php if ($validation && $validation->hasError('email')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('email')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="username" class="d-block text-left">Username</label>
                    <div class="input-group <?= $validation && $validation->hasError('username') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-user"></span>
                        </div>
                        <input autocomplete="off" type="text" name="username" id="username" class="form-control <?= $validation && $validation->hasError('username') ? 'is-invalid' : '' ?>" value="<?= old('username') ?>">
                    </div>
                    <?php if ($validation && $validation->hasError('username')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('username')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password" class="d-block text-left">Password</label>
                    <div class="input-group <?= $validation && $validation->hasError('password') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-lock"></span>
                        </div>
                        <input type="password" name="password" id="password" class="form-control <?= $validation && $validation->hasError('password') ? 'is-invalid' : '' ?>">
                    </div>
                    <?php if ($validation && $validation->hasError('password')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('password')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="cpassword" class="d-block text-left">Confirm Password</label>
                    <div class="input-group <?= $validation && $validation->hasError('cpassword') ? 'is-invalid' : '' ?>">
                        <div class="input-group-prepend">
                            <span class="fas fa-lock"></span>
                        </div>
                        <input type="password" name="cpassword" id="cpassword" class="form-control <?= $validation && $validation->hasError('cpassword') ? 'is-invalid' : '' ?>">
                    </div>
                    <?php if ($validation && $validation->hasError('cpassword')): ?>
                        <div class="invalid-feedback text-left">
                            <?= esc($validation->getError('cpassword')) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="text-left mb-3">
                    Already have an account? <a href="<?= base_url('auth/login') ?>">Sign In now</a>
                </div>

                <button type="submit" class="btn btn-success btn-block">Sign Up</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
