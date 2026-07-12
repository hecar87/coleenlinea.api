<?php

namespace App\Modules\EnrollmentInstallment\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\EnrollmentInstallment\Domain\Repositories\IEnrollmentInstallmentRepository;
use App\Modules\EnrollmentInstallment\Infrastructure\Repositories\EloquentEnrollmentInstallmentRepository;


class EnrollmentInstallmentServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(IEnrollmentInstallmentRepository::class, EloquentEnrollmentInstallmentRepository::class);
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