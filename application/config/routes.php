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
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'Auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/* Auth */
$route['login'] = 'Auth/login';
$route['login_process'] = 'Auth/login_process';
$route['registrasi'] = 'Auth/registration';
$route['register_process'] = 'Auth/register_process';

/* Admin */
$route['admin_side/beranda'] = 'admin/App/home';
$route['admin_side/log_aktifitas'] = 'admin/App/log_activity';
$route['admin_side/hapus_data_log/(:any)'] = 'admin/App/delete_log_activity/$1';
$route['admin_side/cleaning_log'] = 'admin/App/cleaning_log';
$route['admin_side/tentang_aplikasi'] = 'admin/App/about';
$route['admin_side/bantuan'] = 'admin/App/helper';
$route['admin_side/profil'] = 'admin/App/profile';
$route['admin_side/perbarui_profil'] = 'admin/App/profile_update';
$route['admin_side/pengaturan_kata_sandi'] = 'admin/App/password_setting';
$route['admin_side/perbarui_kata_sandi'] = 'admin/App/password_update';

$route['admin_side/data_fisioterapi'] = 'admin/Master/data_fisioterapi';
$route['admin_side/tambah_data_fisioterapi'] = 'admin/Master/tambah_data_fisioterapi';
$route['admin_side/simpan_data_fisioterapi'] = 'admin/Master/simpan_data_fisioterapi';
$route['admin_side/ubah_data_fisioterapi/(:any)'] = 'admin/Master/ubah_data_fisioterapi/$1';
$route['admin_side/perbarui_data_fisioterapi'] = 'admin/Master/perbarui_data_fisioterapi';
$route['admin_side/atur_ulang_kata_sandi_akun_fisioterapi/(:any)'] = 'admin/Master/atur_ulang_kata_sandi_akun_fisioterapi/$1';
$route['admin_side/hapus_data_fisioterapi/(:any)'] = 'admin/Master/hapus_data_fisioterapi/$1';
$route['admin_side/data_pasien'] = 'admin/Master/data_pasien';
$route['admin_side/tambah_data_pasien'] = 'admin/Master/tambah_data_pasien';
$route['admin_side/simpan_data_pasien'] = 'admin/Master/simpan_data_pasien';
$route['admin_side/detail_data_pasien/(:any)'] = 'admin/Master/detail_data_pasien/$1';
$route['admin_side/ubah_data_pasien/(:any)'] = 'admin/Master/ubah_data_pasien/$1';
$route['admin_side/perbarui_data_pasien'] = 'admin/Master/perbarui_data_pasien';
$route['admin_side/hapus_data_pasien/(:any)'] = 'admin/Master/hapus_data_pasien/$1';

$route['admin_side/pemeriksaan'] = 'admin/Report/pemeriksaan';
$route['admin_side/simpan_pemeriksaan'] = 'admin/Report/simpan_pemeriksaan';
$route['admin_side/hasil_pemeriksaan'] = 'admin/Report/hasil_pemeriksaan';
$route['admin_side/detail_pemeriksaan/(:any)'] = 'admin/Report/detail_pemeriksaan/$1';
$route['admin_side/ubah_pemeriksaan/(:any)'] = 'admin/Report/ubah_pemeriksaan/$1';
$route['admin_side/perbarui_data_pemeriksaan'] = 'admin/Report/perbarui_data_pemeriksaan';
$route['admin_side/rekap_pemeriksaan'] = 'admin/Report/rekap_pemeriksaan';
$route['admin_side/hapus_foto_pemeriksaan/(:any)'] = 'admin/Report/hapus_foto_pemeriksaan/$1';
$route['admin_side/hapus_data_pemeriksaan/(:any)'] = 'admin/Report/hapus_data_pemeriksaan/$1';

/* Employee */
$route['employee_side/launcher'] = 'employee/App/launcher';
$route['employee_side/beranda'] = 'employee/App/home';
$route['employee_side/log_aktifitas'] = 'employee/App/log_activity';
$route['employee_side/hapus_data_log/(:any)'] = 'employee/App/delete_log_activity/$1';
$route['employee_side/cleaning_log'] = 'employee/App/cleaning_log';
$route['employee_side/tentang_aplikasi'] = 'employee/App/about';
$route['employee_side/bantuan'] = 'employee/App/helper';
$route['employee_side/profil'] = 'employee/App/profile';
$route['employee_side/perbarui_profil'] = 'employee/App/profile_update';
$route['employee_side/pengaturan_kata_sandi'] = 'employee/App/password_setting';
$route['employee_side/perbarui_kata_sandi'] = 'employee/App/password_update';

$route['employee_side/data_fisioterapi'] = 'employee/Master/data_fisioterapi';
$route['employee_side/data_pasien'] = 'employee/Master/data_pasien';
$route['employee_side/tambah_data_pasien'] = 'employee/Master/tambah_data_pasien';
$route['employee_side/simpan_data_pasien'] = 'employee/Master/simpan_data_pasien';
$route['employee_side/detail_data_pasien/(:any)'] = 'employee/Master/detail_data_pasien/$1';
$route['employee_side/ubah_data_pasien/(:any)'] = 'employee/Master/ubah_data_pasien/$1';
$route['employee_side/perbarui_data_pasien'] = 'employee/Master/perbarui_data_pasien';
$route['employee_side/hapus_data_pasien/(:any)'] = 'employee/Master/hapus_data_pasien/$1';

$route['employee_side/pemeriksaan'] = 'employee/Report/pemeriksaan';
$route['employee_side/simpan_pemeriksaan'] = 'employee/Report/simpan_pemeriksaan';
$route['employee_side/hasil_pemeriksaan'] = 'employee/Report/hasil_pemeriksaan';
$route['employee_side/detail_pemeriksaan/(:any)'] = 'employee/Report/detail_pemeriksaan/$1';
$route['employee_side/ubah_pemeriksaan/(:any)'] = 'employee/Report/ubah_pemeriksaan/$1';
$route['employee_side/perbarui_data_pemeriksaan'] = 'employee/Report/perbarui_data_pemeriksaan';
$route['employee_side/rekap_pemeriksaan'] = 'employee/Report/rekap_pemeriksaan';
$route['employee_side/hapus_foto_pemeriksaan/(:any)'] = 'employee/Report/hapus_foto_pemeriksaan/$1';
$route['employee_side/hapus_data_pemeriksaan/(:any)'] = 'employee/Report/hapus_data_pemeriksaan/$1';

/* REST API */
$route['api'] = 'Rest_server/documentation';