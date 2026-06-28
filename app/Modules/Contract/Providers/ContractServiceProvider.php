<?php

namespace App\Modules\Contract\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\Contract\Domain\Repositories\IContractRepository;
use App\Modules\Contract\Infrastructure\Repositories\EloquentContractRepository;


class ContractServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(IContractRepository::class, EloquentContractRepository::class);
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