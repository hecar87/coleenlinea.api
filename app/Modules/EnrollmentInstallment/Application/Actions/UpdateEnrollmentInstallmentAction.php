<?php

namespace App\Modules\EnrollmentInstallment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\EnrollmentInstallment\Domain\Repositories\IEnrollmentInstallmentRepository;
use App\Modules\Enrollment\Domain\Repositories\IEnrollmentRepository;
use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;
use App\modules\Typeinstallment\Domain\Repositories\ITypeInstallmentRepository;

use App\Modules\EnrollmentInstallment\Application\DTOs\UpdateEnrollmentInstallmentDTO;
use App\Modules\EnrollmentInstallment\Application\DTOs\DuplicatedEnrollmentInstallmentDTO;


class UpdateEnrollmentInstallmentAction
{

	public function __construct(
		protected IEnrollmentInstallmentRepository $oEnrollmentInstallmentRepository,
		protected IEnrollmentRepository $oEnrollmentRepository,
		protected ITypeInstallmentRepository $oTypeInstallmentRepository,
		protected ITypeCurrencyRepository $oTypeCurrencyRepository
	)
	{
	}

	public function execute(UpdateEnrollmentInstallmentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oEnrollmentInstallmentRepository->getEntity();
		$oDataDuplicated = new DuplicatedEnrollmentInstallmentDTO(
			Id_EnrollmentInstallment	: $oData->Id_EnrollmentInstallment,
			EnrollmentInstallment_Order	: $oData->EnrollmentInstallment_Order,
			Id_Enrollment				: $oData->Id_Enrollment,
			Id_TypeCurrency				: $oData->Id_TypeCurrency,
			Id_TypeInstallment			: $oData->Id_TypeInstallment
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

			$oResult = $this->oEnrollmentRepository->exists($oData->Id_Enrollment);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeCurrencyRepository->exists($oData->Id_TypeCurrency);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeInstallmentRepository->exists($oData->Id_TypeInstallment);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oEnrollmentInstallmentRepository->exists($oData->Id_EnrollmentInstallment);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oResult = $this->oEnrollmentInstallmentRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oEnrollmentInstallmentRepository->update($oData);
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