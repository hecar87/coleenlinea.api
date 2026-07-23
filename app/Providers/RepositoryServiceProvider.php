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
use App\Modules\TypeReceipt\Providers\TypeReceiptServiceProvider;
use App\Modules\TypeSchool\Providers\TypeSchoolServiceProvider;

use App\Modules\School\Providers\SchoolServiceProvider;
use App\Modules\SchoolAccount\Providers\SchoolAccountServiceProvider;
use App\Modules\SchoolBranch\Providers\SchoolBranchServiceProvider;
use App\Modules\SchoolLevel\Providers\SchoolLevelServiceProvider;
use App\Modules\Schoolclass\Providers\SchoolClassServiceProvider;
use App\Modules\SchoolYear\Providers\SchoolYearServiceProvider;
use App\Modules\SchoolProfile\Providers\SchoolProfileServiceProvider;
use App\Modules\SchoolInstallment\Providers\SchoolInstallmentServiceProvider;

use App\Modules\Contract\Providers\ContractServiceProvider;
use App\Modules\ContractFee\Providers\ContractFeeServiceProvider;

use App\Modules\Guardian\Providers\GuardianServiceProvider;

use App\Modules\Student\Providers\StudentServiceProvider;
use App\Modules\StudentGuardian\Providers\StudentGuardianServiceProvider;
use App\Modules\Enrollment\Providers\EnrollmentServiceProvider;
use App\Modules\EnrollmentInstallment\Providers\EnrollmentInstallmentServiceProvider;


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
		$this->app->register(TypeReceiptServiceProvider::class);
		$this->app->register(TypeSchoolServiceProvider::class);

		$this->app->register(SchoolServiceProvider::class);
		$this->app->register(SchoolAccountServiceProvider::class);
		$this->app->register(SchoolBranchServiceProvider::class);
		$this->app->register(SchoolLevelServiceProvider::class);
		$this->app->register(SchoolClassServiceProvider::class);
		$this->app->register(SchoolYearServiceProvider::class);
		$this->app->register(SchoolProfileServiceProvider::class);
		$this->app->register(SchoolInstallmentServiceProvider::class);

		$this->app->register(ContractServiceProvider::class);
		$this->app->register(ContractFeeServiceProvider::class);

		$this->app->register(GuardianServiceProvider::class);

		$this->app->register(StudentServiceProvider::class);
		$this->app->register(StudentGuardianServiceProvider::class);
		$this->app->register(EnrollmentServiceProvider::class);
		$this->app->register(EnrollmentInstallmentServiceProvider::class);
	}

	public function boot(): void
	{
		// Aquí puedes realizar cualquier acción adicional después de que todos los servicios hayan sido registrados.
	}
}