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
$routes->post('admin/firm/insert', '\Modules\Admin\Controllers\Firm::CreateFirm');
$routes->post('admin/firm/update', '\Modules\Admin\Controllers\Firm::UpdateFirm');

$routes->post('admin/profile/insert', '\Modules\Admin\Controllers\Profile::CreateProfile');
$routes->post('admin/profile/update', '\Modules\Admin\Controllers\Profile::Updateprofile');


$routes->get('admin/profile','\Modules\Admin\Controllers\profile');
$routes->post('admin/profile/update/(:num)','\Modules\Admin\Controllers\Profile::updateprofile/$1');

$routes->get('admin/customer','\Modules\Admin\Controllers\customer');
$routes->post('admin/customer','\Modules\Admin\Controllers\customer');
$routes->get('admin/customerajax','\Modules\Admin\Controllers\customerajax');
$routes->post('admin/customerajax','\Modules\Admin\Controllers\customerajax');
$routes->post('admin/customerajax/(:num)','\Modules\Admin\Controllers\customerajax::index/$1');
$routes->post('admin/customerajax/customerdetail/(:num)','\Modules\Admin\Controllers\customerajax::GetSingleCusomerdata/$1');

$routes->get('admin/customer/(:num)', '\Modules\Admin\Controllers\Customer::index/$1');

$routes->get('admin/customer/addnew', '\Modules\Admin\Controllers\customer::CustomerForm');
$routes->post('admin/customer/insert', '\Modules\Admin\Controllers\Customer::CreateCustomer');
$routes->post('admin/customer/update', '\Modules\Admin\Controllers\Customer::UpdateCustomer');
$routes->get('admin/customer/details/(:num)', '\Modules\Admin\Controllers\Customer::UpdateMode/$1');

$routes->get('admin/pumpmodel', '\Modules\Admin\Controllers\Pumpmodel::index');
$routes->get('admin/pumpmodel/addnew', '\Modules\Admin\Controllers\Pumpmodel::PumpmodelForm');
$routes->post('admin/pumpmodel/insert', '\Modules\Admin\Controllers\Pumpmodel::CreatePumpmodel');
$routes->post('admin/pumpmodel/update', '\Modules\Admin\Controllers\Pumpmodel::UpdatePumpmodel');
$routes->get('admin/pumpmodel/details/(:num)', '\Modules\Admin\Controllers\Pumpmodel::Updatemode/$1');

$routes->get('admin/complain','\Modules\Admin\Controllers\complain');

?>