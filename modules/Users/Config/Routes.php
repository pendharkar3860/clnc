<?php
    /*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('users', '\Modules\Users\Controllers\Users::index');
$routes->get('users/update', '\Modules\Users\Controllers\Users::Update');
?>