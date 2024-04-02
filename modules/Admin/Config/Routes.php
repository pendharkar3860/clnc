<?php
    /*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('admin', '\Modules\Admin\Controllers\dashboard::index');
$routes->get('admin/dashboard', '\Modules\Admin\Controllers\dashboard::index');


$routes->get('admin/section', '\Modules\Admin\Controllers\Section::index');
$routes->get('admin/section/update/(:num)', '\Modules\Admin\Controllers\Section::update/$1');
$routes->get('login', '\Modules\Auth\Controllers\Login::index');
$routes->get('login/logout', '\Modules\Auth\Controllers\Login::DoLogout');
$routes->get('admin/firm', '\Modules\Admin\Controllers\Firm');
$routes->get('admin/profile', '\Modules\Admin\Controllers\Profile');
$routes->post('admin/profile/update/(:num)', '\Modules\Admin\Controllers\Profile::updateprofile/$1');

?>