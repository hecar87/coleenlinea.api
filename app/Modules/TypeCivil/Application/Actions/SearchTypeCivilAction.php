<?php

namespace App\Modules\TypeCivil\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeCivil\Repositories\ITypeCivilRepository;
use App\Application\TypeCivil\DTOs\SearchTypeCivilDTO;

class SearchTypeCivilAction
{
	protected ITypeCivilRepository $oTypeCivilRepository;

	public function __construct(ITypeCivilRepository $oTypeCivilRepository)
	{
		$this->oTypeCivilRepository = $oTypeCivilRepository;
	}

	public function execute(SearchTypeCivilDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeCivilRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeCivilRepository->search($oData);
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