<?php

namespace App\Modules\PaymentGateway\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\PaymentGateway\Domain\Repositories\IPaymentGatewayRepository;
use App\Modules\PaymentGateway\Application\DTOs\UpdatePaymentGatewayDTO;
use App\Modules\PaymentGateway\Application\DTOs\DuplicatedPaymentGatewayDTO;


class UpdatePaymentGatewayAction
{

	public function __construct(
		protected IPaymentGatewayRepository $oPaymentGatewayRepository
	)
	{
	}

	public function execute(UpdatePaymentGatewayDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oPaymentGatewayRepository->getEntity();
		$oDataDuplicated = new DuplicatedPaymentGatewayDTO(
			Id_PaymentGateway	: $oData->Id_PaymentGateway,
			PaymentGateway_Code	: $oData->PaymentGateway_Code,
			PaymentGateway_Name	: $oData->PaymentGateway_Name,
			PaymentGateway_Abrv	: $oData->PaymentGateway_Abrv
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

			$oResult = $this->oPaymentGatewayRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oPaymentGatewayRepository->update($oData);
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