<?php

namespace App\Modules\SchoolBranch\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\SchoolBranch\Domain\Repositories\ISchoolBranchRepository;
use App\Modules\SchoolBranch\Infrastructure\Repositories\EloquentSchoolBranchRepository;


class SchoolBranchServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ISchoolBranchRepository::class, EloquentSchoolBranchRepository::class);
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