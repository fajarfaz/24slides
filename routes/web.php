<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');
Route::middleware(['admin','auth'])->group(function () {

//update Admin
Route::post('admin/update/{id}','HomeController@update_admin')->name('admin.update.admin');

//Route Department
Route::get('admin/department','ConfigRegisKaryawanController@index_department')->name('index.department');
Route::post('admin/department','ConfigRegisKaryawanController@store_department')->name('store.department');
Route::patch('admin/department','ConfigRegisKaryawanController@update_department')->name('update.department');
Route::get('admin/department/{id}/delete','ConfigRegisKaryawanController@destroy_department')->name('delete.department');

//Route Leveling
Route::get('admin/leveling','ConfigRegisKaryawanController@index_leveling')->name('index.leveling');
Route::post('admin/leveling','ConfigRegisKaryawanController@store_leveling')->name('store.leveling');
Route::patch('admin/leveling','ConfigRegisKaryawanController@update_leveling')->name('update.leveling');
Route::get('admin/leveling/{id}/delete','ConfigRegisKaryawanController@destroy_leveling')->name('delete.leveling');

//Route Status Karyawan
Route::get('admin/status','ConfigRegisKaryawanController@index_status')->name('index.status');
Route::post('admin/status','ConfigRegisKaryawanController@store_status')->name('store.status');
Route::patch('admin/status','ConfigRegisKaryawanController@update_status')->name('update.status');
Route::get('admin/status/{id}/delete','ConfigRegisKaryawanController@destroy_status')->name('delete.status');

//Penggajian
Route::get('admin/penggajian','GajiKaryawanController@index')->name('index.gaji');
Route::post('admin/penggajian','GajiKaryawanController@store')->name('store.gaji');

Route::get('admin/penambahan-gaji','GajiKaryawanController@index_penambahangaji')->name('index.tambah_gaji');
Route::post('admin/penambahan-gaji','GajiKaryawanController@store_penambahangaji')->name('store.tambah_gaji');
Route::patch('admin/penambahan-gaji/update', 'GajiKaryawanController@update_penambahangaji')->name('update.tambah_gaji'); 
Route::get('admin/penambahan-gaji/{id}/destroy','GajiKaryawanController@delete_penambahangaji')->name('delete.tambah_gaji');
Route::get('admin/pengurangan-gaji','GajiKaryawanController@index_pengurangangaji')->name('index.kurang_gaji');
Route::post('admin/pengurangan-gaji','GajiKaryawanController@store_pengurangangaji')->name('store.kurang_gaji');
Route::patch('admin/pengurangan-gaji/update', 'GajiKaryawanController@update_pengurangangaji')->name('update.kurang_gaji');
Route::get('admin/pengurangan-gaji/{id}/destroy','GajiKaryawanController@delete_pengurangangaji')->name('delete.kurang_gaji');

//Route Manage Karyawan
Route::get('admin/karyawan', 'ManageKaryawanController@index')->name('index.karyawan');
Route::get('admin/karyawan/create', 'ManageKaryawanController@create')->name('create.karyawan');
Route::post('admin/karyawan/create', 'ManageKaryawanController@store')->name('store.karyawan');
Route::get('admin/karyawan/{id}/edit', 'ManageKaryawanController@edit')->name('edit.karyawan');
Route::patch('admin/karyawan/{id}/update', 'ManageKaryawanController@update')->name('update.karyawan');
Route::get('admin/karyawan/{id}/delete','ManageKaryawanController@delete')->name('delete.karyawan');
Route::get('admin/quota-cuti','ManageKaryawanController@index_quota')->name('admin.index.quota');
Route::post('admin/quota-cuti/update','ManageKaryawanController@update_quota')->name('admin.update.quota');

//Lembur
Route::get('admin/lembur','JadwalManageController@index_lembur')->name('index.lembur');
Route::put('admin/lembur/update','JadwalManageController@acc_lembur')->name('admin.lembur.update');
Route::delete('admin/lembur/{id}/delete','JadwalManageController@destroy_lembur')->name('admin.lembur.destroy');

//Cuti/Izin/Sakit/Cuti(Haid)
Route::get('admin/jadwal_off','JadwalManageController@index_jadwal_off')->name('index.jadwal_off');
Route::patch('admin/jadwal_off/update','JadwalManageController@update_jadwal_off')->name('update.jadwal_off');
Route::get('admin/jadwal_off/delete/{id}','JadwalManageController@destroy_jadwal_off')->name('delete.jadwal_off');

//Mutasi
Route::get('admin/mutasi', 'ManageKaryawanController@index_mutasi')->name('index.mutasi');
Route::get('admin/mutasi/{id}', 'ManageKaryawanController@create_mutasi')->name('create.mutasi');
Route::post('admin/mutasi/{id}', 'ManageKaryawanController@store_mutasi')->name('store.mutasi');
Route::patch('admin/mutasi/update', 'ManageKaryawanController@update_mutasi')->name('update.mutasi');
Route::get('admin/mutasi/delete/{id}', 'ManageKaryawanController@delete_mutasi')->name('delete.mutasi');

//Jatah Makan
Route::get('admin/jatah-makan','MealManageController@index')->name('admin.index.jatah_makan');
Route::patch('admin/jatah-makan/ref-meal','MealManageController@ref_meal')->name('refuse.meal');

//Json Data
Route::get('data/department', 'ConfigRegisKaryawanController@data_department')->name('data.department');
Route::get('data/mutasi', 'ManageKaryawanController@data_mutasi')->name('data.mutasi');
Route::get('data/leveling', 'ConfigRegisKaryawanController@data_leveling')->name('data.leveling');
Route::get('data/status', 'ConfigRegisKaryawanController@data_status')->name('data.status');
Route::get('data/karyawan', 'ManageKaryawanController@data_karyawan')->name('data.karyawan');
Route::get('data/jatah-makan', 'MealManageController@data_jatah_makan')->name('data.jatah_makan');
Route::get('data/lembur', 'JadwalManageController@data_lembur')->name('data.lembur');
Route::get('data/jadwal', 'JadwalManageController@data_jadwal')->name('data.jadwal');


//Jadwal
Route::get('admin/jadwal', 'JadwalManageController@create_importJadwal')->name('importer.jadwal');
Route::post('admin/jadwal/done', 'JadwalManageController@import_jadwal')->name('import.jadwal');
Route::post('admin/jadwal/', 'JadwalManageController@store_jadwal')->name('store.jadwal');
Route::patch('admin/jadwal/update', 'JadwalManageController@update_jadwal')->name('update.jadwal');
Route::get('admin/jadwal/{id}/delete', 'JadwalManageController@delete_jadwal')->name('delete.jadwal');
Route::get('admin/absensi', 'JadwalManageController@index_absen')->name('index.absen');
Route::post('admin/absensi/import', 'JadwalManageController@import_absen')->name('import.absen');
Route::post('admin/absensi', 'JadwalManageController@store_absen')->name('store.absen');
Route::put('admin/absensi/update','JadwalManageController@update_absen')->name('admin.update.absen');
Route::get('admin/absensi/{id}/delete','JadwalManageController@delete_absen')->name('admin.delete.absen');

//Pencatatan Cuti/Ijin Sakit/Ganti Shift
Route::get('admin/cuti','JadwalManageController@index_cuti')->name('admin.index.cuti');
Route::get('admin/izin','JadwalManageController@index_izin')->name('admin.index.izin');
Route::get('admin/ganti-shift','JadwalManageController@index_ganti_shift')->name('admin.index.ganti_shift');

// Pelaporan
Route::get('admin/report/gaji','GajiKaryawanController@index_report_gaji')->name('admin.report.gaji');
Route::get('admin/report/gaji/karyawan','GajiKaryawanController@index_report_gaji_karyawan')->name('admin.report.gaji_karyawan');
Route::get('admin/report/penambahan-gaji/karyawan','GajiKaryawanController@index_report_penambahan')->name('admin.report.penambahan');
Route::get('admin/report/pengurangan-gaji/karyawan','GajiKaryawanController@index_report_pengurangan')->name('admin.report.pengurangan');
Route::get('admin/report/lembur','GajiKaryawanController@index_report_lembur')->name('admin.report.lembur');
Route::get('admin/report/shift-target','JadwalManageController@index_report_shift')->name('admin.report.shift');
Route::get('admin/report/work-absensi','JadwalManageController@index_report_absen')->name('admin.report.absen');
});

