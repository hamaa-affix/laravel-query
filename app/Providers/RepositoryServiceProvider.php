<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * repositoryクラスの依存関係を定義するProvider
 */
class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Repositories/BackEndの中にあるディレクトリ名とrepositoryの先頭が、
     * 同じ名前である場合はここに追加することでbindされます。
     * @var array
     */
    private const MODELS = [
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // repository
        foreach (self::MODELS as $model) {
            $this->app->bind(
                "App\Repositories\Interfaces\\{$model}RepositoryInterface",
                "App\Repositories\Eloquent{$model}Repository"
            );
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
