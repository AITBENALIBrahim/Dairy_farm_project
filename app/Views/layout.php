<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            overflow-y: auto;
            flex-grow: 1;
            scrollbar-width: none;
            margin-bottom: 10px;
        }

        .sidebar .nav-top::-webkit-scrollbar {
            display: none;
        }

        .sidebar a {
            color: #ffffff;
            display: block;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 7px;
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

        .nav-item {
            overflow: hidden;
            height: 50px;
            cursor: pointer;
            /* or your desired initial height */
            transition: height 1s ease;
        }

        .nav-item.open {
            height: auto;
            /* or a value that accommodates your dropdown content */
        }

        .menu-items a {
            font-weight: 600;
            font-size: small;
        }

        .menu-items a span {
            padding: 0px 15px;
        }

        .menu-head {
            position: relative;
        }

        /* Style for the toggle icon */
        .menu-head .toggle-icon {
            position: absolute;
            top: 16px;
            right: 10px;
            transition: transform 0.3s ease;
        }

        /* Rotate the toggle icon when the menu is open */
        .nav-item.open .menu-head .toggle-icon {
            transform: rotate(180deg);
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
                <!-- Dashboard Link -->
                <a href="<?= base_url('/dashboard') ?>" class="<?= isActive('/dashboard') ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>

                <!-- Employee Management with arrow control -->
                <div class="nav-item">
                    <a class="menu-head"><i class="fas fa-users"></i> <span>Employee</span><i class="fas fa-chevron-down toggle-icon"></i></a>
                    <div class="menu-items">
                        <a href="<?= base_url('/employee') ?>" class="<?= isActive('/employee') ?>"><span>Employee list</span></a>
                        <a href="<?= base_url('/salaries') ?>" class="<?= isActive('/salaries') ?>"><span>Employee salaries</span></a>
                    </div>
                </div>

                <!-- Milk Management with arrow control -->
                <div class="nav-item">
                    <a class="menu-head"><i class="fas fa-wine-bottle"></i> <span>Milk</span><i class="fas fa-chevron-down toggle-icon"></i></a>
                    <div class="menu-items">
                        <a href="<?= base_url('/milk-collection') ?>" class="<?= isActive('/milk-collection') ?>"><span>Milk collection</span></a>
                        <a href="<?= base_url('/milk-sales') ?>" class="<?= isActive('/milk-sales') ?>"><span>Milk sales</span></a>
                    </div>
                </div>

                <!-- Animal Management with arrow control -->
                <div class="nav-item">
                    <a class="menu-head"><i class="fas fa-paw"></i> <span>Animal</span><i class="fas fa-chevron-down toggle-icon"></i></a>
                    <div class="menu-items">
                        <a href="<?= base_url('/cow') ?>" class="<?= isActive('/cow') ?>"><span>Cow</span></a>
                        <a href="<?= base_url('/calf') ?>" class="<?= isActive('/calf') ?>"><span>Calf</span></a>
                        <a href="<?= base_url('/stalls') ?>" class="<?= isActive('/stalls') ?>"><span>Stalls</span></a>
                    </div>
                </div>

                <!-- Health Management with arrow control -->
                <div class="nav-item">
                    <a class="menu-head"><i class="fas fa-heartbeat"></i> <span>Health</span><i class="fas fa-chevron-down toggle-icon"></i></a>
                    <div class="menu-items">
                        <a href="<?= base_url('/animal-vaccinations') ?>" class="<?= isActive('/animal-vaccinations') ?>"><span>Animal Vaccinations</span></a>
                        <a href="<?= base_url('/pregnancy-records') ?>" class="<?= isActive('/pregnancy-records') ?>"><span>Pregnancy Records</span></a>
                    </div>
                </div>

                <!-- Additional Links -->
                <a href="<?= base_url('/feed-chart') ?>" class="<?= isActive('/feed-chart') ?>"><i class="fas fa-chart-pie"></i> <span>Feed Chart</span></a>
                <a href="<?= base_url('/sales') ?>" class="<?= isActive('/sales') ?>"><i class="fas fa-shopping-cart"></i> <span>Sales</span></a>
                <a href="<?= base_url('/expenses') ?>" class="<?= isActive('/expenses') ?>"><i class="fas fa-file-invoice-dollar"></i> <span>Expenses</span></a>
                <a href="<?= base_url('/suppliers') ?>" class="<?= isActive('/suppliers') ?>"><i class="fas fa-truck"></i> <span>Suppliers</span></a>
                <a href="<?= base_url('/animal-routines') ?>" class="<?= isActive('/animal-routines') ?>"><i class="fas fa-sync-alt"></i> <span>Animal Routines</span></a>

                <!-- Assistants Link -->
                <a href="<?= base_url('/manage-users') ?>" class="<?= isActive('/manage-users') ?>"><i class="fas fa-users-cog"></i> <span>Assistants</span></a>
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

        document.querySelectorAll('.nav-item').forEach(item => {
            item.querySelector('.menu-head').addEventListener('click', function() {
                const parentItem = this.closest('.nav-item');

                // Toggle the 'open' class for height transition
                parentItem.classList.toggle('open');
            });
        });
    </script>

</body>

</html>