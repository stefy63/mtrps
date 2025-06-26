<?php

use App\Http\Controllers\AssigneeOfficeController;
use App\Http\Controllers\CarAssigneeController;
use App\Http\Controllers\CarBrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarEquipmentController;
use App\Http\Controllers\CarFuelController;
use App\Http\Controllers\CarOwnerController;
use App\Http\Controllers\CarPlateController;
use App\Http\Controllers\CarPowerController;
use App\Http\Controllers\CarProfitAccountController;
use App\Http\Controllers\CarSetupController;
use App\Http\Controllers\CarTypeController;
use App\Http\Controllers\CigController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MaintenanceGarageController;
use App\Http\Controllers\MaintenanceTypeController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('cars', CarController::class);
    Route::resource('car-types', CarTypeController::class);
    Route::resource('car-owners', CarOwnerController::class);
    Route::resource('car-assignees', CarAssigneeController::class);
    Route::get('car-assignees-current', [CarAssigneeController::class, 'current'])->name('car-assignees.current');
   Route::get('car-assignees/vehicle/{car}', [CarAssigneeController::class, 'getByVehicle'])->name('car-assignees.by-vehicle');
   Route::get('car-assignees/vehicle/{car}/history', [CarAssigneeController::class, 'vehicleHistory'])->name('car-assignees.vehicle-history');
   Route::get('api/car-assignees/check-overlaps', [CarAssigneeController::class, 'checkOverlaps'])->name('car-assignees.check-overlaps');
    Route::resource('car-brands', CarBrandController::class);
    Route::resource('car-powers', CarPowerController::class);
    Route::resource('car-profit-accounts', CarProfitAccountController::class);
    Route::prefix('car-profit-accounts')->name('car-profit-accounts.')->group(function () {
        // Toggle active status
        Route::patch('{car_profit_account}/toggle-active', [CarProfitAccountController::class, 'toggleActive'])->name('toggleActive');

        // Export CSV
        Route::get('export', [CarProfitAccountController::class, 'export'])->name('export');
    });
    Route::resource('car-setups', CarSetupController::class);
    Route::get('/car-setups/suggestions', [CarSetupController::class, 'getSuggestions'])->name('car-setups.suggestions');
    Route::get('/car-setups/check-conflicts', [CarSetupController::class, 'checkConflicts'])->name('car-setups.check-conflicts');
    Route::resource('car-plates', CarPlateController::class);
    Route::resource('assignee-offices', AssigneeOfficeController::class);
    Route::resource('car-equipments', CarEquipmentController::class);
    Route::resource('movements', MovementController::class);
    Route::prefix('movements')->name('movements.')->group(function () {
        // Update status
        Route::patch('{movement}/status', [MovementController::class, 'updateStatus'])->name('updateStatus');

        // Check availability (AJAX)
        Route::post('check-availability', [MovementController::class, 'checkAvailability'])->name('checkAvailability');

        // Get last km (AJAX)
        Route::get('last-km', [MovementController::class, 'getLastKm'])->name('getLastKm');
    });
    Route::resource('maintenances', MaintenanceController::class);
    Route::resource('car-fuels', CarFuelController::class);
    Route::get('car-fuels/suggestions', [App\Http\Controllers\CarFuelController::class, 'suggestions'])->name('car-fuels.suggestions');
Route::get('car-fuels/statistics/{car}', [App\Http\Controllers\CarFuelController::class, 'statistics'])->name('car-fuels.statistics');
    Route::resource('maintenance-garages', MaintenanceGarageController::class);
    Route::resource('maintenance-types', MaintenanceTypeController::class);
    Route::resource('cigs', CigController::class);
});

require __DIR__ . '/auth.php';

Auth::routes();

