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

$routes->get('/feed-chart', 'FeedChartController::feedChart');
$routes->get('add-feed', 'FeedChartController::addFeed');
$routes->post('add-feed', 'FeedChartController::addFeed');

$routes->get('animal-routines', 'AnimalRoutineController::index');
$routes->post('add-routine', 'AnimalRoutineController::addRoutine');
$routes->get('add-routine', 'AnimalRoutineController::addRoutine');
$routes->post('save-routine', 'AnimalRoutineController::saveRoutine');
// app/Config/Routes.php

$routes->get('delete-routine/(:num)', 'AnimalRoutineController::deleteRoutine/$1');
// app/Config/Routes.php
$routes->get('edit-routine/(:num)', 'AnimalRoutineController::editRoutine/$1');
$routes->post('update-routine/(:num)', 'AnimalRoutineController::updateRoutine/$1');


$routes->get('animal-routines', 'AnimalRoutineController::index');
$routes->post('add-routine', 'AnimalRoutineController::addRoutine');
$routes->get('add-routine', 'AnimalRoutineController::addRoutine');
$routes->post('save-routine', 'AnimalRoutineController::saveRoutine');


$routes->get('download-invoice/(:num)', 'MilkSalesController::download_invoice/$1');


$routes->post('add_milk_collection', 'MilkCollectionController::addMilkCollection');
$routes->get('add_milk_collection', 'MilkCollectionController::addMilkCollection');
$routes->post('add_cow', 'CowController::addCow');
$routes->get('add_cow', 'CowController::addCow');
$routes->get('milk-collection', 'MilkCollectionController::index');
$routes->get('cow', 'CowController::cows');
$routes->get('calves', 'CalfController::calves');
$routes->get('stalls', 'StallController::stalls');


$routes->get('delete-routine/(:num)', 'AnimalRoutineController::deleteRoutine/$1');
// app/Config/Routes.php
$routes->get('edit-routine/(:num)', 'AnimalRoutineController::editRoutine/$1');
$routes->post('update-routine/(:num)', 'AnimalRoutineController::updateRoutine/$1');




$routes->get('vaccinations', 'VaccinationsController::vaccinations');
$routes->get('pregnancy-records', 'PregnancyRecordsController::PregnancyRecords');
$routes->post('add_pregnancy', 'PregnancyRecordsController::addPregnancy');
$routes->post('add_vaccination', 'VaccinationsController::addVaccination');

$routes->post('add_calf', 'CalfController::addCalf');
$routes->get('add_calf', 'CalfController::addCalf');
$routes->post('add_stall', 'StallController::addStall');


$routes->post('add_milk_collection', 'MilkSalesController::addMilkCollection');
$routes->post('add-sale', 'MilkSalesController::addSale');
$routes->get('add-sale', 'MilkSalesController::addSale');
$routes->get('milk-sales', 'MilkSalesController::index');

$routes->get('delete-sale/(:num)', 'MilkSalesController::deleteSale/$1');
// app/Config/Routes.php
$routes->get('edit-sale/(:num)', 'MilkSalesController::editSale/$1');
$routes->post('update-sale/(:num)', 'MilkSalesController::updateSale/$1');
$routes->get('edit-calf/(:num)', 'CalfController::editCalf/$1');
$routes->post('update-calf/(:num)', 'CalfController::updateCalf/$1');


$routes->post('add_milk_collection', 'MilkSalesController::addMilkCollection');
$routes->get('milk-sales', 'MilkSalesController::index');

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

$routes->get('/employees', 'PageController::employees');
$routes->get('add-employee', 'PageController::addEmployee');
$routes->post('save-employee', 'PageController::saveEmployee');
$routes->get('edit-employee/(:num)', 'PageController::editEmployee/$1');
$routes->post('update-employee/(:num)', 'PageController::updateEmployee/$1');
$routes->get('delete-employee/(:num)', 'PageController::deleteEmployee/$1');

$routes->get('/salaries', 'PageController::salaries');
$routes->get('add-salary', 'PageController::addSalary');
$routes->post('save-salary', 'PageController::saveSalary');
$routes->get('edit-salary/(:num)', 'PageController::editSalary/$1');
$routes->post('update-salary/(:num)', 'PageController::updateSalary/$1');
$routes->get('delete-salary/(:num)', 'PageController::deleteSalary/$1');

$routes->post('profile/update', 'Auth::updateProfile');

// Error handling routes
$routes->set404Override(); // Default 404 error page

// Optional: Add more routes as needed for your application

// Finally, we can route everything to the default controller if no match is found
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
