<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\HRController;
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
})->name('dashboard');

// Employee Routes

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/employees/{employee_id}/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/{employee_id}', [EmployeeController::class, 'show'])->name('employees.show');
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');



// Evaluation ALL view
Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');
//review evaluation
Route::get('/evaluations/{evaluation}/review', [EvaluationController::class, 'review'])->name('evaluations.review');
//PDF
Route::get('/evaluations/{evaluation}/pdf', [EvaluationController::class, 'generatePDF'])->name('evaluations.pdf');
//Create evaluation to employee
Route::get('/evaluations/create/{employee}/{template}', [EvaluationController::class, 'create'])->name('evaluations.create');

Route::get('/evaluations/edit/{evaluation}', [EvaluationController::class, 'edit'])->name('evaluations.edit');



//TEMPLATES
//view all template
Route::get('/templates', [HRController::class, 'index'])->name('templates.index');
//create template
Route::get('/templates/create', [HRController::class, 'create'])->name('templates.create');
//edit template
Route::get('/templates/{template}/edit', [HRController::class, 'edit'])->name('templates.edit');
//delete template
Route::delete('/templates/{template}', [HRController::class, 'destroy'])->name('templates.destroy');



//LARAVEL-UI
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





// Show all users
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Create a new user
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

//show specific user
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::patch('/user/{id}', [UserController::class, 'update'])->name('user.update');


Route::get('/markAllAsRead', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAllAsRead');
