<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StakeholderManagementController;
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
        Route::get('/{id}', [ProfileController::class, 'index'])->name('index');
        Route::get('edit/{id}', [ProfileController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [ProfileController::class, 'update'])->name('update');
        Route::group(['prefix' => 'ajax', 'as' => 'ajax-'], function () {
            Route::post('portfolio/store', [PortfolioController::class, 'store'])->name('portfolio-store');
            Route::get('show-work/{id}', [PortfolioController::class, 'showWork'])->name('show-work');
            Route::get('show-project/{id}', [PortfolioController::class, 'showProject'])->name('show-project');
            Route::get('show-certificate/{id}', [PortfolioController::class, 'showCertificate'])->name('show-certificate');
        });
        Route::post('portfolio/delete/{id}/{type}', [PortfolioController::class, 'delete'])->name('portfolio.delete');


        // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::get('create', [EventController::class, 'create'])->name('create');
        Route::post('store', [EventController::class, 'store'])->name('store');
        Route::get('edit/{id}', [EventController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [EventController::class, 'update'])->name('update');
        Route::post('delete/{id}', [EventController::class, 'delete'])->name('delete');
        Route::post('publish/{id}', [EventController::class, 'publish'])->name('publish');
        Route::post('raise-offer/{id}', [EventController::class, 'raiseOffer'])->name('raise-offer');
        Route::post('hire-photographer', [EventController::class, 'hirePhotographer'])->name('hire-photographer');
        Route::post('cancel-photographer', [EventController::class, 'cancelPhotographer'])->name('cancel-photographer');
        Route::post('lock/{id}', [EventController::class, 'lock'])->name('lock');
        Route::post('close/{id}', [EventController::class, 'close'])->name('close');
        Route::post('cancel/{id}', [EventController::class, 'cancel'])->name('cancel');

        Route::group(['prefix' => 'ajax', 'as' => 'ajax-'], function () {
            Route::post('details/{id}', [EventController::class, 'details'])->name('details');
        });
    });

    Route::group(['prefix' => 'schedule', 'as' => 'schedule.'], function () {
        Route::get('/', [ScheduleController::class, 'getSchedule'])->name('index');
    });

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('update');
        Route::post('delete/{id}', [ProductController::class, 'destroy'])->name('delete');
    });
});

// Order
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::group(['prefix' => 'ajax', 'as' => 'ajax-'], function () {});
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
