<?php

use App\Livewire\Tienda\ProductosList;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tienda', ProductosList::class)->name('tienda');
