<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'auth/index';
$route['/'] = 'auth/index';
$route['daftar'] = 'auth/daftar';
$route['beranda'] = 'pengguna/index';  // logged in as admin
// logged in as admin
// if (isset($_SESSION['akses']) && $_SESSION['akses'] = '2') {
// } elseif (isset($_SESSION['akses']) && $_SESSION['akses'] = '3') {
//     $route['beranda'] = 'pengguna/index';  // logged in as user
// } else {
//     $route['/'] = 'auth';  // not logged in, send to login 
// }



$route['kost'] = 'pengguna/indexkost';
$route['listrik'] = 'pengguna/indexlistrik';
$route['wifi'] = 'pengguna/indexwifi';
$route['kost/transaksikost-(:any)'] = 'pengguna/det_transaksi/$1';

// Pengurus Routes
$route['pengurus'] = 'pengurus/index';
$route['pembayaran-wifi'] = 'pengurus/index_bayarwifi';
$route['pembayaran-wifi/(:any)-(:any)'] = 'pengurus/index_transaksiwifi/$1-$2';
// $route['transaksi-wifi/'] = 'pengurus/getTransaksi_wifi_bulan';
$route['user'] = 'pengurus/index_akunuser';
$route['user/(:any)'] = 'pengurus/getdetakunuser/$1';
$route['user/(:any)/update'] = 'pengurus/updateuser';


$route['daftar'] = 'auth/daftar';
$route['buatakun'] = 'pengurus/buatakun';
