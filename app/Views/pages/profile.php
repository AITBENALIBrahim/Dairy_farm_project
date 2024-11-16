<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Dairy Farm</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .profile-container {
            margin: 0rem auto;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            position: relative;
        }

        .profile-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }

        .profile-photo img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto;
            display: block;
        }

        .btn-edit {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #27ae60;
            color: #fff;
            border: none;
            padding: 0.4rem 0.7rem;
            font-size: 0.9rem;
            border-radius: 0.3rem;
        }

        .btn-edit:hover {
            background-color: #218c52;
            color: #fff;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-control {
            border-radius: 0.3rem;
        }

        .btn-primary,
        .btn-secondary {
            padding: 0.4rem 0.7rem;
            font-size: 0.9rem;
            border-radius: 0.3rem;
        }

        .btn-primary {
            background-color: #27ae60;
            border: none;
        }

        .btn-primary:hover {
            background-color: #218c52;
        }

        .btn-secondary {
            background-color: #bdc3c7;
            border: none;
            margin-left: 0.5rem;
        }

        .btn-secondary:hover {
            background-color: #95a5a6;
        }
    </style>
</head>

<body class="bg-light">
    <div class="profile-container">
        <button type="button" class="btn btn-edit" id="editBtn">
            <i class="fas fa-edit"></i> Edit Profile
        </button>

        <div class="profile-title">User Profile</div>

        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger text-center">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->has('message')): ?>
            <div class="alert alert-success text-center">
                <?= esc(session()->getFlashdata('message')) ?>
            </div>
        <?php endif; ?>

        <div class="profile-photo mb-3">
            <img src="<?= ($user && $user->photo) ? base_url($user->photo) : base_url('images/user.png') ?>" alt="Profile Photo">
        </div>

        <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?= esc($user->username) ?>" readonly>
                    <?php if (isset($validation) && $validation->getError('username')): ?>
                        <div class="text-danger"><?= $validation->getError('username') ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6 form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?= esc($user->email) ?>" readonly>
                    <?php if (isset($validation) && $validation->getError('email')): ?>
                        <div class="text-danger"><?= $validation->getError('email') ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="birth">Birth Date:</label>
                    <input type="date" id="birth" name="birth" class="form-control" value="<?= esc($user->birth) ?>" readonly>
                    <?php if (isset($validation) && $validation->getError('birth')): ?>
                        <div class="text-danger"><?= $validation->getError('birth') ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6 form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" class="form-control" disabled>
                        <option value="male" <?= $user->gender === 'male' ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= $user->gender === 'female' ? 'selected' : '' ?>>Female</option>
                        <option value="other" <?= $user->gender === 'other' ? 'selected' : '' ?>>Other</option>
                    </select>
                    <?php if (isset($validation) && $validation->getError('gender')): ?>
                        <div class="text-danger"><?= $validation->getError('gender') ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="role">Role:</label>
                    <input type="text" id="role" name="role" class="form-control" value="<?= esc($user->role) ?>" readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label for="photo">Profile Photo:</label>
                    <input type="file" id="photo" name="photo" class="form-control-file" disabled>
                    <?php if (isset($validation) && $validation->getError('photo')): ?>
                        <div class="text-danger"><?= $validation->getError('photo') ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary" id="updateBtn" style="display: none;">Update Profile</button>
                <button type="button" class="btn btn-secondary" id="cancelBtn" style="display: none;">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        const editBtn = document.getElementById('editBtn');
        const updateBtn = document.getElementById('updateBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const formInputs = document.querySelectorAll('.form-control');
        const formSelects = document.querySelectorAll('select');
        const fileInput = document.getElementById('photo');

        editBtn.addEventListener('click', () => {
            // Enable input fields except for the "Role" field
            formInputs.forEach(input => {
                if (input.id !== 'role') input.removeAttribute('readonly');
            });
            formSelects.forEach(select => select.removeAttribute('disabled'));
            fileInput.removeAttribute('disabled');

            // Show update and cancel buttons
            updateBtn.style.display = 'inline-block';
            cancelBtn.style.display = 'inline-block';

            // Hide the edit button
            editBtn.style.display = 'none';
        });

        cancelBtn.addEventListener('click', () => {
            // Revert input fields to read-only, keeping "Role" as read-only
            formInputs.forEach(input => input.setAttribute('readonly', true));
            formSelects.forEach(select => select.setAttribute('disabled', true));
            fileInput.setAttribute('disabled', true);

            // Hide update and cancel buttons
            updateBtn.style.display = 'none';
            cancelBtn.style.display = 'none';

            // Show the edit button
            editBtn.style.display = 'inline-block';
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>