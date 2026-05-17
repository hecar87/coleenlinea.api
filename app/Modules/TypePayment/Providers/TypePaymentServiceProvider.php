<?php

namespace App\Modules\TypePayment\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\TypePayment\Domain\Repositories\ITypePaymentRepository;
use App\Modules\TypePayment\Infrastructure\Repositories\EloquentTypePaymentRepository;


class TypePaymentServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ITypePaymentRepository::class, EloquentTypePaymentRepository::class);
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