<?php

namespace App\Modules\SchoolAccount\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\SchoolAccount\Domain\Repositories\ISchoolAccountRepository;
use App\Modules\SchoolAccount\Infrastructure\Repositories\EloquentSchoolAccountRepository;


class SchoolAccountServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ISchoolAccountRepository::class, EloquentSchoolAccountRepository::class);
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