<?php

use Src\Route;

Route::add(['GET', 'POST'], '/hello', [Controller\Site::class,'newLibrarian'])
    ->middleware('admin');
//Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/libAdd', [Controller\Site::class, 'libAdd']);
Route::add(['GET', 'POST'], '/addBook', [Controller\Site::class, 'addBook']);
Route::add(['GET', 'POST'], '/readerAdd', [Controller\Site::class, 'addReader']);
Route::add('GET', '/readers', [Controller\Site::class, 'readers']);
Route::add('POST', '/changeStatus', [Controller\Site::class, 'changeStatus']);
Route::add('GET', '/books', [Controller\Site::class, 'books']);
Route::add('GET', '/out', [Controller\Site::class, 'out']);
Route::add('POST', '/getOut', [Controller\Site::class, 'getOut']);