<?php

use App\Filament\Resources\PacientRecordResource\Pages\ListPacientRecords;
use App\Filament\Resources\PatientRecordResource;
use App\Filament\Resources\PatientRecordResource\Pages\ListPatientRecords;
use App\Http\Controllers\PdfController;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', function () {
    return redirect('/admin');
});
Route::get('/generate/{id}/{locale?}', [PdfController::class, 'generatePdf'])->name('generate');;
/*Filament::registerRoutes([
    'pacient-record' => [
        'index' => [\App\Filament\Resources\PacientRecordResource\Pages\ListPacientRecords::class, 'index'],
    ],
]);*/
/*Route::get('filament/resources/pacient-records', [ListPatientRecords::class, 'index'])
    ->name('filament.resources.pacient-records.index');*/

/*Route::get('admin/patient-records', [PatientRecordResource::class, 'index'])
    ->name('filament.resources.patient-records.index');*/
