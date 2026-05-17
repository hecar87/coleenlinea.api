<?php

namespace App\Modules\TypeLevel\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypeLevel\Domain\Repositories\ITypeLevelRepository;
use App\Modules\TypeLevel\Application\DTOs\SearchTypeLevelDTO;

class SearchTypeLevelAction
{
	protected ITypeLevelRepository $oTypeLevelRepository;

	public function __construct(ITypeLevelRepository $oTypeLevelRepository)
	{
		$this->oTypeLevelRepository = $oTypeLevelRepository;
	}

	public function execute(SearchTypeLevelDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeLevelRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeLevelRepository->search($oData);
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