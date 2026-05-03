<?php

namespace App\Modules\TypeInstallment\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\TypeInstallment\Domain\Repositories\ITypeInstallmentRepository;
use App\Modules\TypeInstallment\Infrastructure\Repositories\EloquentTypeInstallmentRepository;


class TypeInstallmentServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ITypeInstallmentRepository::class, EloquentTypeInstallmentRepository::class);
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