<?php

    use App\Mail\WelcomeMail;
    use App\Models\User;
    use Illuminate\Support\Facades\Route;

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

    Route::view('/', 'welcome');

    Route::get('/reset-password/{token}', static function ($token) {
        return view('auth.password-reset', ['token' => $token]);
    })
        ->middleware(['guest:' . config('fortify.guard')])
        ->name('password.reset');

    if (app()->environment('local')) {
        Route::get('/mail', static function () {
            return (new WelcomeMail(User::factory()->make()))->render();
        });
    }
