<?php

namespace App\Modules\SchoolLevel\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\SchoolLevel\Domain\Repositories\ISchoolLevelRepository;
use App\Modules\SchoolLevel\Infrastructure\Repositories\EloquentSchoolLevelRepository;


class SchoolLevelServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ISchoolLevelRepository::class, EloquentSchoolLevelRepository::class);
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