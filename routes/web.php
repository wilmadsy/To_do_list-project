<?php

use App\Http\Controllers\halocontroller;
use App\Http\Controllers\todo\todocontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// route::get('/coba', function () {
//     return view('coba');
// });

route::get('/coba', [halocontroller::class, 'index']);

// route::get('/todo', function () {
//     return view('app');    
// });

route::get('/todo', [todocontroller::class, 'index'])->name('todo');
route::post('/todo', [todocontroller::class, 'store'])->name('todo.post');
route::put('/todo/{id}', [todocontroller::class, 'update'])->Name('todo.update');
route::delete('/todo/{id}', [todocontroller::class, 'destroy'])->Name('todo.delete');