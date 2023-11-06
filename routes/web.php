<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EvaluationController;
use App\Livewire\EvaluationForm;

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
})->name('home');

// Employee Routes

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/{id}', [EmployeeController::class, 'show'])->name('employees.show');
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');



// Evaluation ALL
Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');





// //Evaluation pages
//PAGE 1 GET/POST
//Route::get('/employees/{id}/evaluations/create', [EvaluationController::class, 'create'])->name('evaluations.create');

//Route::get('/evaluations/create/{employee}/{template}', [EvaluationController::class, 'create'])->name('evaluations.create');
Route::get('/evaluations/create/{employee}/{template}', [EvaluationController::class, 'create'])->name('evaluations.create');

// Route::post('/employees/{id}/evaluations/store', [EvaluationController::class, 'store'])->name('evaluations.store');

// //PAGE 2 GET/POST
// Route::get('/employees/{id}/evaluations/create2', [EvaluationController::class, 'create2'])->name('evaluations.create2');
// Route::post('/employees/{id}/evaluations/store2', [EvaluationController::class, 'store2'])->name('evaluations.store2');

// //PAGE 3 GET/POST
// Route::get('/employees/{id}/evaluations/create3', [EvaluationController::class, 'create3'])->name('evaluations.create3');
// Route::post('/employees/{id}/evaluations/store3', [EvaluationController::class, 'store3'])->name('evaluations.store3');

//Route::get('/employees/{id}/evaluations', EvaluationForm::class)->name('evaluations.create');






//PDF
Route::get('/evaluations/{evaluation}/pdf', [EvaluationController::class, 'generatePDF'])->name('evaluations.pdf');
