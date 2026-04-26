<?php

namespace App\Modules\State\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\State\Domain\Repositories\IStateRepository;
use App\Modules\State\Infrastructure\Repositories\EloquentStateRepository;

class StateServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(IStateRepository::class, EloquentStateRepository::class);
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