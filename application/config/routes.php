<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['default_controller']            = 'welcome';
$route['user/bagian']                   = 'setting/bagian';
$route['user/bagian/data']              = 'setting/bagian_data';
$route['user/bagian/add']               = 'setting/bagian_add';
$route['user/bagian/edit']              = 'setting/bagian_edit';
$route['user/bagian/delete']            = 'setting/bagian_delete';

$route['user/jabatan']                  = 'setting/jabatan';
$route['user/jabatan/data']             = 'setting/jabatan_data';
$route['user/jabatan/add']              = 'setting/jabatan_add';
$route['user/jabatan/edit']             = 'setting/jabatan_edit';
$route['user/jabatan/delete']           = 'setting/jabatan_delete';

$route['user/profile']                  = 'setting/profile';
$route['user/profile/data']             = 'setting/profile_data';
$route['user/profile/add']              = 'setting/profile_add';;
$route['user/profile/delete']    = 'setting/profile_delete';

$route['user/log']                      = 'setting/log';
$route['user/log/add']                  = 'setting/log/add';
$route['user/log/detail/(:num)']        = 'setting/log_detail/$1';
$route['user/log/delete/(:num)']        = 'setting/log_delete$1';

$route['parameter/wilayah/propinsi']    = 'wilayah/propinsi';
$route['parameter/wilayah/kabupaten']   = 'wilayah/kabupaten';
$route['parameter/wilayah/ajax_kabupaten'] = 'wilayah/ajax_kabupaten';
$route['parameter/wilayah/ajax_kecamatan'] = 'wilayah/ajax_kecamatan';
$route['parameter/wilayah/ajax_kelurahan'] = 'wilayah/ajax_kelurahan';

$route['parameter/wilayah/filter_kabupaten'] = 'wilayah/filter_kabupaten';
$route['parameter/wilayah/kecamatan'] = 'wilayah/kecamatan';
$route['parameter/wilayah/filter_kecamatan'] = 'wilayah/filter_kecamatan';
$route['parameter/wilayah/kelurahan'] = 'wilayah/kelurahan';
$route['parameter/wilayah/kodepos'] = 'wilayah/kodepos';

$route['parameter/account/rekening'] = 'bankaccount/rekening';
$route['parameter/account/kelompok'] = 'bankaccount/kelompok';
$route['parameter/account/buku_besar'] = 'bankaccount/buku_besar';
$route['parameter/account/sub_buku_besar'] = 'bankaccount/sub_buku_besar';

$route['regulasi/acuan/aturan'] = 'regulasi/aturan';
$route['regulasi/penilaian/kesehatan'] = 'regulasi/penilaian';
$route['regulasi/predikat/kesehatan'] = 'regulasi/predikat';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
