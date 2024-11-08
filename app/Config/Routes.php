<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Routing\RouteCollection;
use Config\Services;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so we can override it later if needed
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// Define your custom routes here
$routes->get('/', 'Home::index'); // Home page

// Authentication routes
$routes->match(['GET', 'POST'], '/auth/login', 'Auth::login');
$routes->match(['GET', 'POST'], '/auth/register', 'Auth::register');
$routes->get('auth/forgotPassword', 'Auth::forgotPassword');
$routes->post('auth/sendResetLink', 'Auth::sendResetLink');
$routes->get('auth/resetPassword/(:any)', 'Auth::resetPassword/$1');
$routes->post('auth/updatePassword', 'Auth::updatePassword');
$routes->get('/auth/logout', 'Auth::logout');
$routes->post('contact/submit', 'ContactController::submit');

$routes->get('/dashboard', 'PageController::dashboard');
$routes->get('/profile', 'PageController::profile');
$routes->get('/settings', 'PageController::settings');

$routes->post('profile/update', 'Auth::updateProfile');

// Error handling routes
$routes->set404Override(); // Default 404 error page

// Optional: Add more routes as needed for your application

// Finally, we can route everything to the default controller if no match is found
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
