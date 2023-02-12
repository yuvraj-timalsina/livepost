<?php

    use App\Events\PlayGroundEvent;
    use App\Mail\WelcomeMail;
    use App\Models\Post;
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

    Route::get('shared/post/{post}', static function (\Illuminate\Http\Request $request, Post $post) {
        return 'Specially made just for you! Post Title : {{ $post->title }}';
    })->name('shared.post')->middleware('signed');

    if (app()->environment('local')) {
        Route::get('/mail', static function () {
            return (new WelcomeMail(User::factory()->make()))->render();
        });
    }

    Route::get('/playground', static function () {
        event(new PlayGroundEvent());

        return null;
    });
