<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\BlotterController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\OrdinanceController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TyphoonController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('residents', ResidentController::class);
    Route::resource('households', HouseholdController::class);
    Route::resource('certificates', CertificateController::class)->except(['edit', 'create']);
    Route::resource('transactions', TransactionController::class);
    Route::resource('blotters', BlotterController::class);
    Route::resource('ordinances', OrdinanceController::class);
    Route::resource('assets', AssetController::class);
    Route::get('officials', [OfficialController::class, 'index'])->name('officials.index');
    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('calendar/create', [CalendarController::class, 'create'])->name('calendar.create');
    Route::get('calendar/view', [CalendarController::class, 'view'])->name('calendar.view');
    Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');
    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::patch('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('api/typhoon-live', [TyphoonController::class, 'live'])->name('typhoon.live');
    Route::resource('typhoons', TyphoonController::class);
});

require __DIR__.'/auth.php';
