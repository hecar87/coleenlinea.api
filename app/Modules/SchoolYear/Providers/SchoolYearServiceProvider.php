<?php

namespace App\Modules\SchoolYear\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\SchoolYear\Domain\Repositories\ISchoolYearRepository;
use App\Modules\SchoolYear\Infrastructure\Repositories\EloquentSchoolYearRepository;


class SchoolYearServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ISchoolYearRepository::class, EloquentSchoolYearRepository::class);
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