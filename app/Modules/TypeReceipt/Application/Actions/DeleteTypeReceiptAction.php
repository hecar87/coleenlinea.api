<?php

namespace App\Application\TypeReceipt\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeReceipt\Repositories\ITypeReceiptRepository;


class DeleteTypeReceiptAction
{
	protected ITypeReceiptRepository $oTypeReceiptRepository;

	public function __construct(ITypeReceiptRepository $oTypeReceiptRepository)
	{
		$this->oTypeReceiptRepository = $oTypeReceiptRepository;
	}

	public function execute(int $Id_TypeReceipt) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeReceiptRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeReceiptRepository->exists($Id_TypeReceipt);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeReceiptRepository->delete($Id_TypeReceipt);
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