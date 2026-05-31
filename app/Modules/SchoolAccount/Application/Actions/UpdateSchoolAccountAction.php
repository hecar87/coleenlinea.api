<?php

namespace App\Modules\SchoolAccount\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolAccount\Domain\Repositories\ISchoolAccountRepository;
use App\Modules\SchoolAccount\Application\DTOs\UpdateSchoolAccountDTO;
use App\Modules\SchoolAccount\Application\DTOs\DuplicatedSchoolAccountDTO;


class UpdateSchoolAccountAction
{

	public function __construct(
		protected ISchoolAccountRepository $oSchoolAccountRepository
	)
	{
	}

	public function execute(UpdateSchoolAccountDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolAccountRepository->getEntity();
		$oDataDuplicated = new DuplicatedSchoolAccountDTO(
			Id_SchoolAccount		: $oData->Id_SchoolAccount,
			SchoolAccount_Number	: $oData->SchoolAccount_Number,
            SchoolAccount_CCI		: $oData->SchoolAccount_CCI,
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

			$oResult = $this->oSchoolAccountRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolAccountRepository->update($oData);
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