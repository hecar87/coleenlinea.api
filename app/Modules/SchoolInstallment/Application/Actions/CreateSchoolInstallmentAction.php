<?php

namespace App\Modules\SchoolInstallment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolInstallment\Domain\Repositories\ISchoolInstallmentRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\SchoolYear\Domain\Repositories\ISchoolYearRepository;
use App\Modules\SchoolLevel\Domain\Repositories\ISchoolLevelRepository;
use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;
use App\Modules\TypeInstallment\Domain\Repositories\ITypeInstallmentRepository;

use App\Modules\SchoolInstallment\Application\DTOs\CreateSchoolInstallmentDTO;
use App\Modules\SchoolInstallment\Application\DTOs\DuplicatedSchoolInstallmentDTO;


class CreateSchoolInstallmentAction
{

	public function __construct(
		protected ISchoolInstallmentRepository $oSchoolInstallmentRepository,
		protected ISchoolRepository $oSchoolRepository,
		protected ISchoolYearRepository $oSchoolYearRepository,
		protected ISchoolLevelRepository $oSchoolLevelRepository,
		protected ITypeCurrencyRepository $oTypeCurrencyRepository,
		protected ITypeInstallmentRepository $oTypeInstallmentRepository
	)
	{
	}

	public function execute(CreateSchoolInstallmentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolInstallmentRepository->getEntity();
		$oDataDuplicated = new DuplicatedSchoolInstallmentDTO(
			Id_SchoolInstallment		: 0,
			Id_SchoolProfile				: $oData->Id_SchoolProfile,
			Id_SchoolLevel				: $oData->Id_SchoolLevel,
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

			$oResult = $this->oSchoolYearRepository->exists($oData->Id_SchoolProfile);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolLevelRepository->exists($oData->Id_SchoolLevel);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	 return $oResult; }

			$oResult = $this->oTypeCurrencyRepository->exists($oData->Id_TypeCurrency);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeInstallmentRepository->exists($oData->Id_TypeInstallment);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oResult = $this->oSchoolInstallmentRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolInstallmentRepository->create($oData);
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