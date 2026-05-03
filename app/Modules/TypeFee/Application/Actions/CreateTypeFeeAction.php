<?php

namespace App\Modules\TypeFee\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypeFee\Domain\Repositories\ITypeFeeRepository;
use App\Modules\TypeFee\Application\DTOs\CreateTypeFeeDTO;
use App\Modules\TypeFee\Application\DTOs\DuplicatedTypeFeeDTO;


class CreateTypeFeeAction
{
	protected ITypeFeeRepository $oTypeFeeRepository;

	public function __construct(ITypeFeeRepository $oTypeFeeRepository)
	{
		$this->oTypeFeeRepository = $oTypeFeeRepository;
	}

	public function execute(CreateTypeFeeDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeFeeRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypeFeeDTO(
			Id_TypeFee		: 0,
			TypeFee_Name	: $oData->TypeFee_Name,
			TypeFee_Abrv	: $oData->TypeFee_Abrv
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

			$oResult = $this->oTypeFeeRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeFeeRepository->create($oData);
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