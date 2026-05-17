<?php

namespace App\Modules\TypePayment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypePayment\Domain\Repositories\ITypePaymentRepository;
use App\Modules\TypePayment\Application\DTOs\CreateTypePaymentDTO;
use App\Modules\TypePayment\Application\DTOs\DuplicatedTypePaymentDTO;


class CreateTypePaymentAction
{
	protected ITypePaymentRepository $oTypePaymentRepository;

	public function __construct(ITypePaymentRepository $oTypePaymentRepository)
	{
		$this->oTypePaymentRepository = $oTypePaymentRepository;
	}

	public function execute(CreateTypePaymentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypePaymentRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypePaymentDTO(
			Id_TypePayment		: 0,
			TypePayment_Name	: $oData->TypePayment_Name,
			TypePayment_Abrv	: $oData->TypePayment_Abrv
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

			$oResult = $this->oTypePaymentRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypePaymentRepository->create($oData);
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