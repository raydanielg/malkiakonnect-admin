<?php

use Illuminate\Support\Facades\Route;

if (file_exists(base_path('Modules/Authmanagement/routes/web.php'))) {
    require base_path('Modules/Authmanagement/routes/web.php');
}

Route::get('/', function () {
    return redirect()->route('auth.login');
});
