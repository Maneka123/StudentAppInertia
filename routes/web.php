<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HomeController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get('/',[HomeController::class,"index"])->name('dashboard');
//Route::get('/student',[StudentController::class,"index"])->name('student');

Route::prefix('/student')->group(function() {

    Route::get('/',[StudentController::class,"index"])->name('student');
    Route::get('/list',[StudentController::class,"list"])->name('student.list');
    Route::get('/{task_id}/get',[StudentController::class,"get"])->name('student.get');

    Route::post('/store',[StudentController::class,"store"])->name('student.store');
    Route::get('/edit',[StudentController::class,"edit"])->name('student.edit');
    //edit loads data to the modal
    Route::post('/{student_id}/update',[StudentController::class,"update"])->name('student.update');
    Route::delete('/{student_id}/delete',[StudentController::class,"delete"])->name('student.delete');
    Route::get('/{student_id}/done',[StudentController::class,"done"])->name('student.done');

} );


Route::get('edit-student/{id}',[StudentController::class,'editStudent']);
require __DIR__.'/auth.php';



Route::get('/welcome', function () {
    return view('welcome');
});