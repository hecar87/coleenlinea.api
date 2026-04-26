<?php
namespace App\Http\Controllers\Manager\TypeReceipt;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\TypeReceipt\Repositories\ITypeReceiptRepository;


// Requests
use App\Http\Controllers\Manager\TypeReceipt\Requests\CreateTypeReceiptRequest;
use App\Http\Controllers\Manager\TypeReceipt\Requests\UpdateTypeReceiptRequest;
use App\Http\Controllers\Manager\TypeReceipt\Requests\ListTypeReceiptRequest;
use App\Http\Controllers\Manager\TypeReceipt\Requests\SearchTypeReceiptRequest;

// DTOs
use App\Application\TypeReceipt\DTOs\CreateTypeReceiptDTO;
use App\Application\TypeReceipt\DTOs\UpdateTypeReceiptDTO;
use App\Application\TypeReceipt\DTOs\SearchTypeReceiptDTO;

// Actions
use App\Application\TypeReceipt\Actions\CreateTypeReceiptAction;
use App\Application\TypeReceipt\Actions\UpdateTypeReceiptAction;
use App\Application\TypeReceipt\Actions\DeleteTypeReceiptAction;
use App\Application\TypeReceipt\Actions\IndexTypeReceiptAction;
use App\Application\TypeReceipt\Actions\ListTypeReceiptAction;
use App\Application\TypeReceipt\Actions\SearchTypeReceiptAction;


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