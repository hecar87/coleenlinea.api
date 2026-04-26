<?php

namespace App\Application\TypeDocument\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeDocument\Repositories\ITypeDocumentRepository;
use App\Domain\TypeDocument\Enums\TypeDocumentFilterDisplay;


class ListTypeDocumentAction
{
	protected ITypeDocumentRepository $oTypeDocumentRepository;

	public function __construct(ITypeDocumentRepository $oTypeDocumentRepository)
	{
		$this->oTypeDocumentRepository = $oTypeDocumentRepository;
	}

	public function execute(string $Display) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oTypeDocumentRepository->getEntity();
		$oDisplay 	= TypeDocumentFilterDisplay::from(strtoupper($Display));


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeDocumentRepository->list($oDisplay);
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