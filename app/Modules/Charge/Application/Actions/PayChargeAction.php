<?php

namespace App\Modules\Charge\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\Charge\Domain\Repositories\IChargeRepository;
use App\Modules\Guardian\Domain\Repositories\IGuardianRepository;
use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;
use App\Modules\TypePayment\Domain\Repositories\ITypePaymentRepository;

use App\Modules\Charge\Application\DTOs\PayChargeDTO;


class PayChargeAction
{

	public function __construct(
		protected IChargeRepository $oChargeRepository,
		protected IGuardianRepository $oGuardianRepository,
		protected ITypeCurrencyRepository $oTypeCurrencyRepository,
		protected ITypePaymentRepository $oTypePaymentRepository
	)
	{
	}

	public function execute(PayChargeDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oChargeRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oChargeRepository->exists($oData->Charge_Code);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oChargeRepository->canPay($oData->Charge_Code);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oChargeRepository->pay($oData);
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