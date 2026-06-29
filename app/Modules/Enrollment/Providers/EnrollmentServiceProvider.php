<?php

namespace App\Modules\Enrollment\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\Enrollment\Domain\Repositories\IEnrollmentRepository;
use App\Modules\Enrollment\Infrastructure\Repositories\EloquentEnrollmentRepository;


class EnrollmentServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(IEnrollmentRepository::class, EloquentEnrollmentRepository::class);
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