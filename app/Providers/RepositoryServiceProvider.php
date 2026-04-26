<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Modules\State\Providers\StateServiceProvider;
use App\Modules\City\Providers\CityServiceProvider;
use App\Modules\District\Providers\DistrictServiceProvider;
use App\Modules\TypeBank\Providers\TypeBankServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->register(StateServiceProvider::class);
		$this->app->register(CityServiceProvider::class);
		$this->app->register(DistrictServiceProvider::class);
		$this->app->register(TypeBankServiceProvider::class);
	}

	public function boot(): void
	{
		// Aquí puedes realizar cualquier acción adicional después de que todos los servicios hayan sido registrados.
	}
}