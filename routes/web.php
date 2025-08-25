<?php

use App\Http\Controllers\Api\MerchantController;
use Illuminate\Support\Facades\Route;
use Filament\Http\Livewire\Auth\Login;


Route::get('/{any}', function () {
    $path = public_path('home/index.html');

    if (File::exists($path)) {
        return Response::make(File::get($path), 200, ['Content-Type' => 'text/html']);
    } else {
        abort(404, 'Frontend app not found.');
    }
})->where('any', '^(?!admin).*$');