<?php

namespace App\Modules\TypeReceipt\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\TypeReceipt\Domain\Repositories\ITypeReceiptRepository;


// Requests
use App\Modules\TypeReceipt\Http\Requests\Manager\CreateTypeReceiptRequest;
use App\Modules\TypeReceipt\Http\Requests\Manager\UpdateTypeReceiptRequest;
use App\Modules\TypeReceipt\Http\Requests\Manager\ListTypeReceiptRequest;
use App\Modules\TypeReceipt\Http\Requests\Manager\SearchTypeReceiptRequest;

// DTOs
use App\Modules\TypeReceipt\Application\DTOs\CreateTypeReceiptDTO;
use App\Modules\TypeReceipt\Application\DTOs\UpdateTypeReceiptDTO;
use App\Modules\TypeReceipt\Application\DTOs\SearchTypeReceiptDTO;

// Actions
use App\Modules\TypeReceipt\Application\Actions\CreateTypeReceiptAction;
use App\Modules\TypeReceipt\Application\Actions\UpdateTypeReceiptAction;
use App\Modules\TypeReceipt\Application\Actions\DeleteTypeReceiptAction;
use App\Modules\TypeReceipt\Application\Actions\IndexTypeReceiptAction;
use App\Modules\TypeReceipt\Application\Actions\ListTypeReceiptAction;
use App\Modules\TypeReceipt\Application\Actions\SearchTypeReceiptAction;


class TypeReceiptController extends Controller
{
	protected ITypeReceiptRepository $repository;

	public function __construct(
		ITypeReceiptRepository $repository,

		private CreateTypeReceiptAction $oCreateTypeReceiptAction,
		private UpdateTypeReceiptAction $oUpdateTypeReceiptAction,
		private DeleteTypeReceiptAction $oDeleteTypeReceiptAction,
		private IndexTypeReceiptAction $oIndexTypeReceiptAction,
		private ListTypeReceiptAction $oListTypeReceiptAction,
		private SearchTypeReceiptAction $oSearchTypeReceiptAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypeReceiptRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypeReceiptDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypeReceiptAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypeReceiptRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypeReceiptDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypeReceiptAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypeReceipt)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypeReceiptAction->execute($Id_TypeReceipt);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypeReceipt)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypeReceiptAction->execute($Id_TypeReceipt);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypeReceiptRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypeReceiptAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypeReceiptRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypeReceiptDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypeReceiptAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}