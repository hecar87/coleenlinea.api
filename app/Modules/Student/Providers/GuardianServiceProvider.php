<?php

namespace App\Modules\Guardian\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\Guardian\Domain\Repositories\IGuardianRepository;
use App\Modules\Guardian\Infrastructure\Repositories\EloquentGuardianRepository;


class GuardianServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(IGuardianRepository::class, EloquentGuardianRepository::class);
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