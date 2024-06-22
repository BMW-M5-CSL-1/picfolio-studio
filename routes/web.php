<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StakeholderManagementController;
use App\Http\Controllers\TrashController;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\post;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'permission']], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Roles
    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::group(['prefix' => '/{id}'], function () {
            Route::get('/edit', [RoleController::class, 'edit'])->name('edit');
            Route::post('/update', [RoleController::class, 'update'])->name('update');
            Route::post('/destroy', [RoleController::class, 'destroy'])->name('destroy');
        });
    });
    // Permissions
    Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::get('create', [PermissionController::class, 'create'])->name('create');
        Route::post('store', [PermissionController::class, 'store'])->name('store');

        Route::get('delete-selected', [PermissionController::class, 'destroySelected'])->name('destroy-selected');
        Route::group(['prefix' => '/{id}'], function () {
            Route::get('edit', [PermissionController::class, 'edit'])->name('edit');
            Route::put('update', [PermissionController::class, 'update'])->name('update');

            Route::get('delete', [PermissionController::class, 'destroy'])->name('destroy');
        });
        Route::post('assign-permission', [PermissionController::class, 'assignPermissionToRole'])->name(
            'assign-permission'
        );
        Route::post('revoke-permission', [PermissionController::class, 'revokePermissionToRole'])->name(
            'revoke-permission'
        );
    });

    // Stakeholders
    Route::group(['prefix' => 'stakeholders', 'as' => 'stakeholders.'], function () {
        Route::get('/', [StakeholderManagementController::class, 'index'])->name('index');
        Route::post('/store', [StakeholderManagementController::class, 'store'])->name('store');
        Route::group(['prefix' => '{id}'], function () {
            Route::post('/update', [StakeholderManagementController::class, 'update'])->name('update');
            Route::post('/destroy', [StakeholderManagementController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'ajax', 'as' => 'ajax-'], function () {
            Route::group(['prefix' => '{id}'], function () {
                Route::post('/action-buttons', [StakeholderManagementController::class, 'action_buttons'])->name('action-buttons');
                Route::post('/get-user-data', [StakeholderManagementController::class, 'get_user_data'])->name('get-user-data');
            });
        });
    });


    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/{id}', [ProfileController::class, 'edit'])->name('edit');
        // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// Order
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::group(['prefix' => 'ajax', 'as' => 'ajax-'], function () {
        });
    });

    Route::group(['prefix' => 'gallery', 'as' => 'gallery.'], function () {
        Route::get('/', function () {
            return view('app.gallery.index');
        })->name('index');
        Route::get('create', function () {
            return view('app.gallery.create');
        })->name('create');
        Route::group(['prefix' => 'ajax', 'as' => 'ajax-'], function () {
            Route::get('/details', function () {
                return false;
            })->name('details');
        });
    });
});

require __DIR__ . '/auth.php';
