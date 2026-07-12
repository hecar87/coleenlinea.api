<?php

namespace App\Modules\EnrollmentInstallment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\EnrollmentInstallment\Domain\Repositories\IEnrollmentInstallmentRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\TypeBank\Domain\Repositories\ITypeBankRepository;
use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;

use App\Modules\EnrollmentInstallment\Application\DTOs\CreateEnrollmentInstallmentDTO;
use App\Modules\EnrollmentInstallment\Application\DTOs\DuplicatedEnrollmentInstallmentDTO;


class CreateEnrollmentInstallmentAction
{

	public function __construct(
		protected IEnrollmentInstallmentRepository $oEnrollmentInstallmentRepository,
		protected ISchoolRepository $oSchoolRepository,
		protected ITypeBankRepository $oTypeBankRepository,
		protected ITypeCurrencyRepository $oTypeCurrencyRepository
	)
	{
	}

	public function execute(CreateEnrollmentInstallmentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oEnrollmentInstallmentRepository->getEntity();
		$oDataDuplicated = new DuplicatedEnrollmentInstallmentDTO(
			Id_EnrollmentInstallment		: 0,
			EnrollmentInstallment_Number	: $oData->EnrollmentInstallment_Number,
            EnrollmentInstallment_CCI		: $oData->EnrollmentInstallment_CCI,
            Id_School				: $oData->Id_School,
            Id_TypeBank				: $oData->Id_TypeBank,
            Id_TypeCurrency			: $oData->Id_TypeCurrency
		);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oSchoolRepository->exists($oData->Id_School);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeBankRepository->exists($oData->Id_TypeBank);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeCurrencyRepository->exists($oData->Id_TypeCurrency);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oResult = $this->oEnrollmentInstallmentRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oEnrollmentInstallmentRepository->create($oData);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			DB::commit();
		}
		catch (\Exception $oException)
		{
			DB::rollBack();
			$oResult 	= ResultManager::Result(2000, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

	}
}