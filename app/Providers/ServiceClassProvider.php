<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * serviceクラスの依存関係を定義するProvider
 */
class ServiceClassProvider extends ServiceProvider
{
    /**
     * 実装クラス、Interface共通のPrefix
     * @var Array
     */
    private const PREFIXES = [
        'User'
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		foreach (self::PREFIXES as $prefix) {
			$this->app->bind(
				"App\Services\Interfaces\\{$prefix}ServiceInterface",
				"App\Services\\{$prefix}Service"
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
