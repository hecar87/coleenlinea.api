<?php

namespace App\Modules\SchoolProfile\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\SchoolProfile\Domain\Repositories\ISchoolProfileRepository;
use App\Modules\SchoolProfile\Infrastructure\Repositories\EloquentSchoolProfileRepository;


class SchoolProfileServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ISchoolProfileRepository::class, EloquentSchoolProfileRepository::class);
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