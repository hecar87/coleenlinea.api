<?php

namespace App\Modules\TypeFee\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\TypeFee\Domain\Repositories\ITypeFeeRepository;
use App\Modules\TypeFee\Infrastructure\Repositories\EloquentTypeFeeRepository;


class TypeFeeServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ITypeFeeRepository::class, EloquentTypeFeeRepository::class);
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