<?php

namespace App\Modules\StudentGuardian\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\StudentGuardian\Domain\Repositories\IStudentGuardianRepository;
use App\Modules\StudentGuardian\Infrastructure\Repositories\EloquentStudentGuardianRepository;


class StudentGuardianServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(IStudentGuardianRepository::class, EloquentStudentGuardianRepository::class);
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