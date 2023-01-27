<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->group('Other', ['filter' => 'auth'], static function ($routes) {
    $routes->get('accessibility', 'Other::accessibility');
    $routes->get('contact', 'Other::contact');
});


$routes->group('Shop', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Shop::index');
    $routes->get('shoppage/(:any)', 'Shop::shoppage/$1');
    $routes->get('wood', 'Shop::Wood');
    $routes->get('wood/(:num)', 'Shop::Wood/$1');
    $routes->get('oil', 'Shop::oil');
    $routes->get('oil/(:any)', 'Shop::oil/$1');
    $routes->get('gas', 'Shop::gas');
    $routes->get('gas/(:any)', 'Shop::gas/$1');
    $routes->get('electricity', 'Shop::electricity');
    $routes->get('electricity/(:any)', 'Shop::electricity/$1');
});


$routes->group( 'Product', ['filter' => 'auth'], static function ($routes){
    $routes->get('/', 'Product::index');
    $routes->get('productpage/(:num)', 'Product::productpage/$1');
    $routes->get('createproduct', 'Product::createProduct');
    $routes->get('createwood', 'Product::createwood');
    $routes->post('createwood', 'Product::createwood');
    $routes->get('createoil', 'Product::createoil');
    $routes->post('createoil', 'Product::createoil');
    $routes->get('creategas', 'Product::creategas');
    $routes->post('creategas', 'Product::creategas');
    $routes->get('createelec', 'Product::createelec');
    $routes->post('createelec', 'Product::createelec');
    $routes->get('edit/(:num)', 'Product::edit/$1');
    $routes->post('edit/(:num)', 'Product::edit/$1');
    $routes->get('removepic/(:num)', 'Product::removepic/$1');
    $routes->get('removeproduct/(:num)', 'Product::removeproduct/$1');
    $routes->get('removevid/(:num)', 'Product::removevid/$1');
});


$routes->group( 'Cart', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Cart::index');
    $routes->get('addtocart/(:num)', 'Cart::addtocart/$1');
    $routes->post('addtocart/(:num)', 'Cart::addtocart/$1');
    $routes->get('editline/(:num)', 'Cart::editline/$1');
    $routes->post('editline/(:num)', 'Cart::editline/$1');
    $routes->get('removeproduct/(:num)', 'Cart::removeproduct/$1');
    $routes->post('ajaxtest/(:num)', 'Cart::ajaxtest/$1');
    $routes->get('ajaxtest/(:num)', 'Cart::ajaxtest/$1');
    $routes->get('getTotalprice', 'Cart::getTotalprice');
});

$routes->group('Checkout', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Checkout::index');
    $routes->post('/', 'Checkout::index');
    $routes->get('delivery', 'Checkout::delivery');
    $routes->post('delivery', 'Checkout::delivery');
    $routes->get('pickup', 'Checkout::pickup');
    $routes->post('pickup', 'Checkout::pickup');
});

$routes->group('Messages', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Messages::index');
    $routes->get('chat/(:num)', 'Messages::chat/$1');
    $routes->get('writemessage/(:num)', 'Messages::writemessage/$1');
    $routes->post('writemessage/(:num)', 'Messages::writemessage/$1');
});


$routes->group('Notifications', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Notifications::index');
    $routes->get('addnotification/(:num)', 'Notifications::addnotification/$1');
    $routes->get('removenotification/(:num)', 'Notifications::removenotification/$1');
});

$routes->group('Orders', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Orders::index');
    $routes->get('cancelorder/(:segment)/(:num)', 'Orders::cancelorder/$1/$2');
    $routes->get('completeOrder/(:segment)/(:num)', 'Orders::completeorder/$1/$2');
});

$routes->group('Reviews', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Reviews::index');
    $routes->get('writereview/(:num)', 'Reviews::writereview/$1');
    $routes->post('writereview/(:num)', 'Reviews::writereview/$1');
});



$routes->get('Profile', 'Profile::index');

$routes->group('Profile', ['filter' => 'logged_in'], static function ($routes) {
    $routes->post('/', 'Profile::login');
    $routes->get('createprofile', 'Profile::createprofile');
    $routes->post('createprofile', 'Profile::createprofile');
});

$routes->group('Profile', ['filter' => 'auth'], static function ($routes) {
    $routes->get('profilepage/(:num)', 'Profile::profilepage/$1');
    $routes->get('logout', 'Profile::logout');
    $routes->get('edit', 'Profile::edit');
    $routes->post('edit', 'Profile::edit');
    $routes->get('removepic/(:num)', 'Profile::removepic/$1');
});




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
