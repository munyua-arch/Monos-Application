<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::index');

$routes->get('admin-login', 'Home::adminLogin');
$routes->post('admin-login', 'Home::adminLogin');

$routes->get('login', 'Home::login');
$routes->post('login', 'Home::login');



//Employee dashboard routes
$routes->get('dashboard/', 'Dashboard::index');

$routes->get('dashboard/leave', 'Dashboard::leaveForm');
$routes->post('dashboard/leave', 'Dashboard::leaveForm');

//leave history
$routes->get('dashboard/history', 'Dashboard::leaveHistory');

$routes->get('dashboard/change-password', 'Dashboard::changePassword');
$routes->post('dashboard/change-password', 'Dashboard::changePassword');

$routes->get('dashboard/logout', 'Dashboard::logout');





//admin routes
$routes->get('admindashboard/', 'Admindashboard::index');
$routes->get('admindashboard/employees', 'Admindashboard::employees');
$routes->get('admindashboard/departments', 'Admindashboard::departments');
$routes->get('admindashboard/leave-types', 'Admindashboard::leave');

$routes->get('admindashboard/new-employee', 'Admindashboard::newEmployee');
$routes->post('admindashboard/new-employee', 'Admindashboard::newEmployee');

$routes->get('admindashboard/new-department', 'Admindashboard::newDept');
$routes->post('admindashboard/new-department', 'Admindashboard::newDept');

$routes->get('admindashboard/new-leave', 'Admindashboard::newLeave');
$routes->post('admindashboard/new-leave', 'Admindashboard::newLeave');

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

$routes->get('admindashboard/logout', 'Admindashboard::logout');

