<?php

namespace App\Modules\SchoolClass\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\SchoolClass\Domain\Repositories\ISchoolClassRepository;
use App\Modules\SchoolClass\Infrastructure\Repositories\EloquentSchoolClassRepository;


class SchoolClassServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ISchoolClassRepository::class, EloquentSchoolClassRepository::class);
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