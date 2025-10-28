<?php

use App\Http\Controllers\ExcelExportController;
use App\Http\Middleware\adminCheck;
use App\Http\Middleware\confirmPassword;
use Illuminate\Support\Facades\Route;
use App\Exports\excel_export;
use App\Imports\ExcelExportImport;
use Maatwebsite\Excel\Facades\Excel;

Route::middleware('auth', adminCheck::class)->group(function () {
    
    Route::resource('excel_export', ExcelExportController::class)->middleware(adminCheck::class);

    Route::get("excel_export/delete/{id}", [ExcelExportController::class, 'destroy'])->name('purchases.delete')->middleware(confirmPassword::class);

    Route::get('excel_export/export/{id}', [ExcelExportController::class, 'export'])->name('excel_export.export');
    
    Route::post('excel_export/import', [ExcelExportController::class, 'import'])->name('excel_export.import');
});
