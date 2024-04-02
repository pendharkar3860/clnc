<?php
    /*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('auth', '\Modules\Auth\Controllers\Login::index');
$routes->get('login', '\Modules\Auth\Controllers\Login::index');
$routes->get('registration', '\Modules\Auth\Controllers\Registration::index');
$routes->post('registration/createlogin', '\Modules\Auth\Controllers\Registration::createLogin'); 
$routes->get('forgotpassword', '\Modules\Auth\Controllers\Resetpass::index');
$routes->get('passwordreset/(:any)', '\Modules\Auth\Controllers\Resetpass::passwordreset/$1');   

$routes->post('login/doLogin', '\Modules\Auth\Controllers\Login::doLogin');
$routes->post('login/authenticat', '\Modules\Auth\Controllers\Login::authenticat');
$routes->post('login/logout', '\Modules\Auth\Controllers\Login::DoLogout');
$routes->post('login/sendforgetpasslink', '\Modules\Auth\Controllers\Resetpass::sendforgetpasslink');


//$routes->get('auth/login/update/(:num)', '\Modules\Admin\Controllers\Section::update/$1');
?>