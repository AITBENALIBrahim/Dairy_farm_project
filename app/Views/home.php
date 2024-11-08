<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Logo Icon -->
    <link rel="shortcut icon" href="images/logo.png" type="image/png" />

    <title>Dairy Farm Management System</title>

    <!-- Font Awesome for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" crossorigin="anonymous"></script>

    <style>
        /* General Colors */
        body {
            background-color: #f8f9fa;
        }

        .text-green {
            color: #28a745;
        }

        .bg-dark-green {
            background-color: #343a40;
            color: white;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/hero_img.jpeg') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        /* Features, Testimonials, FAQ, and Contact Section Styling */
        .section-title {
            color: #28a745;
            margin-bottom: 40px;
        }

        .testimonial-card,
        .feature-icon {
            color: #28a745;
        }

        .testimonial-card,
        .faq-item {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        /* Footer Styling */
        footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0;
        }

        footer .quick-links a,
        footer .contact-info a {
            color: #28a745;
            text-decoration: none;
        }

        /* Scroll to Top Button */
        #scrollToTop {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 100;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            transition: transform 0.3s ease;
            background-color: #f8f9fa;
        }

        .feature-card:hover .feature-icon {
            transform: rotate(10deg);
            transition: transform 0.3s ease;
        }

        .section-title {
            font-weight: 700;
            text-transform: uppercase;
        }

        .testimonial-card {
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .testimonial-card:hover {
            animation: shake 0.5s;
            animation-iteration-count: 1;
        }

        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }

            75% {
                transform: translateX(-5px);
            }

            100% {
                transform: translateX(0);
            }
        }

        h2 {
            font-weight: 700;
            text-transform: uppercase;
        }

        .stars {
            color: #ffc107;
            font-size: 1.2em;
        }

        .testimonial-card p {
            color: #000;
        }

        .faq-btn {
            transition: background-color 0.3s ease;
            border: none;
            /* Remove outline */
        }

        .faq-btn:hover {
            opacity: 0.9;
            /* Change opacity on hover for effect */
        }

        .dropdown-menu {
            display: none;
            /* Hide dropdown initially */
        }

        .dropdown:hover .dropdown-menu {
            display: block;
            /* Show dropdown on hover */
        }

        h2 {
            font-weight: 700;
            text-transform: uppercase;
        }

        footer {
            background-color: #343a40;
            /* Dark background */
        }

        h5 {
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .quick-links li,
        .contact-info li {
            margin-bottom: 0.5rem;
        }

        .quick-links a,
        .contact-info a {
            color: #ffffff;
            /* White text color */
            transition: color 0.3s ease;
            /* Smooth transition */
        }

        .quick-links a:hover,
        .contact-info a:hover {
            color: #00aced;
            /* Light blue on hover */
        }

        #typing-title {
            font-weight: bold;
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
            display: inline-block;
            animation: typing 3s steps(30, end) forwards;
        }

        @keyframes typing {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        .navbar-nav .nav-link {
            font-weight: 500;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #d4edda;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="images/logo.png" alt="Logo" style="width: 45px; height: 45px; margin-right: 10px;">
                <span id="typing-title" class="text-dark">Green Pastures Dairy Farm</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Hero Section -->
    <div class="hero">
        <div>
            <h1 class="display-4 animate__animated animate__fadeInDown">Empower Your Dairy Farm Operations</h1>
            <p class="lead animate__animated animate__fadeInUp">Streamline management, track production, and monitor herd health—all in one place.</p>
            <div class="hero-buttons">
                <a href="<?= base_url('auth/register') ?>" class="btn btn-success btn-lg animate__animated animate__zoomIn">Get Started</a>
                <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-light btn-lg animate__animated animate__zoomIn">Login</a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="features text-center py-5">
        <div class="container">
            <h2 class="section-title mb-5" style="color: #2c3e50;">Key Features</h2>
            <div class="row">
                <!-- Feature 1: Dashboard -->
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm feature-card" style="background-color: #e3f2fd;">
                        <div class="card-body">
                            <div class="feature-icon mb-3" style="color: #0d6efd;">
                                <i class="fas fa-tachometer-alt fa-3x"></i>
                            </div>
                            <h5 class="card-title">Powerful Dashboard</h5>
                            <p class="card-text">Monitor the entire system, including animal feed charts and real-time updates.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 2: User Management -->
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm feature-card" style="background-color: #e9f7ef;">
                        <div class="card-body">
                            <div class="feature-icon mb-3" style="color: #28a745;">
                                <i class="fas fa-user-shield fa-3x"></i>
                            </div>
                            <h5 class="card-title">User Management</h5>
                            <p class="card-text">Admin can create and assign user roles quickly and easily.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 3: Employee Management -->
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm feature-card" style="background-color: #fff3cd;">
                        <div class="card-body">
                            <div class="feature-icon mb-3" style="color: #ffc107;">
                                <i class="fas fa-users fa-3x"></i>
                            </div>
                            <h5 class="card-title">Employee Management</h5>
                            <p class="card-text">Manage employee records, track salaries, and handle payroll efficiently.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <!-- Feature 4: Milk Collect and Sales Management -->
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm feature-card" style="background-color: #f8d7da;">
                        <div class="card-body">
                            <div class="feature-icon mb-3" style="color: #dc3545;">
                                <i class="fas fa-cow fa-3x"></i>
                            </div>
                            <h5 class="card-title">Milk Collect & Sell Management</h5>
                            <p class="card-text">Easily manage milk collection, sales, and invoicing with due collection tracking.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 5: Animal Feed Chart -->
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm feature-card" style="background-color: #d4edda;">
                        <div class="card-body">
                            <div class="feature-icon mb-3" style="color: #155724;">
                                <i class="fas fa-utensils fa-3x"></i>
                            </div>
                            <h5 class="card-title">Animal Feed Chart</h5>
                            <p class="card-text">Create customized feed charts for cows based on their feeding schedule and time.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 6: Cow Health & Monitoring -->
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm feature-card" style="background-color: #d1ecf1;">
                        <div class="card-body">
                            <div class="feature-icon mb-3" style="color: #17a2b8;">
                                <i class="fas fa-heartbeat fa-3x"></i>
                            </div>
                            <h5 class="card-title">Cow Health Monitoring</h5>
                            <p class="card-text">Track vaccinations, health status, routines, and pregnancy stages of cows.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <!-- Feature 7: Cow Sale & Invoicing -->
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm feature-card" style="background-color: #f8d7da;">
                        <div class="card-body">
                            <div class="feature-icon mb-3" style="color: #dc3545;">
                                <i class="fas fa-cash-register fa-3x"></i>
                            </div>
                            <h5 class="card-title">Cow Sale & Invoicing</h5>
                            <p class="card-text">Handle cow sales with standard invoicing and manage due collections effortlessly.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 8: Expense Management -->
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm feature-card" style="background-color: #e3f2fd;">
                        <div class="card-body">
                            <div class="feature-icon mb-3" style="color: #0d6efd;">
                                <i class="fas fa-dollar-sign fa-3x"></i>
                            </div>
                            <h5 class="card-title">Expense Management</h5>
                            <p class="card-text">Store and manage all office and operational expenses, categorized by purpose.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 9: Supplier Management -->
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm feature-card" style="background-color: #e9f7ef;">
                        <div class="card-body">
                            <div class="feature-icon mb-3" style="color: #28a745;">
                                <i class="fas fa-truck fa-3x"></i>
                            </div>
                            <h5 class="card-title">Supplier Management</h5>
                            <p class="card-text">Manage suppliers for farm feed, medicines, and other supplies efficiently.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials text-center py-5">
        <div class="container">
            <h2 class="mb-5" style="color: #2c3e50;">What Our Users Say</h2>
            <div class="row row-cols-1 row-cols-md-3">
                <div class="col mb-4">
                    <div class="card border-0 shadow-sm p-4 rounded testimonial-card" style="background-color: #e3f2fd;">
                        <p class="card-text" style="color: #000;">"This system has transformed our dairy farm's efficiency. Tracking everything in one place has been a game-changer!"</p>
                        <div class="stars mb-2">
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                        </div>
                        <strong style="color: #555;">— Sarah, Farm Owner</strong>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="card border-0 shadow-sm p-4 rounded testimonial-card" style="background-color: #e9f7ef;">
                        <p class="card-text" style="color: #000;">"I love the milk collection feature! It makes managing sales and storage so much easier."</p>
                        <div class="stars mb-2">
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9734;</span>
                        </div>
                        <strong style="color: #555;">— David, Dairy Manager</strong>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="card border-0 shadow-sm p-4 rounded testimonial-card" style="background-color: #fff3cd;">
                        <p class="card-text" style="color: #000;">"Highly recommend! The cow health tracking feature is super useful for large farms."</p>
                        <div class="stars mb-2">
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9734;</span>
                        </div>
                        <strong style="color: #555;">— Emily, Veterinarian</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FAQ Section -->
    <section id="faq" class="faq text-center pb-5 bg-light">
        <div class="container">
            <h2 class="mb-5" style="color: #2c3e50;">Frequently Asked Questions</h2>
            <div class="row row-cols-1 row-cols-md-2">
                <!-- Question 1 -->
                <div class="col mb-4">
                    <div class="dropdown">
                        <button class="btn w-100 faq-btn bg-primary text-white" type="button" id="faq1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            How does the cow management feature work?
                        </button>
                        <div class="dropdown-menu p-3 w-100" aria-labelledby="faq1">
                            <p class="text-dark">You can record and track each cow's health status, vaccinations, and breeding cycles.</p>
                        </div>
                    </div>
                </div>
                <!-- Question 2 -->
                <div class="col mb-4">
                    <div class="dropdown">
                        <button class="btn w-100 faq-btn bg-success text-white" type="button" id="faq2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Is the software suitable for large farms?
                        </button>
                        <div class="dropdown-menu p-3 w-100" aria-labelledby="faq2">
                            <p class="text-dark">Yes! Our system is designed to scale with your farm's needs.</p>
                        </div>
                    </div>
                </div>
                <!-- Question 3 -->
                <div class="col mb-4">
                    <div class="dropdown">
                        <button class="btn w-100 faq-btn bg-info text-white" type="button" id="faq3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Can I track the milk production per cow?
                        </button>
                        <div class="dropdown-menu p-3 w-100" aria-labelledby="faq3">
                            <p class="text-dark">Yes, you can track daily milk yields for each cow, providing valuable insights into production trends.</p>
                        </div>
                    </div>
                </div>
                <!-- Question 4 -->
                <div class="col mb-4">
                    <div class="dropdown">
                        <button class="btn w-100 faq-btn bg-warning text-white" type="button" id="faq4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            How secure is the data in the system?
                        </button>
                        <div class="dropdown-menu p-3 w-100" aria-labelledby="faq4">
                            <p class="text-dark">Our system uses industry-standard encryption to ensure your data is secure and protected.</p>
                        </div>
                    </div>
                </div>
                <!-- Question 5 -->
                <div class="col mb-4">
                    <div class="dropdown">
                        <button class="btn w-100 faq-btn bg-danger text-white" type="button" id="faq5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Can I generate reports?
                        </button>
                        <div class="dropdown-menu p-3 w-100" aria-labelledby="faq5">
                            <p class="text-dark">Yes, the system allows you to generate various reports, including production, sales, and health records.</p>
                        </div>
                    </div>
                </div>
                <!-- Question 6 -->
                <div class="col mb-4">
                    <div class="dropdown">
                        <button class="btn w-100 faq-btn bg-secondary text-white" type="button" id="faq6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Does the system support multiple users?
                        </button>
                        <div class="dropdown-menu p-3 w-100" aria-labelledby="faq6">
                            <p class="text-dark">Yes, it supports multiple user roles with varying levels of access and permissions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-success text-white py-4">
        <div class="container">
            <div class="row">
                <!-- About Us Column -->
                <div class="col-md-6 mb-4">
                    <img src="images/logo.png" alt="Dairy Farm Logo" class="img-fluid mb-3" style="max-height: 70px;">
                    <h5 class="text-light">About Us</h5>
                    <p>We are dedicated to providing innovative solutions to make dairy farm management easier and more efficient.</p>
                </div>
                <!-- Quick Links Column -->
                <div class="col-md-3 mb-4">
                    <h5 class="text-light">Quick Links</h5>
                    <ul class="list-unstyled quick-links">
                        <li><a class="text-white" href="#features">Features</a></li>
                        <li><a class="text-white" href="#testimonials">Testimonials</a></li>
                        <li><a class="text-white" href="#faq">FAQ</a></li>
                    </ul>
                </div>
                <!-- Contact Info Column -->
                <div class="col-md-3 mb-4">
                    <h5 class="text-light">Contact Info</h5>
                    <ul class="list-unstyled contact-info">
                        <li>Email: <a class="text-white" href="mailto:info@dairyfarm.com">info@dairyfarm.com</a></li>
                        <li>Phone: +1 234 567 890</li>
                        <li>Address: 123 Dairy Street, Farmville</li>
                    </ul>
                </div>
            </div>
            <hr class="bg-light">
            <p class="text-center">&copy; 2024 Green Pastures Dairy Farm. All Rights Reserved.</p>
        </div>
    </footer>


    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="btn btn-success" onclick="scrollToTop()">↑</button>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script>
        // Show scroll to top button
        window.onscroll = function() {
            const button = document.getElementById('scrollToTop');
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                button.style.display = 'block';
            } else {
                button.style.display = 'none';
            }
        };

        // Scroll to top function
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
</body>

</html>