<?php

use Inertia\Inertia;
use App\Models\Fixture;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\FixturesController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\PredictionsController;

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

Route::get('/', function () {
    return redirect('fixtures');
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::controller(FixturesController::class)->group(function () {
        Route::get('fixtures', 'index')->name('fixtures');
        Route::get('fixtures/{fixture}', 'show')->name('fixtures.show');
    });

    Route::controller(PredictionsController::class)->group(function () {
        Route::get('predictions', 'index')->name('predictions');
        Route::get('predictions/{fixture}', 'show')->name('predictions.show');
        Route::put('predictions/decrease-score', 'decreaseScore')->name('predictions.decrease_score');
        Route::put('predictions/increase-score', 'increaseScore')->name('predictions.increase_score');
    });

    Route::controller(LeaderboardController::class)->group(function () {
        Route::get('leaderboard', 'index')->name('leaderboard');
    });
});
