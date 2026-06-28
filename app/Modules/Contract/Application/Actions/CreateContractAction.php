<?php

namespace App\Modules\Contract\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\Contract\Domain\Repositories\IContractRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\typeDocument\Domain\Repositories\ITypeDocumentRepository;

use App\Modules\Contract\Application\DTOs\CreateContractDTO;
use App\Modules\Contract\Application\DTOs\DuplicatedContractDTO;


class CreateContractAction
{

	public function __construct(
		protected IContractRepository $oContractRepository,
		protected ISchoolRepository $oSchoolRepository,
		protected ITypeDocumentRepository $oTypeDocumentRepository
	)
	{
	}

	public function execute(CreateContractDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oContractRepository->getEntity();
		$oDataDuplicated = new DuplicatedContractDTO(
			Id_Contract				: 0,
			Contract_Date_Start		: $oData->Contract_Date_Start,
			Contract_Date_End		: $oData->Contract_Date_End,
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

			$oResult = $this->oTypeDocumentRepository->exists($oData->Id_TypeDocument);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oResult = $this->oContractRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oContractRepository->create($oData);
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