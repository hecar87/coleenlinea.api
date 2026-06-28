<?php

namespace App\Modules\Student\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\Student\Domain\Repositories\IStudentRepository;
use App\Modules\Student\Infrastructure\Repositories\EloquentStudentRepository;


class StudentServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(IStudentRepository::class, EloquentStudentRepository::class);
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