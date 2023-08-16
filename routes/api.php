<?php

use App\Http\Controllers\API\LandingPageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get("/", [LandingPageController::class, "index"])->name("landing-page");

$routes = glob(__DIR__ . "/api/*.php");
foreach ($routes as $route) require($route);
