<?php

namespace App\Modules\TypeGender\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\TypeGender\Domain\Repositories\ITypeGenderRepository;
use App\Modules\TypeGender\Infrastructure\Repositories\EloquentTypeGenderRepository;


class TypeGenderServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ITypeGenderRepository::class, EloquentTypeGenderRepository::class);
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