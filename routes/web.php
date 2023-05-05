<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\NoteController;
use App\Models\File;
use App\Models\Note;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::resource('note', NoteController::class);
    Route::get('/', [NoteController::class, 'index']);
})->name('note');

Route::resource('file', FileController::class);
