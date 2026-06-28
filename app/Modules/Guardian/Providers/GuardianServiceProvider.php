<?php

namespace App\Modules\School\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\School\Infrastructure\Repositories\EloquentSchoolRepository;


class SchoolServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ISchoolRepository::class, EloquentSchoolRepository::class);
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