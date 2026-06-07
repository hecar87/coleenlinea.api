<?php

namespace App\Modules\SchoolBranch\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolBranch\Domain\Repositories\ISchoolBranchRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\State\Domain\Repositories\IStateRepository;
use App\Modules\City\Domain\Repositories\ICityRepository;
use App\Modules\District\Domain\Repositories\IDistrictRepository;

use App\Modules\SchoolBranch\Application\DTOs\CreateSchoolBranchDTO;
use App\Modules\SchoolBranch\Application\DTOs\DuplicatedSchoolBranchDTO;


class CreateSchoolBranchAction
{

	public function __construct(
		protected ISchoolBranchRepository $oSchoolBranchRepository,
		protected ISchoolRepository $oSchoolRepository,
		protected IStateRepository $oStateRepository,
		protected ICityRepository $oCityRepository,
		protected IDistrictRepository $oDistrictRepository
	)
	{
	}

	public function execute(CreateSchoolBranchDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolBranchRepository->getEntity();
		$oDataDuplicated = new DuplicatedSchoolBranchDTO(
			Id_SchoolBranch			: 0,
			SchoolBranch_Code 		: $oData->SchoolBranch_Code,
			SchoolBranch_Name 		: $oData->SchoolBranch_Name,
			SchoolBranch_Address 	: $oData->SchoolBranch_Address,
			SchoolBranch_Status 	: $oData->SchoolBranch_Status,
			Id_School 				: $oData->Id_School
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

			$oResult = $this->oStateRepository->exists($oData->Id_State);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oCityRepository->exists($oData->Id_City);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	 return $oResult; }

			$oResult = $this->oDistrictRepository->exists($oData->Id_District);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolBranchRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolBranchRepository->create($oData);
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