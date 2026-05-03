<?php

namespace App\Modules\TypeDocument\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\TypeDocument\Domain\Repositories\ITypeDocumentRepository;
use App\Modules\TypeDocument\Infrastructure\Repositories\EloquentTypeDocumentRepository;


class TypeDocumentServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ITypeDocumentRepository::class, EloquentTypeDocumentRepository::class);
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