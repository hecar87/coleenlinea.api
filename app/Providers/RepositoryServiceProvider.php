<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Modules\State\Providers\StateServiceProvider;
use App\Modules\City\Providers\CityServiceProvider;
use App\Modules\District\Providers\DistrictServiceProvider;
use App\Modules\TypeBank\Providers\TypeBankServiceProvider;
use App\Modules\TypeCivil\Providers\TypeCivilServiceProvider;
use App\Modules\TypeCurrency\Providers\TypeCurrencyServiceProvider;
use App\Modules\TypeDocument\Providers\TypeDocumentServiceProvider;
use App\Modules\TypeFee\Providers\TypeFeeServiceProvider;
use App\Modules\TypeInstallment\Providers\TypeInstallmentServiceProvider;
use App\Modules\TypeKinship\Providers\TypeKinshipServiceProvider;
use App\Modules\TypeLevel\Providers\TypeLevelServiceProvider;
use App\Modules\TypePayment\Providers\TypePaymentServiceProvider;
use App\Modules\TypePopulation\Providers\TypePopulationServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->register(StateServiceProvider::class);
		$this->app->register(CityServiceProvider::class);
		$this->app->register(DistrictServiceProvider::class);
		$this->app->register(TypeBankServiceProvider::class);
		$this->app->register(TypeCivilServiceProvider::class);
		$this->app->register(TypeCurrencyServiceProvider::class);
		$this->app->register(TypeDocumentServiceProvider::class);
		$this->app->register(TypeFeeServiceProvider::class);
		$this->app->register(TypeInstallmentServiceProvider::class);
		$this->app->register(TypeKinshipServiceProvider::class);
		$this->app->register(TypeLevelServiceProvider::class);
		$this->app->register(TypePaymentServiceProvider::class);
		$this->app->register(TypePopulationServiceProvider::class);
	}

	public function boot(): void
	{
		// Aquí puedes realizar cualquier acción adicional después de que todos los servicios hayan sido registrados.
	}
}