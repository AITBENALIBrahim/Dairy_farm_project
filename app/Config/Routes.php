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
$routes->get('auth/confirmAccount', 'Auth::confirmAccount');
$routes->post('auth/confirmAccount', 'Auth::confirmAccount');
$routes->get('auth/resendCode', 'Auth::resendCode');
$routes->get('auth/forgotPassword', 'Auth::forgotPassword');
$routes->post('auth/sendResetLink', 'Auth::sendResetLink');
$routes->get('auth/resetPassword/(:any)', 'Auth::resetPassword/$1');
$routes->post('auth/updatePassword', 'Auth::updatePassword');
$routes->get('/auth/logout', 'Auth::logout');

$routes->get('/dashboard', 'PageController::dashboard');
$routes->get('/profile', 'PageController::profile');
$routes->get('/settings', 'PageController::settings');
$routes->get('/manage-users', 'PageController::manageUsers');
$routes->get('/add-assistant', 'PageController::addAssistant');
$routes->post('/save-assistant', 'PageController::saveAssistant');
$routes->get('/edit-assistant/(:num)', 'PageController::editAssistant/$1');
$routes->post('/update-assistant/(:num)', 'PageController::updateAssistant/$1');
$routes->get('delete-assistant/(:segment)', 'PageController::deleteAssistant/$1');

$routes->get('/suppliers', 'PageController::suppliers');
$routes->get('add-supplier', 'PageController::addSupplier');
$routes->post('save-supplier', 'PageController::saveSupplier');
$routes->get('edit-supplier/(:num)', 'PageController::editSupplier/$1');
$routes->post('update-supplier/(:num)', 'PageController::updateSupplier/$1');
$routes->get('delete-supplier/(:num)', 'PageController::deleteSupplier/$1');

$routes->get('/expenses', 'PageController::expenses');
$routes->get('add-expense', 'PageController::addExpense');
$routes->post('save-expense', 'PageController::saveExpense');
$routes->get('edit-expense/(:num)', 'PageController::editExpense/$1');
$routes->post('update-expense/(:num)', 'PageController::updateExpense/$1');
$routes->get('delete-expense/(:num)', 'PageController::deleteExpense/$1');

$routes->post('profile/update', 'Auth::updateProfile');

// Error handling routes
$routes->set404Override(); // Default 404 error page

// Optional: Add more routes as needed for your application

// Finally, we can route everything to the default controller if no match is found
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
