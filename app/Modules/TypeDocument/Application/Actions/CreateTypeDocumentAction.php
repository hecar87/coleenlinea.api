<?php

namespace App\Application\TypeDocument\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeDocument\Repositories\ITypeDocumentRepository;
use App\Application\TypeDocument\DTOs\CreateTypeDocumentDTO;
use App\Application\TypeDocument\DTOs\DuplicatedTypeDocumentDTO;


class CreateTypeDocumentAction
{
	protected ITypeDocumentRepository $oTypeDocumentRepository;

	public function __construct(ITypeDocumentRepository $oTypeDocumentRepository)
	{
		$this->oTypeDocumentRepository = $oTypeDocumentRepository;
	}

	public function execute(CreateTypeDocumentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeDocumentRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypeDocumentDTO(
			Id_TypeDocument		: 0,
			TypeDocument_Name	: $oData->TypeDocument_Name,
			TypeDocument_Abrv	: $oData->TypeDocument_Abrv
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

			$oResult = $this->oTypeDocumentRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeDocumentRepository->create($oData);
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