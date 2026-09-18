<?php

use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfilController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfilController::class, 'index'])
        ->name('profile.index');

    Route::get('/siswa', [SiswaController::class, 'index'])
        ->name('siswa.index');

    Route::get('/siswa/create', [SiswaController::class, 'create'])
        ->name('siswa.create');

    Route::post('/siswa', [SiswaController::class, 'store'])
        ->name('siswa.store');

    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])
        ->name('siswa.edit');

    Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])
        ->name('siswa.update');

    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])
        ->name('siswa.destroy');

    Route::get('/siswa/export', function (Request $request) {

        return Excel::download(
            new SiswaExport(
                $request->search,
                $request->lembaga
            ),
            'data-siswa.xlsx'
        );

    })->name('siswa.export');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
