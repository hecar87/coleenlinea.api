<?php

namespace App\Modules\District\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\District\Domain\Repositories\IDistrictRepository;
use App\Modules\District\Infrastructure\Repositories\EloquentDistrictRepository;


class DistrictServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(IDistrictRepository::class, EloquentDistrictRepository::class);
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