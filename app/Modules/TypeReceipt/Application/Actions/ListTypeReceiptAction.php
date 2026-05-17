<?php

namespace App\Modules\TypeReceipt\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypeReceipt\Domain\Repositories\ITypeReceiptRepository;
use App\modules\TypeReceipt\Domain\Enums\TypeReceiptFilterDisplay;


class ListTypeReceiptAction
{
	protected ITypeReceiptRepository $oTypeReceiptRepository;

	public function __construct(ITypeReceiptRepository $oTypeReceiptRepository)
	{
		$this->oTypeReceiptRepository = $oTypeReceiptRepository;
	}

	public function execute(string $Display) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oTypeReceiptRepository->getEntity();
		$oDisplay 	= TypeReceiptFilterDisplay::from(strtoupper($Display));


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeReceiptRepository->list($oDisplay);
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