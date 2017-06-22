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
$route['user/profile/delete']           = 'setting/profile_delete';

$route['user/log']                      = 'setting/manage_log';
$route['user/upload_web']               = 'setting/upload_web';
$route['user/upload_file_web']    = 'setting/upload_web';
$route['user/upload_mobile']            = 'setting/upload_mobile';
$route['user/upload_file_mobile']       = 'setting/upload_mobile';

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

$route['rekening/jenis_rekening']           = 'rekening/jenis_rekening';
$route['rekening/jenis_rekening/data']      = 'rekening/jenis_rekening_data';
$route['rekening/kelompok_rekening']           = 'rekening/kelompok_rekening';
$route['rekening/kelompok_rekening/data']      = 'rekening/kelompok_rekening_data';

$route['rekening/buku_besar'] = 'rekening/buku_besar';
$route['rekening/buku_besar_data'] = 'rekening/buku_besar_data';
$route['rekening/filter_kelompok']      = 'rekening/filter_kelompok';

$route['rekening/sub_buku_besar'] = 'rekening/sub_buku_besar';
$route['rekening/sub_buku_besar_data'] = 'rekening/sub_buku_besar_data';
$route['rekening/filter_buku_besar']      = 'rekening/filter_buku_besar';

$route['regulasi/acuan']        = 'regulasi/regulasi_acuan';
$route['regulasi/acuan_data']   = 'regulasi/regulasi_acuan_data';
$route['regulasi/upload_file']  = 'regulasi/upload_file';
$route['regulasi/add']  = 'regulasi/add';
$route['regulasi/delete']  = 'regulasi/delete';


$route['penilaian/kesehatan']   = 'penilaian/penilaian_kesehatan';
$route['predikat/kesehatan']    = 'predikat/predikat_kesehatan';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
