<?php

use PhpSlides\view;
use PhpSlides\Route;
use App\Controllers\FormAuthController;

/**
 * --------------------------------------------------------------------
 * | Register all routes here to render according to request
 * | NOTE - that browser or any other request cannot access any page
 * | that are not coming from route, it redirects to 404
 * --------------------------------------------------------------------
 */
Route::post('/auth/login', [FormAuthController::class, 'login'])->name(
	'auth.login'
);
Route::post('/auth/register', [FormAuthController::class, 'register'])->name(
	'auth.register'
);

Route::view('/login', '::Login')->name('login');
Route::view('/register', '::Register')->name('register');
Route::view(['/', '/index'], '::Index')->name('index');

Route::any('*', function () {
	return '<h2 align="center">404 - Page Not Found</h2>';
});
