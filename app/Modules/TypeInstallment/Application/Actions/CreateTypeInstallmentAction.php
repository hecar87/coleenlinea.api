<?php

namespace App\Application\TypeInstallment\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeInstallment\Repositories\ITypeInstallmentRepository;
use App\Application\TypeInstallment\DTOs\CreateTypeInstallmentDTO;
use App\Application\TypeInstallment\DTOs\DuplicatedTypeInstallmentDTO;


class CreateTypeInstallmentAction
{
	protected ITypeInstallmentRepository $oTypeInstallmentRepository;

	public function __construct(ITypeInstallmentRepository $oTypeInstallmentRepository)
	{
		$this->oTypeInstallmentRepository = $oTypeInstallmentRepository;
	}

	public function execute(CreateTypeInstallmentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeInstallmentRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypeInstallmentDTO(
			Id_TypeInstallment		: 0,
			TypeInstallment_Name	: $oData->TypeInstallment_Name,
			TypeInstallment_Abrv	: $oData->TypeInstallment_Abrv
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

			$oResult = $this->oTypeInstallmentRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeInstallmentRepository->create($oData);
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