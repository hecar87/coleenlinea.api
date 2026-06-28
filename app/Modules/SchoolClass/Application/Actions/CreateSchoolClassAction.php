<?php

namespace App\Modules\SchoolClass\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolClass\Domain\Repositories\ISchoolClassRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\SchoolLevel\Domain\Repositories\ISchoolLevelRepository;

use App\Modules\SchoolClass\Application\DTOs\CreateSchoolClassDTO;
use App\Modules\SchoolClass\Application\DTOs\DuplicatedSchoolClassDTO;


class CreateSchoolClassAction
{

	public function __construct(
		protected ISchoolClassRepository $oSchoolClassRepository,
		protected ISchoolRepository $oSchoolRepository,
		protected ISchoolLevelRepository $oSchoolLevelRepository
	)
	{
	}

	public function execute(CreateSchoolClassDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolClassRepository->getEntity();
		$oDataDuplicated = new DuplicatedSchoolClassDTO(
			Id_SchoolClass			: 0,
			SchoolClass_Name		: $oData->SchoolClass_Name,
			SchoolClass_Section		: $oData->SchoolClass_Section,
			Id_School				: $oData->Id_School,
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

			$oResult = $this->oSchoolLevelRepository->exists($oData->Id_SchoolLevel);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oResult = $this->oSchoolClassRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolClassRepository->create($oData);
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