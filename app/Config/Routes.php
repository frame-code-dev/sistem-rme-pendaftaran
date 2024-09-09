<?php

use App\Controllers\ApiController;
use App\Controllers\DashboardController;
use App\Controllers\DiagnosaController;
use App\Controllers\GeneralConsentController;
use App\Controllers\ImportController;
use App\Controllers\KunjunganController;
use App\Controllers\ObatController;
use App\Controllers\PemeriksaanController;
use App\Controllers\PendaftaranController;
use App\Controllers\PetugasController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/',function() {   
    return redirect()->route('login');   
});
$routes->get('/dashboard', [DashboardController::class,'index'],['filter' => 'login']);
// data master 
$routes->group('master-data',['filter' => 'login'], static function($routes) {
    // petugas 
    $routes->get('petugas',[PetugasController::class,'index']);
    $routes->get('petugas/create', [PetugasController::class,'create']);    
    $routes->post('petugas/store', [PetugasController::class,'store']);    
    $routes->get('petugas/show/(:any)', [PetugasController::class,'show']);    
    $routes->get('petugas/edit/(:any)', [PetugasController::class,'edit']);    
    $routes->post('petugas/edit/update/(:any)', [PetugasController::class,'update']);    
    $routes->post('petugas/update-status', [PetugasController::class,'updateStatus']);    
    $routes->get('petugas/delete/(:any)', [PetugasController::class,'destroy']);    
    $routes->get('petugas/update-password',[PetugasController::class,'updatePassword']);
    $routes->post('petugas/update-password/store',[PetugasController::class,'updatePasswordStore']);
    // data diagnosa 
    $routes->get('diagnosa',[DiagnosaController::class,'index']);
    $routes->get('diagnosa/create', [DiagnosaController::class,'create']);   
    $routes->post('diagnosa/store', [DiagnosaController::class,'store']);   
    $routes->get('diagnosa/show/(:any)', [DiagnosaController::class,'show']);    
    $routes->get('diagnosa/edit/(:any)', [DiagnosaController::class,'edit']);    
    $routes->post('diagnosa/edit/update/(:any)', [DiagnosaController::class,'update']);  
    $routes->get('diagnosa/delete/(:any)', [DiagnosaController::class,'destroy']);   
    // data obat 
    $routes->get('obat',[ObatController::class,'index']);
    $routes->get('obat/create', [ObatController::class,'create']);   
    $routes->post('obat/store', [ObatController::class,'store']);   
    $routes->get('obat/show/(:any)', [ObatController::class,'show']);    
    $routes->get('obat/edit/(:any)', [ObatController::class,'edit']);    
    $routes->post('obat/edit/update/(:any)', [ObatController::class,'update']);  
    $routes->get('obat/delete/(:any)', [ObatController::class,'destroy']);    
});
// pendaftaran 
$routes->get('pendaftaran',[PendaftaranController::class,'index'],['filter' => 'login']);
$routes->get('pendaftaran/create',[PendaftaranController::class,'create'],['filter' => 'login']);
$routes->post('pendaftaran/store', [PendaftaranController::class,'store'],['filter' => 'login']); 
$routes->get('pendaftaran/show/(:any)', [PendaftaranController::class,'show'],['filter' => 'login']); 
$routes->get('pendaftaran/edit/(:any)', [PendaftaranController::class,'edit'],['filter' => 'login']); 
$routes->post('pendaftaran/edit/update/(:any)', [PendaftaranController::class,'update'],['filter' => 'login']); 
$routes->get('pendaftaran/delete/(:any)', [PendaftaranController::class,'destroy'],['filter' => 'login']);    

// General Consent 
$routes->get('consent/create/(:any)', [GeneralConsentController::class,'index'],['filter' => 'login']);   
$routes->get('consent/pdf', [GeneralConsentController::class,'pdf'],['filter' => 'login']);   
$routes->post('consent/create/store/(:any)', [GeneralConsentController::class,'store'],['filter' => 'login']);   
// Kunjungan 
$routes->get('kunjungan/create/(:any)', [KunjunganController::class,'create'],['filter' => 'login']);
$routes->post('kunjungan/create/store/(:any)', [KunjunganController::class,'store'],['filter' => 'login']);
// Pemeriksaaan 
$routes->get('pemeriksaan',[PemeriksaanController::class,'index'],['filter' => 'login']);
$routes->get('pemeriksaan/create/(:any)',[PemeriksaanController::class,'create'],['filter' => 'login']);

// import Excel 
$routes->get('import-excel', [ImportController::class,'importExcel'],['filter' => 'login']);
$routes->post('import-excel/store', [ImportController::class,'importExcelStore'],['filter' => 'login']);

$routes->get('diagnosa/sepuluh',[ApiController::class,'sepuluh']);
$routes->get('diagnosa/sembilan',[ApiController::class,'sembilanData']);