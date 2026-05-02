<?php

namespace App\Modules\TypeCurrency\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;
use App\Modules\TypeCurrency\Infrastructure\Repositories\EloquentTypeCurrencyRepository;


class TypeCurrencyServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ITypeCurrencyRepository::class, EloquentTypeCurrencyRepository::class);
	}

	public function boot(): void
	{
		$basePath	= __DIR__ . "/../Http/Routes/";

		if (!is_dir($basePath)) {
            return;
        }


		// Manager
        if (file_exists($basePath . "ManagerRoutes.php")) {
            Route::prefix("manager")->group($basePath . "/ManagerRoutes.php");
        }
	}
}