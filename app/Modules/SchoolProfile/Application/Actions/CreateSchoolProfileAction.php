<?php

namespace App\Modules\SchoolProfile\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolProfile\Domain\Repositories\ISchoolProfileRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\SchoolYear\Domain\Repositories\ISchoolYearRepository;
use App\Modules\SchoolLevel\Domain\Repositories\ISchoolLevelRepository;


use App\Modules\SchoolProfile\Application\DTOs\CreateSchoolProfileDTO;
use App\Modules\SchoolProfile\Application\DTOs\DuplicatedSchoolProfileDTO;


class CreateSchoolProfileAction
{

	public function __construct(
		protected ISchoolProfileRepository $oSchoolProfileRepository,
		protected ISchoolRepository $oSchoolRepository,
		protected ISchoolYearRepository $oSchoolYearRepository,
		protected ISchoolLevelRepository $oSchoolLevelRepository
	)
	{
	}

	public function execute(CreateSchoolProfileDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolProfileRepository->getEntity();
		$oDataDuplicated = new DuplicatedSchoolProfileDTO(
			Id_SchoolProfile		: $oData->Id_SchoolProfile,
			SchoolProfile_Name		: $oData->SchoolProfile_Name,
			Id_School				: $oData->Id_School,
			Id_SchoolYear			: $oData->Id_SchoolYear,
			Id_SchoolLevel			: $oData->Id_SchoolLevel
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

			$oResult = $this->oSchoolYearRepository->exists($oData->Id_SchoolYear);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolLevelRepository->exists($oData->Id_SchoolLevel);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oResult = $this->oSchoolProfileRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolProfileRepository->create($oData);
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