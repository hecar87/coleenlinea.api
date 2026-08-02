<?php

namespace App\Modules\PaymentGateway\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\PaymentGateway\Domain\Repositories\IPaymentGatewayRepository;
use App\Modules\Charge\Domain\Repositories\IChargeRepository;

use App\Modules\PaymentGateway\Application\DTOs\VerifyPaymentDTO;


class VerifyPaymentAction
{

	public function __construct(
		protected IPaymentGatewayRepository $oPaymentGatewayRepository,
		protected IChargeRepository $oChargeRepository
	)
	{
	}

	public function execute(string $Charge_Code) : Result
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
			$oResult = $this->oChargeRepository->find($Charge_Code);
			if ( $oResult->RESULT_STS <> 200 ){ return $oResult; }

			$oCharge = $oResult->RESULT_DTA[0];

			$oData = new VerifyPaymentDTO(
				Id_Charge: $oCharge->Id_Charge,
				Charge_Code: $oCharge->Charge_Code
			);

			$oResult = $this->oPaymentGatewayRepository->verify($oData);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }
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