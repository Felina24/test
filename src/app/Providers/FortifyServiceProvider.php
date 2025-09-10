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

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    // public function boot()
    // {
    // Fortify::createUsersUsing(function (RegisterRequest $request) {
    //     $data = $request->validated();
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // });

    // Fortify::authenticateUsing(function (LoginRequest $request) {
    //     $data = $request->validated();
    //     $user = User::where('email', $data['email'])->first();
    //     if ($user && Hash::check($data['password'], $user->password)) {
    //         return $user;
    //     }
    //     return null;
    // });
    // }


    public function boot(): void
    {
        // 登録ビュー
        Fortify::registerView(fn() => view('auth.register'));

        // ログインビュー
        Fortify::loginView(fn() => view('auth.login'));

        // ユーザ作成クラスを指定
        Fortify::createUsersUsing(CreateNewUser::class);

        // 認証処理（Closure のままでOK）
        Fortify::authenticateUsing(function (\App\Http\Requests\LoginRequest $request) {
            $data = $request->validated();
            $user = \App\Models\User::where('email', $data['email'])->first();
            if ($user && \Illuminate\Support\Facades\Hash::check($data['password'], $user->password)) {
                return $user;
            }
            return null;
        });
    }
}
