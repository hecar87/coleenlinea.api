<?php

namespace App\Modules\TypeFee\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypeFee\Domain\Repositories\ITypeFeeRepository;
use App\Modules\TypeFee\Domain\Enums\TypeFeeFilterDisplay;


class ListTypeFeeAction
{

	public function __construct(
		protected ITypeFeeRepository $oTypeFeeRepository
	)
	{
	}

	public function execute(string $Display) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oTypeFeeRepository->getEntity();
		$oDisplay 	= TypeFeeFilterDisplay::from(strtoupper($Display));


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeFeeRepository->list($oDisplay);
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