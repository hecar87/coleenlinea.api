<?php

namespace App\Modules\School\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\School\Application\DTOs\UpdateSchoolDTO;
use App\Modules\School\Application\DTOs\DuplicatedSchoolDTO;


class UpdateSchoolAction
{
	protected ISchoolRepository $oSchoolRepository;

	public function __construct(ISchoolRepository $oSchoolRepository)
	{
		$this->oSchoolRepository = $oSchoolRepository;
	}

	public function execute(UpdateSchoolDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolRepository->getEntity();
		$oDataDuplicated = new DuplicatedSchoolDTO(
			Id_School	: $oData->Id_School,
			School_Code	: $oData->School_Code,
			School_Name	: $oData->School_Name,
			School_Abrv	: $oData->School_Abrv
		);;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oSchoolRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolRepository->update($oData);
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