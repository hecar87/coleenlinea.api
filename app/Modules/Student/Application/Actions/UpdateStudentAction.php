<?php

namespace App\Modules\Guardian\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\Guardian\Domain\Repositories\IGuardianRepository;
use App\Modules\TypeDocument\Domain\Repositories\ITypeDocumentRepository;

use App\Modules\Guardian\Application\DTOs\UpdateGuardianDTO;
use App\Modules\Guardian\Application\DTOs\DuplicatedGuardianDTO;


class UpdateGuardianAction
{

	public function __construct(
		protected IGuardianRepository $oGuardianRepository,
		protected ITypeDocumentRepository $oTypeDocumentRepository
	)
	{
	}

	public function execute(UpdateGuardianDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oGuardianRepository->getEntity();
		$oDataDuplicated = new DuplicatedGuardianDTO(
			Id_Guardian : $oData->Id_Guardian,
			Guardian_NoDocument : $oData->Guardian_NoDocument,
			Id_TypeDocument : $oData->Id_TypeDocument
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

			$oResult = $this->oTypeDocumentRepository->exists($oData->Id_TypeDocument);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oGuardianRepository->exists($oData->Id_Guardian);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }


			$oResult = $this->oGuardianRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oGuardianRepository->update($oData);
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