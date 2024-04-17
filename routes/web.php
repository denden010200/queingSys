<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientController;
use App\Http\Controllers\userController;


/* Client */
Route::get('/', [clientController::class, 'index'])->name('index');
Route::get('/checkappointment', [clientController::class, 'appointmentChecker'])->name('checkAppointment');
Route::post('/searchAppointment', [clientController::class, 'searchAppointment'])->name('SearchAppointment');
Route::get('/home', [clientController::class, 'home'])->name('home');
Route::get('/appointments', [clientController::class, 'appointments'])->name('appointments');
Route::post('/addslot', [clientController::class, 'addSlot'])->name('addSlot');
Route::get('/appointmentlist', [clientController::class, 'appointmentlist'])->name('appointmentlist');
Route::get('/slots', [clientController::class, 'showdate'])->name('ShowDate');
Route::get('/delete/{id}', [clientController::class, 'delete'])->name('delete');
Route::post('/addAppointment', [clientController::class, 'addAppointment'])->name('addAppointment');


/* User */
Route::post('/addUser', [userController::class, 'addUser'])->name('addUser');
Route::post('/loginUser', [userController::class, 'loginUser'])->name('loginUser');
Route::get('/login', [userController::class, 'login'])->name('login');
Route::get('/logout', [userController::class, 'logout'])->name('logout');


