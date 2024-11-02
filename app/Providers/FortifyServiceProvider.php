<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });
        

        // ログイン処理でカスタムリクエストを使用
        // Fortify::authenticateUsing(function (LoginRequest $request) {
        //     return Auth::attempt([
        //         'email' => $request->email,
        //         'password' => $request->password,
        //     ]);
        // });

        // Fortify::authenticateUsing(function (LoginRequest $request) {
        //     // バリデーションをリクエストで実行
        //     $validated = $request->validated();

        //     // ログイン処理
        //     if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
        //         return Auth::user();
        //     }

        //     return null;
        // });

        //         Fortify::authenticateUsing(function (LoginRequest $request) {
        //             $credentials = $request->only('email', 'password');

        //             if (Auth::attempt($credentials)) {
        //                 $request->session()->regenerate();
        //                 return redirect()->intended('/admin');
        //             }
        // });
    }


}
