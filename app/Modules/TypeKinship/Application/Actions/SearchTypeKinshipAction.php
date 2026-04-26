<?php

namespace App\Application\TypeKinship\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeKinship\Repositories\ITypeKinshipRepository;
use App\Application\TypeKinship\DTOs\SearchTypeKinshipDTO;

class SearchTypeKinshipAction
{
	protected ITypeKinshipRepository $oTypeKinshipRepository;

	public function __construct(ITypeKinshipRepository $oTypeKinshipRepository)
	{
		$this->oTypeKinshipRepository = $oTypeKinshipRepository;
	}

	public function execute(SearchTypeKinshipDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeKinshipRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeKinshipRepository->search($oData);
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