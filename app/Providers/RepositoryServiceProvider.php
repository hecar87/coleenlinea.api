<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Modules\State\Providers\StateServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->register(StateServiceProvider::class);

	}

	public function boot(): void
	{
		// Aquí puedes realizar cualquier acción adicional después de que todos los servicios hayan sido registrados.
	}
}