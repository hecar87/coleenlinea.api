<?php

namespace App\Modules\TypeDocument\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeDocument\Repositories\ITypeDocumentRepository;
use App\Application\TypeDocument\DTOs\SearchTypeDocumentDTO;

class SearchTypeDocumentAction
{
	protected ITypeDocumentRepository $oTypeDocumentRepository;

	public function __construct(ITypeDocumentRepository $oTypeDocumentRepository)
	{
		$this->oTypeDocumentRepository = $oTypeDocumentRepository;
	}

	public function execute(SearchTypeDocumentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeDocumentRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeDocumentRepository->search($oData);
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