<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\PrintReportController;

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/print-reports', [PrintReportController::class, 'index'])->name('dashboard.print-reports.index');
    Route::get('/print-reports/print', [PrintReportController::class, 'print'])->name('dashboard.print-reports.print');
});
