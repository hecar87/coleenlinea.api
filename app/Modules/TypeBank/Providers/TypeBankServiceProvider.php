<?php

namespace App\Modules\TypeBank\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\TypeBank\Domain\Repositories\ITypeBankRepository;
use App\Modules\TypeBank\Infrastructure\Repositories\EloquentTypeBankRepository;


class TypeBankServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ITypeBankRepository::class, EloquentTypeBankRepository::class);
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