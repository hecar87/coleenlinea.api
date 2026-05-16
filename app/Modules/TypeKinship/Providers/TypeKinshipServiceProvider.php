<?php

namespace App\Modules\TypeKinship\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\TypeKinship\Domain\Repositories\ITypeKinshipRepository;
use App\Modules\TypeKinship\Infrastructure\Repositories\EloquentTypeKinshipRepository;


class TypeKinshipServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ITypeKinshipRepository::class, EloquentTypeKinshipRepository::class);
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