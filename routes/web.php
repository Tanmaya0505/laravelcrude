<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/',[EventController::class,'index'])->name('event.index');
 Route::get('/add-event',[EventController::class,'create'])->name('event.add');
 Route::post('/save-event',[EventController::class,'store'])->name('event.save');
 Route::get('/edit-event/{id}', [EventController::class, 'edit'])->name('event.edit');
 Route::post('update-event', [EventController::class, 'update'])->name('event.update');
 Route::delete('delete-event/{id}', [EventController::class, 'destroy'])->name('event.destroy');
