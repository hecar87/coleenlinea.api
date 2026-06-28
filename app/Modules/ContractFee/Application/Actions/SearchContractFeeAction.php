<?php

namespace App\Modules\ContractFee\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\ContractFee\Domain\Repositories\IContractFeeRepository;
use App\Modules\Contract\Domain\Repositories\IContractRepository;

use App\Modules\ContractFee\Application\DTOs\SearchContractFeeDTO;


class SearchContractFeeAction
{

	public function __construct(
		protected IContractFeeRepository $oContractFeeRepository,
		protected IContractRepository $oContractRepository
	)
	{
	}

	public function execute(int $Id_Contract, SearchContractFeeDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oContractFeeRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oresult = $this->oContractRepository->exists($Id_Contract);
			if ( $oresult->RESULT_STS <> 200 ){ DB::rollBack(); return $oresult; }

			$oResult = $this->oContractFeeRepository->search($Id_Contract, $oData);
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