<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\UnderController;
use App\Http\Controllers\EmployController;
use App\Http\Controllers\UnemployController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GmailController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/alumnis', function () {
    return view('alumnis.index');
})->middleware(['auth', 'verified'])->name('alumnis.index');

Route::get('/under', function () {
    return view('under.index');
})->middleware(['auth', 'verified'])->name('under.index');

Route::get('/employ', function () {
    return view('employ.index');
})->middleware(['auth', 'verified'])->name('employ.index');

Route::get('/unemploy', function () {
    return view('unemploy.index');
})->middleware(['auth', 'verified'])->name('unemploy.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('alumnis', AlumniController::class);
Route::resource('under', UnderController::class);
Route::resource('employ', EmployController::class);
Route::resource('unemploy', UnemployController::class);

// Route::get('/', [GmailController::class, 'home']);
Route::get('/home', 'GmailController@home');
Route::post('sendmail/', [GmailController::class, 'Send'])->name('sendmail.send');////////////////

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/transfer', [AlumniController::class, 'transferData'])->name('transfer.data');
Route::post('/under/import', [UnderController::class, 'import'])->name('under.import');
Route::post('/alumni/import', [AlumniController::class, 'import'])->name('alumnis.import');
Route::get('/alumni/export', [AlumniController::class, 'export'])->name('alumni.export');
Route::get('/unders/export', [UnderController::class, 'export'])->name('unders.export');
Route::get('/employs/export', [EmployController::class, 'export'])->name('employs.export');
Route::get('/unemploys/export', [UnemployController::class, 'export'])->name('unemploys.export');

require __DIR__.'/auth.php';
