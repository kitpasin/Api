<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/profile/all", [ProfileController::class, 'getProfileAll']);

Route::get("/profile/id/{id}", [ProfileController::class, 'getProfileById']);

Route::post('/profile/create', [ProfileController::class, 'createProfile']);

Route::patch('/profile/update/{id}', [ProfileController::class, 'updateProfile']);

Route::delete('/profile/delete/{id}', [ProfileController::class, 'deleteProfile']);