<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('members', MemberController::class);

Route::get('/get-cities/{state_id}', [MemberController::class, 'getCities']);