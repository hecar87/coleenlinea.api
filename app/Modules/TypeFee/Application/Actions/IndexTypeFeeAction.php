<?php

namespace App\Application\TypeFee\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeFee\Repositories\ITypeFeeRepository;

class IndexTypeFeeAction
{
	protected ITypeFeeRepository $oTypeFeeRepository;

	public function __construct(ITypeFeeRepository $oTypeFeeRepository)
	{
		$this->oTypeFeeRepository = $oTypeFeeRepository;
	}

	public function execute(int $Id_TypeFee) : Result
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

			$oResult = $this->oTypeFeeRepository->exists($Id_TypeFee);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeFeeRepository->index($Id_TypeFee);
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