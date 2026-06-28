<?php

namespace App\Modules\ContractFee\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\ContractFee\Domain\Repositories\IContractFeeRepository;
use App\Modules\Contract\Domain\Repositories\IContractRepository;
use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;
use App\Modules\TypeFee\Domain\Repositories\ITypeFeeRepository;

use App\Modules\ContractFee\Application\DTOs\UpdateContractFeeDTO;
use App\Modules\ContractFee\Application\DTOs\DuplicatedContractFeeDTO;


class UpdateContractFeeAction
{

	public function __construct(
		protected IContractFeeRepository $oContractFeeRepository,
		protected IContractRepository $oContractRepository,
		protected ITypeCurrencyRepository $oTypeCurrencyRepository,
		protected ITypeFeeRepository $oTypeFeeRepository
	)
	{
	}

	public function execute(UpdateContractFeeDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oContractFeeRepository->getEntity();
		$oDataDuplicated = new DuplicatedContractFeeDTO(
			Id_ContractFee		: $oData->Id_ContractFee,
			Id_Contract			: $oData->Id_Contract,
			Id_TypeCurrency		: $oData->Id_TypeCurrency,
			Id_TypeFee			: $oData->Id_TypeFee
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

			$oResult = $this->oContractRepository->exists($oData->Id_Contract);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	 return $oResult; }

			$oResult = $this->oTypeCurrencyRepository->exists($oData->Id_TypeCurrency);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	 return $oResult; }

			$oResult = $this->oTypeFeeRepository->exists($oData->Id_TypeFee);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oContractFeeRepository->exists($oData->Id_ContractFee);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oResult = $this->oContractFeeRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oContractFeeRepository->update($oData);
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