<?php

namespace App\Modules\SchoolLevel\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolLevel\Domain\Repositories\ISchoolLevelRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\TypeBank\Domain\Repositories\ITypeBankRepository;
use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;

use App\Modules\SchoolLevel\Application\DTOs\CreateSchoolLevelDTO;
use App\Modules\SchoolLevel\Application\DTOs\DuplicatedSchoolLevelDTO;


class CreateSchoolLevelAction
{

	public function __construct(
		protected ISchoolLevelRepository $oSchoolLevelRepository,
		protected ISchoolRepository $oSchoolRepository,
		protected ITypeBankRepository $oTypeBankRepository,
		protected ITypeCurrencyRepository $oTypeCurrencyRepository
	)
	{
	}

	public function execute(CreateSchoolLevelDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolLevelRepository->getEntity();
		$oDataDuplicated = new DuplicatedSchoolLevelDTO(
			Id_SchoolLevel		: 0,
			SchoolLevel_Number	: $oData->SchoolLevel_Number,
            SchoolLevel_CCI		: $oData->SchoolLevel_CCI,
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


			$oResult = $this->oSchoolLevelRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolLevelRepository->create($oData);
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