Route::middleware(['auth','karyawan'])->group(function () {
//Jadwal
Route::get('karyawan/lembur', 'KaryawanActController@index_lembur')->name('indexk.lembur');
Route::post('karyawan/lembur', 'KaryawanActController@store_lembur')->name('storek.lembur');
Route::put('karyawan/lembur/update', 'KaryawanActController@update_lembur')->name('karyawan.lembur.update');
Route::delete('karyawan/lembur/{id}/delete','KaryawanActController@destroy_lembur')->name('karyawan.lembur.destroy');
Route::get('karyawan/jadwal-off', 'KaryawanActController@index_jadwal_off')->name('indexk.jadwal_off');
Route::post('karyawan/jadwal_off','KaryawanActController@store_jadwal_off')->name('store.jadwal_off');
Route::get('karyawan/ganti-shift', 'KaryawanActController@index_ganti_shift')->name('index.ganti_shift');
Route::post('karyawan/ganti-shift', 'KaryawanActController@store_gantishift')->name('store.ganti_shift');
Route::put('karyawan/ganti-shift/update', 'KaryawanActController@update_gantishift')->name('karyawan.update.ganti_shift');
Route::get('karyawan/jadwal','KaryawanActController@index_jadwal')->name('indexk.jadwal');


Route::get('karyawan/profile','KaryawanActController@profile')->name('profile.karyawan');

//Jatah Makan
Route::get('karyawan/jatah-makan','MealManageController@index')->name('index.jatah_makan');


//Json Data
Route::get('karyawan/data-lembur', 'KaryawanActController@data_lembur')->name('datak.lembur');
Route::get('karyawan/data-jadwal', 'KaryawanActController@data_jadwal')->name('datak.jadwal');
Route::get('karyawan/data/jatah-makan', 'MealManageController@datak_jatah_makan')->name('datak.jatah_makan');
// get_karyawan Ganti Shift
Route::get('get-karyawan/ganti-shift','KaryawanActController@get_karyawan')->name('get_karyawan');
// Konfirm Ganti Shift
Route::get('karyawan/konfirm/ganti-shift','KaryawanActController@konfirm_gantishift')->name('konfirm.ganti_shift');
});

Auth::routes();


