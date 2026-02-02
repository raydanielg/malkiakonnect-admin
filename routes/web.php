<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

if (file_exists(base_path('Modules/Authmanagement/routes/web.php'))) {
    require base_path('Modules/Authmanagement/routes/web.php');
}

if (is_dir(base_path('Modules/Adminmodules/resources/views'))) {
    View::addNamespace('adminmodules', base_path('Modules/Adminmodules/resources/views'));
}

if (file_exists(base_path('Modules/Adminmodules/routes/web.php'))) {
    require base_path('Modules/Adminmodules/routes/web.php');
}

Route::get('/', function () {
    return redirect()->route('auth.login');
});
