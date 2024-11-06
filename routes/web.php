<?php

use App\Http\Controllers\ReportController;
use App\Http\Middleware\VerifyIsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([VerifyIsAdmin::class])
    ->group(function () {
        Route::get('admin/school_report', [ReportController::class, 'index'])->name('school_report');
        Route::get('admin/school_report/weekly', [ReportController::class, 'weeklyReport']);
        Route::get('admin/school_report/monthly', [ReportController::class, 'monthlyReport']);
        Route::get('admin/school_report/yearly', [ReportController::class, 'yearlyReport']);
    });