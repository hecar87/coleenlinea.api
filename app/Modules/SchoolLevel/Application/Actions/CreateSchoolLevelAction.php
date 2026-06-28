<?php

namespace App\Modules\SchoolLevel\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolLevel\Domain\Repositories\ISchoolLevelRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\TypeLevel\Domain\Repositories\ITypeLevelRepository;

use App\Modules\SchoolLevel\Application\DTOs\CreateSchoolLevelDTO;
use App\Modules\SchoolLevel\Application\DTOs\DuplicatedSchoolLevelDTO;


class CreateSchoolLevelAction
{

	public function __construct(
		protected ISchoolLevelRepository $oSchoolLevelRepository,
		protected ISchoolRepository $oSchoolRepository,
		protected ITypeLevelRepository $oTypeLevelRepository
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
			SchoolLevel_Code	: $oData->SchoolLevel_Code,
			Id_School			: $oData->Id_School,
			Id_TypeLevel		: $oData->Id_TypeLevel
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

			$oResult = $this->oTypeLevelRepository->exists($oData->Id_TypeLevel);
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