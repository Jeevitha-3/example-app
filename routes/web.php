<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterTableController;
use App\Http\Controllers\EmailController;
use App\Services\RegisterService;
use App\Repositories\RegisterRepository;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/db_check', function(){
    try{
        DB::Connection()->getPdo();
        return "Connected Successfully";
    } catch (\Exception $e){
        return "Connect not connect to the database";
    }
});

//Normal method 
Route::get('/registerform', [RegisterController::class, 'create'])->name('register.create');
Route::post('/registerform', [RegisterController::class, 'store'])->name('register.store');
Route::get('/registers-table', [RegisterTableController::class, 'showTable'])->name('registers-table');
Route::get('/registers', [RegisterTableController::class, 'index'])->name('registers.index'); 
Route::put('/registers/{id}', [RegisterController::class, 'update'])->name('register.update');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::delete('/registers/{id}', [RegisterController::class, 'destroy'])->name('registers.destroy');

Route::middleware(['auth'])->group(function (){
    Route::get('/registers', [RegisterTableController::class, 'index'])
    ->name('registers.index')
    ->middleware('can:access-registers');
});

Route::get('/send-mail', [EmailController::class, 'sendMailWithAttachment']);

//Repository design pattern 
Route::get('/registerform', [RegisterController::class, 'repoCreate'])->name('register.create');
Route::post('/register', [RegisterController::class, 'repoStore'])->name('register.store');
Route::put('/register/{id}', [RegisterController::class, 'repoUpdate'])->name('register.update');
Route::delete('/register/{id}', [RegisterController::class, 'repoDestroy'])->name('register.destroy');


//DTO call function 
Route::get('/registerform', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/register/{id}/edit', [RegisterController::class, 'edit'])->name('register.edit');
Route::put('/register/{id}', [RegisterController::class, 'update'])->name('register.update');
Route::delete('/register/{id}', [RegisterController::class, 'destroy'])->name('register.destroy');



require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
