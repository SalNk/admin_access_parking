<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/download-qrcode/{id}', function ($id) {
    $customer = Customer::findOrFail($id);

    // Décoder le QR Code en base64 et le convertir en image
    $qrCodeContent = base64_decode($customer->qrcode);

    // Retourner l'image PNG avec les en-têtes appropriés pour le téléchargement
    return Response::make($qrCodeContent, 200, [
        'Content-Type' => 'image/png',
        'Content-Disposition' => 'attachment; filename="qrcode.png"',
    ]);
})->name('download.qrcode');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('/terms-of-service', 'terms')->name('terms');
Route::view('/privacy-policy', 'privacy')->name('privacy');

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])
    ->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])
    ->name('socialite.callback');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
