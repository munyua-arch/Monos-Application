<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::index'); 

// //404 override
// // Would execute the show404 method of the App\Errors class
// $routes->set404Override('App\Errors::show404');

// // Will display a custom view
// $routes->set404Override(static function () {
//     echo view('errors/custom_errors');
// });

$routes->get('admin-login', 'Home::adminLogin');
$routes->post('admin-login', 'Home::adminLogin');

$routes->get('admin-login/admin-forgot-password', 'Home::adminforgotPassword');
$routes->post('admin-login/admin-forgot-password', 'Home::adminforgotPassword');

$routes->get('admin-login/admin-reset-password/(:any)', 'Home::adminresetPassword/$1');
$routes->post('admin-login/admin-reset-password/(:any)', 'Home::adminresetPassword/$1');

$routes->get('login', 'Home::login');
$routes->post('login', 'Home::login');

$routes->get('login/forgot-password', 'Home::forgotPassword');
$routes->post('login/forgot-password', 'Home::forgotPassword');

$routes->get('login/reset-password/(:any)', 'Home::resetPassword/$1');
$routes->post('login/reset-password/(:any)', 'Home::resetPassword/$1');



//Login filter to prevent access to dashboard if not logged in


$routes->group('', ['filter' => 'isLoggedIn'], function($routes){
      //Employee dashboard routes
$routes->get('dashboard/', 'Dashboard::index');

$routes->get('dashboard/leave', 'Dashboard::leaveForm');
$routes->post('dashboard/leave', 'Dashboard::leaveForm');

//leave history
$routes->get('dashboard/history', 'Dashboard::leaveHistory');

$routes->get('dashboard/change-password', 'Dashboard::changePassword');
$routes->post('dashboard/change-password', 'Dashboard::changePassword');

$routes->get('dashboard/edit-info', 'Dashboard::editInfo');
$routes->post('dashboard/edit-info', 'Dashboard::editInfo');

$routes->get('dashboard/logout', 'Dashboard::logout');
});


$routes->group('', ['filter' => 'isAdmin'], function($routes){
   $routes->get('admindashboard/', 'Admindashboard::index');
   $routes->get('admindashboard/employees', 'Admindashboard::employees');
   $routes->get('admindashboard/departments', 'Admindashboard::departments');
   $routes->get('admindashboard/leave-types', 'Admindashboard::leave');

   $routes->get('admindashboard/new-employee', 'Admindashboard::newEmployee');
   $routes->post('admindashboard/new-employee', 'Admindashboard::newEmployee');

   $routes->get('admindashboard/new-department', 'Admindashboard::newDept');
   $routes->post('admindashboard/new-department', 'Admindashboard::newDept');

   $routes->get('admindashboard/edit-department/(:num)', 'Admindashboard::editDept/$1');
   $routes->post('admindashboard/edit-department/(:num)', 'Admindashboard::editDept/$1');

   $routes->get('admindashboard/delete-department/(:num)', 'Admindashboard::deleteDept/$1');

   $routes->get('admindashboard/new-leave', 'Admindashboard::newLeave');
   $routes->post('admindashboard/new-leave', 'Admindashboard::newLeave');

   $routes->get('admindashboard/edit-leave/(:num)', 'Admindashboard::editLeave/$1');
   $routes->post('admindashboard/edit-leave/(:num)', 'Admindashboard::editLeave/$1');

   $routes->get('admindashboard/delete-leave/(:num)', 'Admindashboard::deleteLeave/$1');

   $routes->get('admindashboard/pending', 'Admindashboard::pending');
   $routes->get('admindashboard/approved', 'Admindashboard::approved');
   $routes->get('admindashboard/declined', 'Admindashboard::declined');
   $routes->get('admindashboard/leave-history', 'Admindashboard::leaveHistory');


   $routes->get('admindashboard/edit-employee/(:num)', 'Admindashboard::editEmployee/$1');
   $routes->post('admindashboard/edit-employee/(:num)', 'Admindashboard::editEmployee/$1');

   $routes->get('admindashboard/delete-employee/(:num)', 'Admindashboard::deleteEmployee/$1');
   $routes->post('admindashboard/delete-employee/(:num)', 'Admindashboard::deleteEmployee/$1');

   $routes->get('admindashboard/edit-admin/(:num)', 'Admindashboard::editAdmin/$1');
   $routes->post('admindashboard/edit-admin/(:num)', 'Admindashboard::editAdmin/$1');

   $routes->get('admindashboard/delete-admin/(:num)', 'Admindashboard::deleteAdmin/$1');
   $routes->post('admindashboard/delete-admin/(:num)', 'Admindashboard::deleteAdmin/$1');

   $routes->get('admindashboard/employeeleavedetails/(:num)', 'Admindashboard::leaveDetails/$1');
   $routes->post('admindashboard/employeeleavedetails/(:num)', 'Admindashboard::leaveDetails/$1');

   $routes->get('admindashboard/admins', 'Admindashboard::Admin');
   $routes->post('admindashboard/admins', 'Admindashboard::Admin');

   $routes->get('admindashboard/new-admin', 'Admindashboard::newAdmin');
   $routes->post('admindashboard/new-admin', 'Admindashboard::newAdmin');

   $routes->get('admindashboard/admin-change-password', 'Admindashboard::changePassword');
   $routes->post('admindashboard/admin-change-password', 'Admindashboard::changePassword');

   $routes->get('admindashboard/update-admin', 'Admindashboard::updateAdmin');
   $routes->post('admindashboard/update-admin', 'Admindashboard::updateAdmin');

   $routes->get('admindashboard/logout', 'Admindashboard::logout');
});
   