<?php

namespace App\Modules\Enrollment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\Enrollment\Domain\Repositories\IEnrollmentRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\TypeBank\Domain\Repositories\ITypeBankRepository;
use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;

use App\Modules\Enrollment\Application\DTOs\UpdateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\DuplicatedEnrollmentDTO;


class UpdateEnrollmentAction
{

	public function __construct(
		protected IEnrollmentRepository $oEnrollmentRepository,
		protected ISchoolRepository $oSchoolRepository,
		protected ITypeBankRepository $oTypeBankRepository,
		protected ITypeCurrencyRepository $oTypeCurrencyRepository
	)
	{
	}

	public function execute(UpdateEnrollmentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oEnrollmentRepository->getEntity();
		$oDataDuplicated = new DuplicatedEnrollmentDTO(
			Id_Enrollment		: $oData->Id_Enrollment,
			Enrollment_Number	: $oData->Enrollment_Number,
            Enrollment_CCI		: $oData->Enrollment_CCI,
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
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	 return $oResult; }

			$oResult = $this->oTypeBankRepository->exists($oData->Id_TypeBank);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeCurrencyRepository->exists($oData->Id_TypeCurrency);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	 return $oResult; }

			$oResult = $this->oEnrollmentRepository->exists($oData->Id_Enrollment);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oResult = $this->oEnrollmentRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oEnrollmentRepository->update($oData);
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