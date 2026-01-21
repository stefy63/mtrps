<?php

use App\Http\Controllers\AssigneeOfficeController;
use App\Http\Controllers\AutoUpdateController;
use App\Http\Controllers\CarAssigneeController;
use App\Http\Controllers\CarBrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarTypologyController;
use App\Http\Controllers\EmploymentCodeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\CarFuelController;
use App\Http\Controllers\CarOwnerController;
use App\Http\Controllers\CarPlateController;
use App\Http\Controllers\CarPowerController;
use App\Http\Controllers\CarProfitAccountController;
use App\Http\Controllers\CarSetupController;
use App\Http\Controllers\CarTypeController;
use App\Http\Controllers\CigController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MaintenanceGarageController;
use App\Http\Controllers\MaintenanceTypeController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('auto-update', AutoUpdateController::class)->name('auto-update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//    Rotte per le modali dinamiche
    Route::get('car/get-form', [CarController::class, 'getForm'])->name('car.getForm');
    Route::post('car/store-form', [CarController::class, 'storeForm'])->name('car.storeForm');
    Route::get('car-types/get-form', [CarTypeController::class, 'getForm'])->name('car-types.getForm');
    Route::post('car-types/store-form', [CarTypeController::class, 'storeForm'])->name('car-types.storeForm');
    Route::get('car-owners/get-form', [CarOwnerController::class, 'getForm'])->name('car-owners.getForm');
    Route::post('car-owners/store-form', [CarOwnerController::class, 'storeForm'])->name('car-owners.storeForm');
    Route::get('car-brands/get-form', [CarBrandController::class, 'getForm'])->name('car-brands.getForm');
    Route::post('car-brands/store-form', [CarBrandController::class, 'storeForm'])->name('car-brands.storeForm');
    Route::get('car-powers/get-form', [CarPowerController::class, 'getForm'])->name('car-powers.getForm');
    Route::post('car-powers/store-form', [CarPowerController::class, 'storeForm'])->name('car-powers.storeForm');
    Route::get('car-profit-accounts/get-form',
        [CarProfitAccountController::class, 'getForm'])->name('car-profit-accounts.getForm');
    Route::post('car-profit-accounts/store-form',
        [CarProfitAccountController::class, 'storeForm'])->name('car-profit-accounts.storeForm');
    Route::get('car-plates/get-form', [CarPlateController::class, 'getForm'])->name('car-plates.getForm');
    Route::post('car-plates/store-form', [CarPlateController::class, 'storeForm'])->name('car-plates.storeForm');
    Route::get('offices/get-form', [OfficeController::class, 'getForm'])->name('offices.getForm');
    Route::post('offices/store-form', [OfficeController::class, 'storeForm'])->name('offices.storeForm');
    Route::get('movements/get-form', [MovementController::class, 'getForm'])->name('movement.getForm');
    Route::post('movements/store-form', [MovementController::class, 'storeForm'])->name('movement.storeForm');
    Route::get('maintenance-garages/get-form',
        [MaintenanceGarageController::class, 'getForm'])->name('maintenance-garage.getForm');
    Route::post('maintenance-garages/store-form',
        [MaintenanceGarageController::class, 'storeForm'])->name('maintenance-garage.storeForm');
    Route::get('maintenance-types/get-form',
        [MaintenanceTypeController::class, 'getForm'])->name('maintenance-type.getForm');
    Route::post('maintenance-types/store-form',
        [MaintenanceTypeController::class, 'storeForm'])->name('maintenance-type.storeForm');
    Route::get('maintenances/get-form', [MaintenanceController::class, 'getForm'])->name('maintenance.getForm');
    Route::post('maintenances/store-form', [MaintenanceController::class, 'storeForm'])->name('maintenance.storeForm');
    Route::get('equipments/get-form', [EquipmentController::class, 'getForm'])->name('equipments.getForm');
    Route::post('equipments/store-form', [EquipmentController::class, 'storeForm'])->name('equipments.storeForm');
    Route::get('employment-code/get-form', [EmploymentCodeController::class, 'getForm'])->name('employment-code.getForm');
    Route::post('employment-code/store-form', [EmploymentCodeController::class, 'storeForm'])->name('employment-code.storeForm');
    Route::get('car-typology/get-form', [CarTypologyController::class, 'getForm'])->name('car-typology.getForm');
    Route::post('car-typology/store-form', [CarTypologyController::class, 'storeForm'])->name('car-typology.storeForm');
    Route::get('cigs/get-form', [CigController::class, 'getForm'])->name('cig.getForm');
    Route::post('cigs/store-form', [CigController::class, 'storeForm'])->name('cig.storeForm');
    Route::get('users/get-form', [UserController::class, 'getForm'])->name('users.getForm')->middleware('role:admin');
    Route::post('users/store-form', [UserController::class, 'storeForm'])->name('users.storeForm')->middleware('role:admin');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class)->names('users');
    Route::resource('cars', CarController::class)->names('cars');
    Route::resource('car-types', CarTypeController::class)->names('car-types');
    Route::resource('car-owners', CarOwnerController::class)->names('car-owners');
    Route::resource('car-assignees', CarAssigneeController::class)->names('car-assignees');
    Route::get('car-assignees-current', [CarAssigneeController::class, 'current'])->name('car-assignees.current');
    Route::resource('car-brands', CarBrandController::class)->names('car-brands');
    Route::resource('car-powers', CarPowerController::class)->names('car-powers');
    Route::resource('car-profit-accounts', CarProfitAccountController::class)->names('car-profit-accounts');
    Route::prefix('car-profit-accounts')->name('car-profit-accounts.')->group(function () {
        // Toggle active status
        Route::patch('{car_profit_account}/toggle-active',
            [CarProfitAccountController::class, 'toggleActive'])->name('toggleActive');

        // Export CSV
        Route::get('export', [CarProfitAccountController::class, 'export'])->name('export');
    });
    Route::resource('car-setups', CarSetupController::class)->names('car-setups');
    Route::get('/car-setups/suggestions',
        [CarSetupController::class, 'getSuggestions'])->name('car-setups.suggestions');
    Route::get('/car-setups/check-conflicts',
        [CarSetupController::class, 'checkConflicts'])->name('car-setups.check-conflicts');
    Route::resource('car-plates', CarPlateController::class)->names('car-plates');
    Route::resource('assignee-offices', AssigneeOfficeController::class)->names('assignee-offices');
    Route::resource('equipments', EquipmentController::class)->names('equipments');
    Route::resource('movements', MovementController::class)->names('movements');
    Route::get('maintenances/suggestions',
        [App\Http\Controllers\MaintenanceController::class, 'suggestions'])->name('maintenances.suggestions');
    Route::get('maintenances/statistics/{car}',
        [App\Http\Controllers\MaintenanceController::class, 'statistics'])->name('maintenances.statistics');
    Route::resource('maintenances', App\Http\Controllers\MaintenanceController::class);


    Route::get('car-fuels/suggestions',
        [App\Http\Controllers\CarFuelController::class, 'suggestions'])->name('car-fuels.suggestions');
    Route::get('car-fuels/statistics/{car}',
        [App\Http\Controllers\CarFuelController::class, 'statistics'])->name('car-fuels.statistics');
    Route::resource('car-fuels', CarFuelController::class)->names('car-fuels');
    Route::resource('maintenance-garages', MaintenanceGarageController::class)->names('maintenance-garages');
    Route::resource('maintenance-types', App\Http\Controllers\MaintenanceTypeController::class)->names('maintenance-types');
    Route::get('cigs/generate', [CigController::class, 'generateCig'])->name('cigs.generate');
    Route::get('cigs/statistics', [CigController::class, 'statistics'])->name('cigs.statistics');
    Route::get('cigs/export', [CigController::class, 'export'])->name('cigs.export');
    Route::resource('cigs', CigController::class)->names('cigs');
    Route::resource('offices', OfficeController::class)->names('offices');
    Route::resource('employment-code', EmploymentCodeController::class)->names('employment-code');
    Route::resource('car-typology', CarTypologyController::class)->names('car-typology');


//    Rotte di import
    Route::get('importsCar', [App\Http\Controllers\ImportCarsController::class, 'index'])->name('car-imports.index');
    Route::get('export/templateCar',
        [App\Http\Controllers\ImportCarsController::class, 'export'])->name('export.template-car');
    Route::post('imports/cars', [App\Http\Controllers\ImportCarsController::class, 'importCars'])->name('imports.cars');

    Route::get('importsKm', [App\Http\Controllers\ImportKmController::class, 'index'])->name('km-imports.index');
    Route::get('export/templateKm',
        [App\Http\Controllers\ImportKmController::class, 'export'])->name('export.template-km');
    Route::post('imports/km', [App\Http\Controllers\ImportKmController::class, 'importKm'])->name('imports.km');
});

require __DIR__.'/auth.php';

Auth::routes();

