<?php

namespace App\Modules\PaymentGateway\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\PaymentGateway\Domain\Repositories\IPaymentGatewayRepository;
use App\Modules\Charge\Domain\Repositories\IChargeRepository;

use App\Modules\PaymentGateway\Application\DTOs\CreatePaymentDTO;


class CreatePaymentAction
{

	public function __construct(
		protected IPaymentGatewayRepository $oPaymentGatewayRepository,
		protected IChargeRepository $oChargeRepository
	)
	{
	}

	public function execute(string $Charge_Code, string $ClientIp) : Result
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

			//
            // Create Payment DTO
            //
            $oData = new CreatePaymentDTO(
                Id_Charge: $oCharge->Id_Charge,
				Charge_Code: $oCharge->Charge_Code,
				Payment_Amount: (float) $oCharge->Charge_Amount_Total,
				Id_TypeCurrency: $oCharge->Id_TypeCurrency,
				Payment_ClientIp: $ClientIp,
				Payment_Name: $oCharge->Charge_Name,
				Payment_LastName: $oCharge->Charge_LastName,
				Payment_Email: $oCharge->Charge_Email,
				Payment_NoDocument: $oCharge->Charge_NoDocument,
				Payment_Phone: $oCharge->Charge_Phone
            );


			$oResult = $this->oPaymentGatewayRepository->create($oData);
			if ( $oResult->RESULT_STS <> 200 ){ return $oResult; }
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