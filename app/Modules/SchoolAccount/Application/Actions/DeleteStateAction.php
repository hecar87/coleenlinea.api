<?php

namespace App\Modules\State\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\State\Domain\Repositories\IStateRepository;


class DeleteStateAction
{

	public function __construct(
		protected IStateRepository $oStateRepository
	)
	{
	}

	public function execute(int $Id_State) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oStateRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oStateRepository->exists($Id_State);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oStateRepository->delete($Id_State);
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