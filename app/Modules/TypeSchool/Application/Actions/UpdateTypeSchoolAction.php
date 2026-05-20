<?php

namespace App\Modules\TypeSchool\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypeSchool\Domain\Repositories\ITypeSchoolRepository;
use App\Modules\TypeSchool\Application\DTOs\UpdateTypeSchoolDTO;
use App\Modules\TypeSchool\Application\DTOs\DuplicatedTypeSchoolDTO;


class UpdateTypeSchoolAction
{
	protected ITypeSchoolRepository $oTypeSchoolRepository;

	public function __construct(ITypeSchoolRepository $oTypeSchoolRepository)
	{
		$this->oTypeSchoolRepository = $oTypeSchoolRepository;
	}

	public function execute(UpdateTypeSchoolDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeSchoolRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypeSchoolDTO(
			Id_TypeSchool	: $oData->Id_TypeSchool,
			TypeSchool_Name	: $oData->TypeSchool_Name,
			TypeSchool_Abrv	: $oData->TypeSchool_Abrv
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

			$oResult = $this->oTypeSchoolRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeSchoolRepository->update($oData);
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