<?php

namespace App\Modules\TypePayment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypePayment\Domain\Repositories\ITypePaymentRepository;
use App\Modules\TypePayment\Application\DTOs\UpdateTypePaymentDTO;
use App\Modules\TypePayment\Application\DTOs\DuplicatedTypePaymentDTO;


class UpdateTypePaymentAction
{

	public function __construct(
		protected ITypePaymentRepository $oTypePaymentRepository
	)
	{
	}

	public function execute(UpdateTypePaymentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypePaymentRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypePaymentDTO(
			Id_TypePayment		: $oData->Id_TypePayment,
			TypePayment_Name	: $oData->TypePayment_Name,
			TypePayment_Abrv	: $oData->TypePayment_Abrv
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

			$oResult = $this->oTypePaymentRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypePaymentRepository->update($oData);
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