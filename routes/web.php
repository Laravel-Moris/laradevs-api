<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('api/documentation');
});

require __DIR__.'/auth.php';
