<?php

namespace App\Modules\TypeReceipt\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\TypeReceipt\Domain\Repositories\ITypeReceiptRepository;
use App\Modules\TypeReceipt\Infrastructure\Repositories\EloquentTypeReceiptRepository;


class TypeReceiptServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ITypeReceiptRepository::class, EloquentTypeReceiptRepository::class);
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