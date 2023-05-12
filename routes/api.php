<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AnnualController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DeploymentController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExecutionController;
use App\Http\Controllers\OffdayController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RosterController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\WarningController;

Route::controller(PayrollController::class)->group(function () {
    Route::prefix('payroll/')->group(function(){
        Route::controller(RankController::class)->group(function () {
            Route::get('ranks', 'index');
            Route::post('rank', 'store');
            Route::get('rank/{id}', 'show');
            Route::put('rank/{id}', 'update');
            Route::delete('rank/{id}', 'destroy');
        }); 

        Route::controller(BankController::class)->group(function () {
            Route::get('banks', 'index');
            Route::post('bank', 'store');
            Route::get('bank/{id}', 'show');
            Route::put('bank/{id}', 'update');
            Route::delete('bank/{id}', 'destroy');
        }); 

        Route::controller(TodoController::class)->group(function () {
            Route::get('todos', 'index');
            Route::post('todo', 'store');
            Route::get('todo/{id}', 'show');
            Route::put('todo/{id}', 'update');
            Route::delete('todo/{id}', 'destroy');
        });
        
        Route::controller(DeploymentController::class)->group(function(){
            Route::get('offices', 'index');
            Route::post('office', 'store');
            Route::get('office/{id}', 'show');
            Route::put('office/{id}', 'update');
            Route::delete('office/{id}', 'destroy');
        });
        
        Route::controller(AreaController::class)->group(function(){
            Route::get('areas', 'index');
            Route::post('area', 'store');
            Route::get('area/{id}', 'show');
            Route::put('area/{id}', 'update');
            Route::delete('area/{id}', 'destroy');
        });
        
        Route::controller(RegionController::class)->group(function(){
            Route::get('regions', 'index');
            Route::post('region', 'store');
            Route::get('region/{id}', 'show');
            Route::put('region/{id}', 'update');
            Route::delete('region/{id}', 'destroy');
        });
    
        Route::controller(ContractController::class)->group(function(){
            Route::get('contracts', 'index');
            Route::get('contract/{id}', 'show');
            Route::post('contract', 'store');
            Route::put('contract/{id}', 'update');
            Route::delete('contract/{id}', 'destroy');
        });
    
        Route::controller(DepartmentController::class)->group(function(){
            Route::get('departments', 'index');
            Route::get('department/{id}', 'show');
            Route::post('department', 'store');
            Route::put('department/{id}', 'update');
            Route::delete('department/{id}', 'destroy');
        });
    
        Route::controller(EducationController::class)->group(function(){
            Route::get('educations', 'index');
            Route::get('education/{id}', 'show');
            Route::post('education', 'store');
            Route::put('education/{id}', 'update');
            Route::delete('education/{id}', 'destroy');
        });
    
        Route::controller(RoleController::class)->group(function(){
            Route::get('roles', 'index');
            Route::get('role/{id}', 'show');
            Route::post('role', 'store');
            Route::put('role/{id}', 'update');
            Route::delete('role/{id}', 'destroy');
        });
    
        Route::controller(PositionController::class)->group(function () {
            Route::get('positions', 'index');
            Route::get('position/{id}', 'show');
            Route::post('position', 'store');
            Route::put('position/{id}', 'update');
            Route::delete('position/{id}', 'destroy');
        });
    
        Route::controller(SalaryController::class)->group(function () {
            Route::get('salaries', 'index');
            Route::get('salary/{id}', 'show');
            Route::post('salary', 'store');
            Route::put('salary/{id}', 'update');
            Route::delete('salary/{id}', 'destroy');
        });
    });
    Route::get('payrolls', 'index');
    Route::post('payroll', 'store');
    Route::get('payroll/{id}', 'show');
    Route::put('payroll/{id}', 'update');
    Route::delete('payroll/{id}', 'destroy');
}); 

Route::controller(AttendanceController::class)->group(function(){
    Route::prefix('attendance/')->group(function(){
        Route::controller(AbsenceController::class)->group(function(){
            Route::get('absences', 'index');
            Route::get('absence/{id}', 'show');
            Route::post('absence', 'store');
            Route::put('absence/{id}', 'update');
            Route::delete('absence/{id}', 'destroy');
        });
    
        Route::controller(StatusController::class)->group(function(){
            Route::get('statuses', 'index');
            Route::get('status/{id}', 'show');
            Route::post('status', 'store');
            Route::put('status/{id}', 'update');
            Route::delete('status/{id}', 'destroy');
        });
    });
    Route::get('attendances', 'index');
    Route::get('attendance/{id}', 'show');
    Route::get('attendance', 'uShow');
    Route::post('attendance', 'store');
    Route::delete('attendances/{id}', 'destroy');
});

Route::controller(OvertimeController::class)->group(function(){
    Route::prefix('overtime/')->group(function(){
        Route::controller(RosterController::class)->group(function(){
            Route::get('rosters', 'index');
            Route::get('roster/{id}', 'show');
            Route::post('roster', 'store');
            Route::put('roster/{id}', 'update');
            Route::delete('roster/{id}', 'destroy');
        });
    });
    Route::get('overtimes', 'index');
    Route::get('overtime/{id}', 'show');
    Route::post('overtime', 'store');
    Route::put('overtime/{id}', 'update');
    Route::delete('overtime/{id}', 'destroy');
});

Route::controller(ReportController::class)->group(function(){
    Route::prefix('report/')->group(function(){
        Route::controller(ClassificationController::class)->group(function(){
            Route::get('classifications', 'index');
            Route::get('classification/{id}', 'show');
            Route::post('classification', 'store');
            Route::put('classification/{id}', 'update');
            Route::delete('classification/{id}', 'destroy');
        });
    });
    Route::get('reports', 'index');
    Route::get('report/{id}', 'show');
    Route::post('report', 'store');
    Route::put('report/{id}', 'update');
    Route::delete('report/{id}', 'destroy');
});

Route::controller(OffdayController::class)->group(function(){
    Route::prefix('offday/')->group(function(){
        Route::controller(AnnualController::class)->group(function(){
            Route::get('annuals', 'index');
            Route::get('annual/{id}', 'show');
            Route::post('annual', 'store');
            Route::put('annual/{id}', 'update');
            Route::delete('annual/{id}', 'destroy');
        });
    });
    Route::get('offdays', 'index');
    Route::get('offday/{id}', 'show');
    Route::post('offday', 'store');
    Route::put('offday/{id}', 'update');
    Route::delete('offday/{id}', 'destroy');
});

Route::controller(ExecutionController::class)->group(function(){
    Route::prefix('execution/')->group(function(){
        Route::controller(WarningController::class)->group(function(){
            Route::get('warnings', 'index');
            Route::get('warning/{id}', 'show');
            Route::post('warning', 'store');
            Route::put('warning/{id}', 'update');
            Route::delete('warning/{id}', 'destroy');
        });
    });
    Route::get('executions', 'index');
    Route::get('execution/{id}', 'show');
    Route::post('execution', 'store');
    Route::put('execution/{id}', 'update');
    Route::delete('execution/{id}', 'destroy');
});

Route::prefix('auth')->group(function(){
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::post('me', 'me');
        Route::put('user-update/{id}', 'update');
        Route::delete('user-delete/{id}', 'destroy');
        Route::get('user/{id}', 'show');
    });
    
    Route::controller(TypeController::class)->group(function () {
        Route::get('types', 'index');
        Route::get('type/{id}', 'show');
        Route::post('type', 'store');
        Route::put('type/{id}', 'update');
        Route::delete('type/{id}', 'destroy');
    });
});
