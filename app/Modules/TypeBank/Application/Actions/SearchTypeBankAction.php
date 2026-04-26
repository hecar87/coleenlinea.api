<?php

namespace App\Modules\TypeBank\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeBank\Repositories\ITypeBankRepository;
use App\Application\TypeBank\DTOs\SearchTypeBankDTO;

class SearchTypeBankAction
{
	protected ITypeBankRepository $oTypeBankRepository;

	public function __construct(ITypeBankRepository $oTypeBankRepository)
	{
		$this->oTypeBankRepository = $oTypeBankRepository;
	}

	public function execute(SearchTypeBankDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeBankRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeBankRepository->search($oData);
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