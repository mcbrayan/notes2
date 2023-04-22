<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

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
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::controller(NoteController::class)->group(function(){

    Route::get('notes', 'index');
    Route::get('notes', 'store');
    Route::get('notes', 'edit');
    Route::get('notes/{note}', 'show');


});

Route::controller(FileController::class)->group(function(){

    Route::get('files', 'index');
    Route::get('files', 'store');
    Route::get('files', 'edit');
    Route::get('files/{file}', 'show');


});