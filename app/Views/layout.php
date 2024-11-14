<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Layout with User Tooltip</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="shortcut icon" href="<?= base_url('images/logo.png') ?>" type="image/png" />
    <style>
        html,
        body {
            height: 100vh;
            overflow: hidden;
            /* Prevents body scrolling */
            margin: 0;
            padding: 0;
        }

        /* Sidebar styling */
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            height: 100vh;
            background-color: #2c3e50;
            padding: 1.5rem;
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: min-width 0.2s ease;
            /* Smooth transition for sliding */
        }

        /* Sidebar hidden by default on small screens */
        .sidebar.hidden {
            min-width: 0px;
            padding: 0px;
            width: 0px;
            /* Hide sidebar off-screen */
        }

        /* Brand styling */
        .brand {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .brand img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 1rem;
        }

        .brand-name {
            color: #fff;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .sidebar .nav-top {
            flex-grow: 1;
        }

        .sidebar a {
            color: #ffffff;
            display: block;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 10px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #27ae60;
        }

        /* Content area */
        .content-area {
            flex: 1;
            padding: 2rem;
            background-color: #f8f9fa;
            transition: margin-left 0.3s ease;
            /* Smooth transition for content shift */
            overflow-y: auto;
            height: calc(100vh - 50px);
        }

        /* Topbar styling */
        .topbar {
            height: 50px;
            background-color: #27ae60;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 0 30px;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            justify-content: space-between;
            transition: margin-left 0.3s ease;
        }

        /* User image styling */
        .user-photo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #fff;
            overflow: hidden;
            cursor: pointer;
            padding: 2px;
        }

        .user-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Tooltip content */
        .popover {
            border-radius: 8px;
        }

        .popover-body a {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            color: #2c3e50;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .popover-body a:hover {
            background-color: #f1f1f1;
        }

        .popover-body i {
            margin-right: 10px;
        }

        /* Media Queries for responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                min-width: 200px;
                max-width: 200px;
                padding: 1rem;
            }

            .brand img {
                width: 40px;
                height: 40px;
            }

            .brand-name {
                font-size: 1rem;
            }

            .topbar {
                padding: 0 20px;
                font-size: 1rem;
            }

            .content-area {
                padding: 1rem;
                margin-left: 0;
                height: calc(100vh - 50px);
            }

            .sidebar.hidden+.content-area {
                margin-left: 0;
                /* Adjust content area when sidebar is hidden */
            }

            .toggle-sidebar {
                display: block;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                min-width: 90px;
                max-width: 90px;
            }

            .sidebar .nav-top span {
                font-size: 0px;
                width: 0px;
                height: 0px;
                padding: 0px;
                margin: 0px;
            }

            .sidebar .stg span {
                font-size: 0px;
                width: 0px;
                height: 0px;
                padding: 0px;
                margin: 0px;
            }

            .sidebar .nav-top a {
                width: 50px;
                height: 40px;
                padding: 0px;
                text-align: center;
            }

            .sidebar .stg {
                width: 50px;
                height: 40px;
                padding: 0px;
                text-align: center;
            }

            .brand img {
                width: 35px;
                height: 35px;
            }

            .brand-name {
                font-size: 0rem;
            }

            .topbar {
                padding: 0 15px;
                font-size: 0.9rem;
            }

            .content-area {
                padding: 0.5rem;
            }

            .sidebar.hidden+.content-area {
                margin-left: 0;
                /* Adjust content area when sidebar is hidden */
            }

            .sidebar.hidden {
                min-width: 0px;
                padding: 0px;
                width: 0px;
            }

            .toggle-sidebar {
                display: block;
            }
        }

        /* Disable blue color and text-decoration for all links */
        .sidebar a,
        .topbar a,
        .popover-body a {
            text-decoration: none;
            /* Remove text decoration */
        }

        /* Ensure the links don't change color on hover/focus/active */
        .sidebar a:hover,
        .sidebar a.active,
        .topbar a:hover,
        .topbar a:active {
            color: #ffffff;
            text-decoration: none;
            /* Prevent the color from changing */
        }
        .popover-body a:hover {
            text-decoration: none;
            color: #2c3e50;
        }
    </style>
</head>

<body class="bg-light">

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar hidden" id="sidebar">
            <!-- Brand section -->
            <div class="brand">
                <img src="<?= base_url('images/logo.png') ?>" alt="Dairy Farm Logo">
                <span class="brand-name">Dairy Farm</span>
            </div>

            <div class="nav-top">
                <a href="<?= base_url('/dashboard') ?>" class="<?= isActive('/dashboard') ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
                <a href="<?= base_url('/manage-users') ?>" class="<?= isActive('/manage-users') ?>"><i class="fas fa-user"></i> <span>Assistants</span></a>
                <!-- Additional links can be added here if needed -->
            </div>

            <!-- Settings Link at the Bottom -->
            <a href="<?= base_url('/settings') ?>" class="stg <?= isActive('/settings') ?>"><i class="fas fa-cog"></i> <span>Settings</span></a>
        </div>

        <!-- Main Content Area -->
        <div class="w-100">
            <!-- Topbar -->
            <div class="topbar" id="topbar">
                <!-- Toggle Button for Sidebar -->
                <button class="btn btn-sm btn-light toggle-sidebar" id="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>

                <div data-toggle="popover" data-placement="bottom" data-html="true" style="cursor: pointer;"
                    data-content="
                    <a href='#'><i class='fas fa-drumstick-bite'></i> Cow</a>
                    <a href='#'><i class='fas fa-baby-carriage'></i> Calf</a>
                    <a href='#'><i class='fas fa-glass-whiskey'></i> Milk</a>
                    <a href='#'><i class='fas fa-exchange-alt'></i> Transaction</a>
                    <a href='#'><i class='fas fa-tag'></i> Sale</a>
                 ">
                    <h4><i class="fas fa-plus-circle"></i> Add <i class="fas fa-caret-down"></i></h4>
                </div>

                <!-- User Photo with Tooltip -->
                <div class="user-photo" data-toggle="popover" data-placement="bottom" data-html="true"
                    data-content=" 
                    <a href='<?= base_url('/profile') ?>'><i class='fas fa-user'></i> Profile</a>
                    <a href='<?= base_url('/auth/logout') ?>'><i class='fas fa-sign-out-alt'></i> Logout</a>
                 ">
                    <img src="<?= $user->photo ? base_url($user->photo) : base_url('images/user.png') ?>" alt="User Photo">
                </div>
            </div>

            <!-- Center Content Area -->
            <div class="content-area">
                <div class="content">
                    <?= $content ?? '<p>Welcome! Select an option from the sidebar.</p>' ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize popover
            $('[data-toggle="popover"]').popover();

            // Toggle sidebar visibility
            $('#sidebar-toggle').click(function() {
                $('#sidebar').toggleClass('hidden');
                $('.content-area').toggleClass('shifted');
            });
        });
    </script>

</body>

</html>