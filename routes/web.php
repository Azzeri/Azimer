<?php

use App\Http\Controllers\EqFillController;
use App\Http\Controllers\EqItemCategoryController;
use App\Http\Controllers\EqItemController;
use App\Http\Controllers\EqItemTemplateController;
use App\Http\Controllers\EqServiceController;
use App\Http\Controllers\EqServiceTemplateController;
use App\Http\Controllers\EqUsageController;
use App\Http\Controllers\FireBrigadeUnitController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('/manufacturers', ManufacturerController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource('/roles', RoleController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource('/users', UserController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource('/fireBrigadeUnits', FireBrigadeUnitController::class)
        ->only(['index', 'store', 'update', 'destroy', 'show']);

    Route::resource('/vehicles', VehicleController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource('/eqItemCategories', EqItemCategoryController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource('/eqItemTemplates', EqItemTemplateController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource('/eqItems', EqItemController::class)
        ->only(['index', 'show', 'store', 'update', 'destroy']);

    Route::put('eqItems/activateService/{eqItem}', [EqItemController::class, 'activateService'])
        ->name('eqItems.activateService');

    Route::resource('/eqServiceTemplates', EqServiceTemplateController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::put('eqServices/finish/{eqService}', [EqServiceController::class, 'finish'])
        ->name('eqServices.finish');

    Route::resource('/eqUsages', EqUsageController::class)
        ->only(['store']);

    Route::resource('/eqFills', EqFillController::class)
        ->only(['store']);
});
