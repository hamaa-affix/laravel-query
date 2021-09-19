<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\UseCases\User\UserUseCase;
use App\UseCases\User\UserUseCaseInterFace;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\UserRepository\UserRepositoryInterFace::class, \App\Repositories\UserRepository\UserRepository::class);

        $this->app->bind(UserUseCaseInterFace::class, UserUseCase::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
