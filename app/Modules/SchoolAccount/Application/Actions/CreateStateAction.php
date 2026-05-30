<?php

namespace App\Modules\SchoolAccount\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolAccount\Domain\Repositories\ISchoolAccountRepository;
use App\Modules\SchoolAccount\Application\DTOs\CreateSchoolAccountDTO;
use App\Modules\SchoolAccount\Application\DTOs\DuplicatedSchoolAccountDTO;


class CreateSchoolAccountAction
{

	public function __construct(
		protected ISchoolAccountRepository $oSchoolAccountRepository
	)
	{
	}

	public function execute(CreateSchoolAccountDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolAccountRepository->getEntity();
		$oDataDuplicated = new DuplicatedSchoolAccountDTO(
			Id_SchoolAccount	: 0,
			SchoolAccount_Code	: $oData->SchoolAccount_Code,
			SchoolAccount_Name	: $oData->SchoolAccount_Name,
			SchoolAccount_Abrv	: $oData->SchoolAccount_Abrv
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

			$oResult = $this->oSchoolAccountRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolAccountRepository->create($oData);
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