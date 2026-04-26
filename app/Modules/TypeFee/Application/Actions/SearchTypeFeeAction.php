<?php

namespace App\Application\TypeFee\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeFee\Repositories\ITypeFeeRepository;
use App\Application\TypeFee\DTOs\SearchTypeFeeDTO;

class SearchTypeFeeAction
{
	protected ITypeFeeRepository $oTypeFeeRepository;

	public function __construct(ITypeFeeRepository $oTypeFeeRepository)
	{
		$this->oTypeFeeRepository = $oTypeFeeRepository;
	}

	public function execute(SearchTypeFeeDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeFeeRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeFeeRepository->search($oData);
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