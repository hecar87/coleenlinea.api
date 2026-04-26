<?php

namespace App\Modules\City\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\City\Domain\Repositories\ICityRepository;
use App\Modules\City\Infrastructure\Repositories\EloquentCityRepository;


class CityServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ICityRepository::class, EloquentCityRepository::class);
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