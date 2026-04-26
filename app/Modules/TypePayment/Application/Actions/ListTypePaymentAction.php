<?php

namespace App\Application\TypePayment\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypePayment\Repositories\ITypePaymentRepository;
use App\Domain\TypePayment\Enums\TypePaymentFilterDisplay;


class ListTypePaymentAction
{
	protected ITypePaymentRepository $oTypePaymentRepository;

	public function __construct(ITypePaymentRepository $oTypePaymentRepository)
	{
		$this->oTypePaymentRepository = $oTypePaymentRepository;
	}

	public function execute(string $Display) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oTypePaymentRepository->getEntity();
		$oDisplay 	= TypePaymentFilterDisplay::from(strtoupper($Display));


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypePaymentRepository->list($oDisplay);
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