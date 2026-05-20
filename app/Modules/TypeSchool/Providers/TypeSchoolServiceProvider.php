<?php

namespace App\Modules\TypeSchool\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\TypeSchool\Domain\Repositories\ITypeSchoolRepository;
use App\Modules\TypeSchool\Infrastructure\Repositories\EloquentTypeSchoolRepository;


class TypeSchoolServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ITypeSchoolRepository::class, EloquentTypeSchoolRepository::class);
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