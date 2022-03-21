<?php

use App\Http\Controllers\auth_controller;
use App\Http\Controllers\dashboard_controller;
use App\Http\Controllers\jv_emptrucker_controller;
use App\Http\Controllers\jv_mapaccount_controller;
use App\Http\Controllers\jv_tranfer_controller;
use App\Http\Controllers\jv_payroll_controller;
use App\Http\Controllers\test_controller;
use App\Http\Controllers\user_controller;
use App\Http\Controllers\export_controller;
use App\Http\Controllers\log_controller;
use App\Http\Controllers\pay_slip_controller;
use App\Http\Controllers\printslip_controller;
use App\Http\Controllers\trucker_period_controller;
use App\Http\Controllers\preparation_controller;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [auth_controller::class, 'index'])->name('auth.index');
Route::post('/login', [auth_controller::class, 'login'])->name('auth.login');
Route::middleware(AuthCheck::class)->group(function () {

    Route::get('/logout', [auth_controller::class, 'logout'])->name('auth.logout');

    Route::get('/dashboard', [dashboard_controller::class, 'index'])->name('dashboard.index');

    Route::get('/setting/user', [user_controller::class, 'index'])->name('user.index');
    Route::post('/setting/user/lists', [user_controller::class, 'lists'])->name('user.lists');
    Route::post('/setting/user/store', [user_controller::class, 'store'])->name('user.store');
    Route::post('/setting/user/edit', [user_controller::class, 'edit'])->name('user.edit');
    Route::post('/setting/user/update', [user_controller::class, 'update'])->name('user.update');
    Route::post('/setting/user/destroy', [user_controller::class, 'destroy'])->name('user.destroy');
    Route::post('/setting/user/get-role', [user_controller::class, 'get_role'])->name('user.get-role');
    Route::post('/setting/user/store-role', [user_controller::class, 'store_role'])->name('user.store-role');

    Route::get('/empoyee/import-file1', [jv_tranfer_controller::class, 'import_file1'])->name('jv-tranfer.import-file1');
    Route::post('/empoyee/import-file1/store', [jv_tranfer_controller::class, 'import_file1_store'])->name('jv-tranfer.import-file1.store');
    Route::post('/empoyee/import-file1/lists1', [jv_tranfer_controller::class, 'import_file1_lists1'])->name('jv-tranfer.import-file1.lists1');
    Route::post('/empoyee/import-file1/lists2', [jv_tranfer_controller::class, 'import_file1_lists2'])->name('jv-tranfer.import-file1.lists2');
    Route::get('/jv-tranfer/import-emptrucker', [jv_emptrucker_controller::class, 'index'])->name('jv-tranfer.emptrucker');
    Route::post('/jv-tranfer/import-emptrucker/store', [jv_emptrucker_controller::class, 'store'])->name('jv-tranfer.emptrucker.store');
    Route::post('/jv-tranfer/import-emptrucker/lists', [jv_emptrucker_controller::class, 'lists'])->name('jv-tranfer.emptrucker.lists');
    Route::get('/empoyee/import-file2', [jv_tranfer_controller::class, 'import_file2'])->name('jv-tranfer.import-file2');
    Route::post('/empoyee/import-file2/store', [jv_tranfer_controller::class, 'import_file2_store'])->name('jv-tranfer.import-file2.store');
    Route::post('/empoyee/import-file2/lists', [jv_tranfer_controller::class, 'import_file2_lists'])->name('jv-tranfer.import-file2.lists');
    Route::get('/jv-tranfer/import-file3', [jv_tranfer_controller::class, 'import_file3'])->name('jv-tranfer.import-file3');
    Route::post('/jv-tranfer/import-file3/store', [jv_tranfer_controller::class, 'import_file3_store'])->name('jv-tranfer.import-file3.store');
    Route::post('/jv-tranfer/import-file3/lists', [jv_tranfer_controller::class, 'import_file3_lists'])->name('jv-tranfer.import-file3.lists');
    Route::post('/jv-tranfer/import-file3/check', [jv_tranfer_controller::class, 'import_file3_check'])->name('jv-tranfer.import-file3.check');
    Route::get('/jv-tranfer/import-file4', [jv_tranfer_controller::class, 'import_file4'])->name('jv-tranfer.import-file4');
    Route::post('/jv-tranfer/import-file4/store', [jv_tranfer_controller::class, 'import_file4_store'])->name('jv-tranfer.import-file4.store');
    Route::post('/jv-tranfer/import-file4/lists', [jv_tranfer_controller::class, 'import_file4_lists'])->name('jv-tranfer.import-file4.lists');

    Route::get('/empoyee/import-file5', [jv_tranfer_controller::class, 'import_file5'])->name('jv-tranfer.import-file5');
    Route::post('/empoyee/import-file5/store', [jv_tranfer_controller::class, 'import_file5_store'])->name('jv-tranfer.import-file5.store');
    Route::post('/empoyee/import-file5/lists', [jv_tranfer_controller::class, 'import_file5_lists'])->name('jv-tranfer.import-file5.lists');

    Route::get('/jv-payroll/import-file6', [jv_tranfer_controller::class, 'import_file6'])->name('jv-tranfer.import-file6');
    Route::post('/jv-payroll/import-file6/store', [jv_tranfer_controller::class, 'import_file6_store'])->name('jv-tranfer.import-file6.store');
    Route::post('/jv-payroll/import-file6/lists', [jv_tranfer_controller::class, 'import_file6_lists'])->name('jv-tranfer.import-file6.lists');


    Route::get('/jv-tranfer/report', [jv_tranfer_controller::class, 'report'])->name('jv-tranfer.report');
    Route::get('/jv-tranfer/report-check', [jv_tranfer_controller::class, 'report_check'])->name('jv-tranfer.report-check');
    Route::post('/jv-tranfer/report-lists', [jv_tranfer_controller::class, 'report_lists'])->name('jv-tranfer.report-lists');
    Route::post('/jv-tranfer/report-process', [jv_tranfer_controller::class, 'report_process'])->name('jv-tranfer.report-process');

    Route::get('/jv-tranfer/report-tranfer-daily', [jv_tranfer_controller::class, 'report_tranfer_daily'])->name('jv-tranfer.report-tranfer-daily');
    Route::post('/jv-tranfer/report-tranfer-daily-process', [jv_tranfer_controller::class, 'report_tranfer_daily_process'])->name('jv-tranfer.report-tranfer-daily-process');
    Route::get('/jv-tranfer/report-tranfer-daily-check', [jv_tranfer_controller::class, 'report_tranfer_daily_check'])->name('jv-tranfer.report-tranfer-daily-check');
    Route::post('/jv-tranfer/report-tranfer-daily-lists', [jv_tranfer_controller::class, 'report_tranfer_daily_lists'])->name('jv-tranfer.report-tranfer-daily-lists');

    Route::get('/jv-accrue/report-accrue-daily', [jv_tranfer_controller::class, 'report_accrue_daily'])->name('jv-tranfer.report-accrue-daily');
    Route::post('/jv-accrue/report-accrue-daily-process', [jv_tranfer_controller::class, 'report_accrue_daily_process'])->name('jv-tranfer.report-accrue-daily-process');
    Route::get('/jv-accrue/report-accrue-daily-check', [jv_tranfer_controller::class, 'report_accrue_daily_check'])->name('jv-tranfer.report-accrue-daily-check');
    Route::post('/jv-accrue/report-accrue-daily-lists', [jv_tranfer_controller::class, 'report_accrue_daily_lists'])->name('jv-tranfer.report-accrue-daily-lists');

    Route::get('/jv-payroll/payroll-import', [jv_payroll_controller::class, 'import'])->name('jv-payroll.import');
    Route::post('/jv-payroll/payroll-import/store', [jv_payroll_controller::class, 'store'])->name('jv-payroll.import.store');
    Route::post('/jv-payroll/payroll-import/lists', [jv_payroll_controller::class, 'lists'])->name('jv-payroll.import.lists');
    Route::get('/jv-payroll/payroll-period', [jv_payroll_controller::class, 'payroll_period'])->name('jv-payroll.payroll-period');
    Route::post('/jv-payroll/payroll-period/store', [jv_payroll_controller::class, 'payroll_period_store'])->name('jv-payroll.payroll-period.store');
    Route::post('/jv-payroll/payroll-period/lists', [jv_payroll_controller::class, 'payroll_period_lists'])->name('jv-payroll.payroll-period.lists');
    Route::get('/empoyee/mapaccount-import', [jv_mapaccount_controller::class, 'import'])->name('jv-mapaccount.import');
    Route::post('/empoyee/mapaccount-import/store', [jv_mapaccount_controller::class, 'store'])->name('jv-mapaccount.import.store');
    Route::post('/empoyee/mapaccount-import/lists', [jv_mapaccount_controller::class, 'lists'])->name('jv-mapaccount.import.lists');
    Route::post('/empoyee/mapaccount-import/edit', [jv_mapaccount_controller::class, 'edit'])->name('jv-mapaccount.import.edit');
    Route::post('/empoyee/mapaccount-import/update', [jv_mapaccount_controller::class, 'update'])->name('jv-mapaccount.import.update');
    Route::post('/empoyee/mapaccount-import/destroy', [jv_mapaccount_controller::class, 'destroy'])->name('jv-mapaccount.import.destroy');
    Route::get('/empoyee/report', [jv_payroll_controller::class, 'report'])->name('jv-payroll.report');

    Route::get('/trucker/trucker-period', [trucker_period_controller::class, 'index'])->name('trucker.trucker-period');
    Route::post('/trucker/trucker-period/store', [trucker_period_controller::class, 'store'])->name('trucker.trucker-period.store');
    Route::post('/trucker/trucker-period/lists', [trucker_period_controller::class, 'lists'])->name('trucker.trucker-period.lists');

    Route::get('/pay-slip/payslip', [pay_slip_controller::class, 'index'])->name('pay-slip.index');
    Route::post('/pay-slip/payslip/store', [pay_slip_controller::class, 'store'])->name('pay-slip.store');
    Route::post('/pay-slip/payslip/lists', [pay_slip_controller::class, 'lists'])->name('pay-slip.lists');

    Route::get('/export/manhour-period', [export_controller::class, 'manhour_period'])->name('export-manhour-period');
    Route::post('/export/manhour-period-lists', [export_controller::class, 'manhour_period_lists'])->name('export-manhour-period-lists');
    Route::post('/export/export-manhour-period', [export_controller::class, 'export_manhour_period'])->name('export.export-manhour-period');
    Route::get('/export/accrue-daily', [export_controller::class, 'accrue_daily'])->name('export.accrue-daily');
    Route::post('/export/accrue-daily-lists', [export_controller::class, 'accrue_daily_lists'])->name('export.accrue-daily-lists');
    Route::post('/export/export-accrue-daily', [export_controller::class, 'export_accrue_daily'])->name('export.export-accrue-daily');

    Route::get('/export/trucker-period', [export_controller::class, 'trucker_period'])->name('export-trucker-period');
    Route::post('/export/trucker-period-lists', [export_controller::class, 'trucker_period_lists'])->name('export-trucker-period-lists');
    Route::post('/export/export-trucker-period', [export_controller::class, 'export_trucker_period'])->name('export.export-trucker-period');

    Route::get('/export/accrue-hour-pp', [export_controller::class, 'accrue_hour_pp'])->name('export.accrue-hour-pp');
    Route::post('/export/accrue-hour-pp-lists', [export_controller::class, 'accrue_hour_pp_lists'])->name('export.accrue-hour-pp-lists');
    Route::post('/export/export-accrue-hour-pp', [export_controller::class, 'export_accrue_hour_pp'])->name('export.export-accrue-hour-pp');
    Route::get('/export/accrue-hour-co', [export_controller::class, 'accrue_hour_co'])->name('export.accrue-hour-co');
    Route::post('/export/accrue-hour-co-lists', [export_controller::class, 'accrue_hour_co_lists'])->name('export.accrue-hour-co-lists');
    Route::post('/export/export-accrue-hour-co', [export_controller::class, 'export_accrue_hour_co'])->name('export.export-accrue-hour-co');

    Route::get('/report/log', [log_controller::class, 'index'])->name('log.index');
    Route::post('/report/log/lists', [log_controller::class, 'lists'])->name('log.lists');

    Route::get('/print-slip', [printslip_controller::class, 'index'])->name('print-slip.index');
    Route::post('/print-slip/check-emp', [printslip_controller::class, 'check_emp'])->name('print-slip.check-emp');
    Route::post('/print-slip/get-date', [printslip_controller::class, 'get_date'])->name('print-slip.get-date');
    Route::post('/print-slip/print', [printslip_controller::class, 'print'])->name('print-slip.print');

    Route::get('/preparation/index', [preparation_controller::class, 'index'])->name('preparation.index');
    Route::post('/preparation/store', [preparation_controller::class, 'store'])->name('preparation.store');
    Route::post('/preparation/lists', [preparation_controller::class, 'lists'])->name('preparation.lists');
    Route::post('/preparation/edit', [preparation_controller::class, 'edit'])->name('preparation.edit');
    Route::post('/preparation/update', [preparation_controller::class, 'update'])->name('preparation.update');
    Route::post('/preparation/destroy', [preparation_controller::class, 'destroy'])->name('preparation.destroy');
    Route::post('/preparation/check-data', [preparation_controller::class, 'check_data'])->name('preparation.check-data');
    Route::post('/preparation/get-org', [preparation_controller::class, 'get_org'])->name('preparation.get-org');
});

Route::get('/test', [test_controller::class, 'index'])->name('test.index');
