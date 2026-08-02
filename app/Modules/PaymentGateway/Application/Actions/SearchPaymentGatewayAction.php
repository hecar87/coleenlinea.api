<?php

namespace App\Modules\PaymentGateway\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\PaymentGateway\Domain\Repositories\IPaymentGatewayRepository;
use App\Modules\PaymentGateway\Application\DTOs\SearchPaymentGatewayDTO;


class SearchPaymentGatewayAction
{

	public function __construct(
		protected IPaymentGatewayRepository $oPaymentGatewayRepository
	)
	{
	}

	public function execute(SearchPaymentGatewayDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oPaymentGatewayRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oPaymentGatewayRepository->search($oData);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			DB::commit();
		}
		catch (\Throwable $oException)
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