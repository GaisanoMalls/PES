<?php

use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Livewire\EditEvaluation;
use App\Livewire\EvaluationForm;
use App\Livewire\ReviewEvaluation;
use Illuminate\Support\Facades\Auth;


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
})->name('dashboard')->middleware('auth');


//Evaluations  / Employee Evaluation List
Route::get('/employee_evaluations', [EmployeeController::class, 'employeesEvaluation'])->name('employees.evaluations');
// Example route definition
Route::get('/employee_evaluations/{employee_id}', [EmployeeController::class, 'employeesEvaluationsView'])->name('employees.evaluations-view');



// Employee Routes

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/employees/{employee_id}/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/{employee_id}', [EmployeeController::class, 'show'])->name('employees.show');
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');




//Employee, view employee evaluations
Route::get('/myevalautions', [EmployeeController::class, 'myevaluations'])->name('employee.myevaluations');



// Evaluation ALL view
Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');
//review evaluation
Route::get('/evaluations/{evaluation}/review', [EvaluationController::class, 'review'])->name('evaluations.review');
//PDF
Route::get('/evaluations/{evaluation}/pdf', [EvaluationController::class, 'generatePDF'])->name('evaluations.pdf');

Route::delete('/delete-evaluation/{id}', [EvaluationController::class, 'deleteEvaluation']);

//select template
Route::get('/evaluations/create/{employeeId}/', [EvaluationController::class, 'selectTemplate'])->name('evaluations.select');

//Create evaluation to employee
Route::get('/evaluations/create/{employeeId}/{template}', [EvaluationController::class, 'create'])->name('evaluations.create');

Route::get('/evaluations/view/{evaluation}', [EvaluationController::class, 'edit'])->name('evaluations.edit');



//TEMPLATES
//view all template
Route::get('/templates', [HRController::class, 'index'])->name('templates.index');
//create template
Route::get('/templates/create', [HRController::class, 'create'])->name('templates.create');
//edit template
Route::get('/templates/{template}/edit', [HRController::class, 'edit'])->name('templates.edit');
//delete template
Route::delete('/templates/{template}', [HRController::class, 'destroy'])->name('templates.destroy');

Route::get('/templates/{evaluation}/pdf', [HRController::class, 'generatePDFTemplate'])->name('templates.generatePDFTemplate');

Route::post('/templates/{id}/update-status', [HRController::class, 'updateStatus'])->name('templates.updateStatus');



//REPORTS
//list of recommended employees
Route::get('/reports/recommended-employees', [ReportsController::class, 'recommended'])->name('reports.reco-employees');
//list of evaluated employees
Route::get('/reports/evaluated-employees', [ReportsController::class, 'evaluated'])->name('reports.list-evaluated');
//list of evaluations employees
Route::get('/reports/evaluation-employees', [ReportsController::class, 'evaluationList'])->name('reports.list-evaluation');




//LARAVEL-UI
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//notfication
Route::get('/update-notification/{id}', [NotificationController::class, 'updateNotification']);

Route::get('/mark-all-as-read', [NotificationController::class, 'markAllAsRead']);


// Show all users
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Create a new user
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

//show specific user
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::patch('/user/{id}', [UserController::class, 'update'])->name('user.update');


//SETTINGS
// Show evalaution permissions
Route::get('/evaluation-permissions', [SettingsController::class, 'evalPerm'])->name('settings.evalperm');
// Show department config (CREATE)
Route::get('/department-configurations/create', [SettingsController::class, 'deptConfig'])->name('settings.deptconfigCreate');

//Show all department configurations
Route::get('/department-configurations', [SettingsController::class, 'deptConfigIndex'])->name('settings.deptconfig');

// Show department config (CREATE)
Route::get('/department-configurations/{id}', [SettingsController::class, 'deptConfigShow'])->name('settings.deptconfigEdit');


// settings.evalperm' settings.deptconfig

Route::get('/markAllAsRead', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAllAsRead');
