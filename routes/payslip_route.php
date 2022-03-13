<?php

use App\Http\Controllers\payslipsystem\auth_controller;
use App\Http\Controllers\payslipsystem\dashboard_controller;
use App\Http\Controllers\payslipsystem\print_controller;
use App\Http\Middleware\AuthPayslipCheck;
use Illuminate\Support\Facades\Route;


Route::prefix('payslip')->group(function () {
    Route::get('/', [auth_controller::class, 'index'])->name('payslip.auth.index');
    Route::post('/login', [auth_controller::class, 'login'])->name('payslip.auth.login');
    Route::post('/check-emp', [auth_controller::class, 'check_emp'])->name('payslip.auth.check-emp');
    Route::middleware(AuthPayslipCheck::class)->group(function () {
        Route::get('/logout', [auth_controller::class, 'logout'])->name('payslip.auth.logout');
        Route::get('/dashboard', [dashboard_controller::class, 'index'])->name('payslip.dashboard.index');
        Route::post('/print-slip2', [print_controller::class, 'slip2'])->name('payslip.slip.print2');

    });
    Route::post('/print-slip1', [print_controller::class, 'slip1'])->name('payslip.slip.print1');
});
?>
