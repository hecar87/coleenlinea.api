<?php

namespace App\Modules\ContractFee\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\ContractFee\Domain\Repositories\IContractFeeRepository;
use App\Modules\ContractFee\Infrastructure\Repositories\EloquentContractFeeRepository;


class ContractFeeServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(IContractFeeRepository::class, EloquentContractFeeRepository::class);
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