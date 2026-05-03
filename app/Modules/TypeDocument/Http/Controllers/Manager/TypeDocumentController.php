<?php

namespace App\Modules\TypeDocument\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\TypeDocument\Repositories\ITypeDocumentRepository;


// Requests
use App\Http\Controllers\Manager\TypeDocument\Requests\CreateTypeDocumentRequest;
use App\Http\Controllers\Manager\TypeDocument\Requests\UpdateTypeDocumentRequest;
use App\Http\Controllers\Manager\TypeDocument\Requests\ListTypeDocumentRequest;
use App\Http\Controllers\Manager\TypeDocument\Requests\SearchTypeDocumentRequest;

// DTOs
use App\Application\TypeDocument\DTOs\CreateTypeDocumentDTO;
use App\Application\TypeDocument\DTOs\UpdateTypeDocumentDTO;
use App\Application\TypeDocument\DTOs\SearchTypeDocumentDTO;

// Actions
use App\Application\TypeDocument\Actions\CreateTypeDocumentAction;
use App\Application\TypeDocument\Actions\UpdateTypeDocumentAction;
use App\Application\TypeDocument\Actions\DeleteTypeDocumentAction;
use App\Application\TypeDocument\Actions\IndexTypeDocumentAction;
use App\Application\TypeDocument\Actions\ListTypeDocumentAction;
use App\Application\TypeDocument\Actions\SearchTypeDocumentAction;


class TypeDocumentController extends Controller
{
	protected ITypeDocumentRepository $repository;

	public function __construct(
		ITypeDocumentRepository $repository,

		private CreateTypeDocumentAction $oCreateTypeDocumentAction,
		private UpdateTypeDocumentAction $oUpdateTypeDocumentAction,
		private DeleteTypeDocumentAction $oDeleteTypeDocumentAction,
		private IndexTypeDocumentAction $oIndexTypeDocumentAction,
		private ListTypeDocumentAction $oListTypeDocumentAction,
		private SearchTypeDocumentAction $oSearchTypeDocumentAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypeDocumentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypeDocumentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypeDocumentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypeDocumentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypeDocumentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypeDocumentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypeDocument)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypeDocumentAction->execute($Id_TypeDocument);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypeDocument)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypeDocumentAction->execute($Id_TypeDocument);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypeDocumentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypeDocumentAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypeDocumentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypeDocumentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypeDocumentAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}