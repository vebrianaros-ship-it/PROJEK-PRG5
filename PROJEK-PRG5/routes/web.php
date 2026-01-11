<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CaptchaController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome-simple');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/captcha', [CaptchaController::class, 'generate'])->name('captcha');

// Guest routes (login/register)
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
    
    // Dashboard redirect based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        switch ($user->role) {
            case 'pic':
                return redirect()->route('admin.dashboard');
            case 'dosen':
                return redirect()->route('dosen.dashboard');
            case 'mahasiswa':
                return redirect()->route('mahasiswa.dashboard');
            default:
                return view('dashboard');
        }
    })->name('dashboard');
});

// Admin/PIC routes
Route::middleware(['auth', 'role:pic'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Mahasiswa management
    Route::resource('mahasiswa', App\Http\Controllers\Admin\MahasiswaController::class);
    
    // Dosen management
    Route::resource('dosen', App\Http\Controllers\Admin\DosenController::class);
    
    // Kelompok management
    Route::resource('kelompok', App\Http\Controllers\Admin\KelompokController::class);
    
    // Jadwal Demo management
    Route::resource('jadwal-demo', App\Http\Controllers\Admin\JadwalDemoController::class);
    Route::get('/jadwal-demo/ajax/available-dosen', [App\Http\Controllers\Admin\JadwalDemoController::class, 'getAvailableDosen'])->name('jadwal-demo.available-dosen');
    
    // Jadwal Sidang management
    Route::resource('jadwal-sidang', App\Http\Controllers\Admin\JadwalSidangController::class);
});

// Dosen routes
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Dosen\DashboardController::class, 'index'])->name('dashboard');
    
    // Availability management
    Route::resource('availability', App\Http\Controllers\Dosen\AvailabilityController::class);
    
    // Jadwal view
    Route::get('/jadwal', [App\Http\Controllers\Dosen\JadwalController::class, 'index'])->name('jadwal.index');
});

// Mahasiswa routes
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Mahasiswa\DashboardController::class, 'index'])->name('dashboard');
    
    // Pendaftaran Demo
    Route::resource('pendaftaran-demo', App\Http\Controllers\Mahasiswa\PendaftaranDemoController::class);
    
    // Jadwal view
    Route::get('/jadwal', [App\Http\Controllers\Mahasiswa\JadwalController::class, 'index'])->name('jadwal.index');
});
