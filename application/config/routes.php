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
$route['user/profile/add']              = 'setting/profile_add';
$route['user/profile/detail']           = 'setting/profile_detail';
$route['user/profile/edit']           = 'setting/profile_edit';
$route['user/profile/delete']           = 'setting/profile_delete';
$route['user/update/photo']           = 'setting/profile_photo';
$route['user/upload/photo']           = 'setting/upload_photo';

$route['user/log']                      = 'setting/manage_log';

$route['wilayah/propinsi']    = 'wilayah/propinsi';
$route['wilayah/propinsi/data']    = 'wilayah/propinsi_data';
$route['wilayah/propinsi/add']               = 'wilayah/propinsi_add';
$route['wilayah/propinsi/edit']              = 'wilayah/propinsi_edit';
$route['wilayah/propinsi/delete']            = 'wilayah/propinsi_delete';

$route['wilayah/kabupaten']   = 'wilayah/kabupaten';
$route['wilayah/kabupaten/data']    = 'wilayah/kabupaten_data';
$route['wilayah/kabupaten/add']               = 'wilayah/kabupaten_add';
$route['wilayah/kabupaten/edit']              = 'wilayah/kabupaten_edit';
$route['wilayah/kabupaten/delete']            = 'wilayah/kabupaten_delete';

$route['wilayah/kecamatan']   = 'wilayah/kecamatan';
$route['wilayah/kecamatan/data']    = 'wilayah/kecamatan_data';
$route['wilayah/kecamatan/detail']    = 'wilayah/kecamatan_detail';
$route['wilayah/kecamatan/add']               = 'wilayah/kecamatan_add';
$route['wilayah/kecamatan/edit']              = 'wilayah/kecamatan_edit';
$route['wilayah/kecamatan/delete']            = 'wilayah/kecamatan_delete';

$route['wilayah/ajax_kabupaten'] = 'wilayah/ajax_kabupaten';
$route['wilayah/ajax_kecamatan'] = 'wilayah/ajax_kecamatan';
$route['wilayah/ajax_kelurahan'] = 'wilayah/ajax_kelurahan';

$route['wilayah/filter_kabupaten'] = 'wilayah/filter_kabupaten';
$route['wilayah/filter_kabupaten_modal'] = 'wilayah/filter_kabupaten_modal';
$route['wilayah/filter_kecamatan'] = 'wilayah/filter_kecamatan';
$route['wilayah/filter_kecamatan_modal'] = 'wilayah/filter_kecamatan_modal';
$route['wilayah/filter_kelurahan_modal'] = 'wilayah/filter_kelurahan_modal';

$route['wilayah/kelurahan'] = 'wilayah/kelurahan';
$route['wilayah/kelurahan/data']    = 'wilayah/kelurahan_data';
$route['wilayah/kelurahan/detail']    = 'wilayah/kelurahan_detail';
$route['wilayah/kelurahan/add']               = 'wilayah/kelurahan_add';
$route['wilayah/kelurahan/edit']              = 'wilayah/kelurahan_edit';
$route['wilayah/kelurahan/delete']            = 'wilayah/kelurahan_delete';

$route['wilayah/kodepos'] = 'wilayah/kodepos';
$route['wilayah/kodepos/data']    = 'wilayah/kodepos_data';
$route['wilayah/kodepos/detail']    = 'wilayah/kodepos_detail';
$route['wilayah/kodepos/add']               = 'wilayah/kodepos_add';
$route['wilayah/kodepos/edit']              = 'wilayah/kodepos_edit';
$route['wilayah/kodepos/delete']            = 'wilayah/kodepos_delete';

$route['rekening/jenis_rekening']           = 'rekening/jenis_rekening';
$route['rekening/jenis_rekening/data']      = 'rekening/jenis_rekening_data';
$route['rekening/kelompok_rekening']           = 'rekening/kelompok_rekening';
$route['rekening/kelompok_rekening/data']      = 'rekening/kelompok_rekening_data';

$route['rekening/filter_kelompok']      = 'rekening/filter_kelompok';
$route['rekening/filter_kelompok_modal']      = 'rekening/filter_kelompok_modal';
$route['rekening/filter_buku_besar']      = 'rekening/filter_buku_besar';
$route['rekening/filter_buku_besar_modal']      = 'rekening/filter_buku_besar_modal';

$route['rekening/buku_besar'] = 'rekening/buku_besar';
$route['rekening/buku_besar_data'] = 'rekening/buku_besar_data';
$route['rekening/buku_besar/detail']    = 'rekening/buku_besar_detail';
$route['rekening/buku_besar/add']               = 'rekening/buku_besar_add';
$route['rekening/buku_besar/edit']              = 'rekening/buku_besar_edit';
$route['rekening/buku_besar/delete']            = 'rekening/buku_besar_delete';

$route['rekening/sub_buku_besar'] = 'rekening/sub_buku_besar';
$route['rekening/sub_buku_besar_data'] = 'rekening/sub_buku_besar_data';
$route['rekening/sub_buku_besar/detail']    = 'rekening/sub_buku_besar_detail';
$route['rekening/sub_buku_besar/add']               = 'rekening/sub_buku_besar_add';
$route['rekening/sub_buku_besar/edit']              = 'rekening/sub_buku_besar_edit';
$route['rekening/sub_buku_besar/delete']            = 'rekening/sub_buku_besar_delete';


$route['regulasi/acuan']        = 'regulasi/regulasi_acuan';
$route['regulasi/acuan_data']   = 'regulasi/regulasi_acuan_data';
$route['regulasi/upload_file']  = 'regulasi/upload_file';
$route['regulasi/add']  = 'regulasi/add';
$route['regulasi/delete']  = 'regulasi/delete';

$route['slide/web']        = 'slide/web';
$route['slide/web_data']   = 'slide/web_data';
$route['slide/web_upload_file']  = 'slide/web_upload_file';
$route['slide/web_add']  = 'slide/web_add';
$route['slide/web_delete']  = 'slide/web_delete';

$route['slide/mobile']        = 'slide/mobile';
$route['slide/mobile_data']   = 'slide/mobile_data';
$route['slide/mobile_upload_file']  = 'slide/mobile_upload_file';
$route['slide/mobile_add']  = 'slide/mobile_add';
$route['slide/mobile_delete']  = 'slide/mobile_delete';


$route['kesehatan/penilaian']                   = 'penilaian/kesehatan';
$route['kesehatan/penilaian/data']              = 'penilaian/kesehatan_data';
$route['kesehatan/penilaian/add']               = 'penilaian/kesehatan_add';
$route['kesehatan/penilaian/edit']              = 'penilaian/kesehatan_edit';
$route['kesehatan/penilaian/delete']            = 'penilaian/kesehatan_delete';


$route['kesehatan/predikat']    = 'predikat/kesehatan';
$route['kesehatan/predikat/data']              = 'predikat/kesehatan_data';
$route['kesehatan/predikat/add']               = 'predikat/kesehatan_add';
$route['kesehatan/predikat/edit']              = 'predikat/kesehatan_edit';
$route['kesehatan/predikat/delete']            = 'predikat/kesehatan_delete';


$route['login']    = 'auth/login';
$route['login/auth']    = 'auth/do_login';
$route['logout']    = 'auth/logout';
$route['user/profile/change_password']           = 'auth/update_password';
$route['user/profile/save_new_password']           = 'auth/do_update_password';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
