<?php

namespace App\Modules\SchoolYear\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolYear\Domain\Repositories\ISchoolYearRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;

use App\Modules\SchoolYear\Application\DTOs\CreateSchoolYearDTO;
use App\Modules\SchoolYear\Application\DTOs\DuplicatedSchoolYearDTO;


class CreateSchoolYearAction
{

	public function __construct(
		protected ISchoolYearRepository $oSchoolYearRepository,
		protected ISchoolRepository $oSchoolRepository
	)
	{
	}

	public function execute(CreateSchoolYearDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolYearRepository->getEntity();
		$oDataDuplicated = new DuplicatedSchoolYearDTO(
			Id_SchoolYear			: $oData->Id_SchoolYear,
			SchoolYear_Name			: $oData->SchoolYear_Name,
			SchoolYear_Year			: $oData->SchoolYear_Year,
			Id_School				: $oData->Id_School
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


			$oResult = $this->oSchoolYearRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolYearRepository->create($oData);
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