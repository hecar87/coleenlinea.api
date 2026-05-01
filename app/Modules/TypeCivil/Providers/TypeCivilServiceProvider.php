<?php

namespace App\Modules\TypeCivil\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\TypeCivil\Domain\Repositories\ITypeCivilRepository;
use App\Modules\TypeCivil\Infrastructure\Repositories\EloquentTypeCivilRepository;


class TypeCivilServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ITypeCivilRepository::class, EloquentTypeCivilRepository::class);
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