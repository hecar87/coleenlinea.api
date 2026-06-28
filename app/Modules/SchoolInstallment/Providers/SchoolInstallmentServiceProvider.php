<?php

namespace App\Modules\SchoolInstallment\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\SchoolInstallment\Domain\Repositories\ISchoolInstallmentRepository;
use App\Modules\SchoolInstallment\Infrastructure\Repositories\EloquentSchoolInstallmentRepository;


class SchoolInstallmentServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ISchoolInstallmentRepository::class, EloquentSchoolInstallmentRepository::class);
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