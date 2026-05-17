<?php

namespace App\Modules\TypeLevel\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\TypeLevel\Domain\Repositories\ITypeLevelRepository;
use App\Modules\TypeLevel\Infrastructure\Repositories\EloquentTypeLevelRepository;


class TypeLevelServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ITypeLevelRepository::class, EloquentTypeLevelRepository::class);
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