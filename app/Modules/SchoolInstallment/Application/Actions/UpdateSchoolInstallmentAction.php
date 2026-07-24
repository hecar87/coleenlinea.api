<?php

namespace App\Modules\SchoolInstallment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolInstallment\Domain\Repositories\ISchoolInstallmentRepository;
use App\Modules\SchoolProfile\Domain\Repositories\ISchoolProfileRepository;
use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;
use App\Modules\TypeInstallment\Domain\Repositories\ITypeInstallmentRepository;

use App\Modules\SchoolInstallment\Application\DTOs\UpdateSchoolInstallmentDTO;
use App\Modules\SchoolInstallment\Application\DTOs\DuplicatedSchoolInstallmentDTO;


class UpdateSchoolInstallmentAction
{

	public function __construct(
		protected ISchoolInstallmentRepository $oSchoolInstallmentRepository,
		protected ISchoolProfileRepository $oSchoolProfileRepository,
		protected ITypeCurrencyRepository $oTypeCurrencyRepository,
		protected ITypeInstallmentRepository $oTypeInstallmentRepository
	)
	{
	}

	public function execute(UpdateSchoolInstallmentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolInstallmentRepository->getEntity();
		$oDataDuplicated = new DuplicatedSchoolInstallmentDTO(
			Id_SchoolInstallment		: $oData->Id_SchoolInstallment,
			Id_SchoolProfile			: $oData->Id_SchoolProfile,
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

			$oResult = $this->oSchoolProfileRepository->exists($oData->Id_SchoolProfile);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeCurrencyRepository->exists($oData->Id_TypeCurrency);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeInstallmentRepository->exists($oData->Id_TypeInstallment);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolInstallmentRepository->exists($oData->Id_SchoolInstallment);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oResult = $this->oSchoolInstallmentRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolInstallmentRepository->update($oData);
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