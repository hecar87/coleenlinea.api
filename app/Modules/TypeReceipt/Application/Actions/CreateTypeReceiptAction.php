<?php

namespace App\Application\TypeReceipt\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeReceipt\Repositories\ITypeReceiptRepository;
use App\Application\TypeReceipt\DTOs\CreateTypeReceiptDTO;
use App\Application\TypeReceipt\DTOs\DuplicatedTypeReceiptDTO;


class CreateTypeReceiptAction
{
	protected ITypeReceiptRepository $oTypeReceiptRepository;

	public function __construct(ITypeReceiptRepository $oTypeReceiptRepository)
	{
		$this->oTypeReceiptRepository = $oTypeReceiptRepository;
	}

	public function execute(CreateTypeReceiptDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeReceiptRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypeReceiptDTO(
			Id_TypeReceipt		: 0,
			TypeReceipt_Name	: $oData->TypeReceipt_Name,
			TypeReceipt_Abrv	: $oData->TypeReceipt_Abrv
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

			$oResult = $this->oTypeReceiptRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeReceiptRepository->create($oData);
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