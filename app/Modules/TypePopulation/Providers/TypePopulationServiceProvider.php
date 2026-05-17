<?php

namespace App\Modules\TypePopulation\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\TypePopulation\Domain\Repositories\ITypePopulationRepository;
use App\Modules\TypePopulation\Infrastructure\Repositories\EloquentTypePopulationRepository;


class TypePopulationServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ITypePopulationRepository::class, EloquentTypePopulationRepository::class);
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