<?php

namespace App\Modules\TypeDocument\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\TypeDocument\Domain\Repositories\ITypeDocumentRepository;


// Requests
use App\Modules\TypeDocument\Http\Requests\Manager\CreateTypeDocumentRequest;
use App\Modules\TypeDocument\Http\Requests\Manager\UpdateTypeDocumentRequest;
use App\Modules\TypeDocument\Http\Requests\Manager\ListTypeDocumentRequest;
use App\Modules\TypeDocument\Http\Requests\Manager\SearchTypeDocumentRequest;

// DTOs
use App\Modules\TypeDocument\Application\DTOs\CreateTypeDocumentDTO;
use App\Modules\TypeDocument\Application\DTOs\UpdateTypeDocumentDTO;
use App\Modules\TypeDocument\Application\DTOs\SearchTypeDocumentDTO;

// Actions
use App\Modules\TypeDocument\Application\Actions\CreateTypeDocumentAction;
use App\Modules\TypeDocument\Application\Actions\UpdateTypeDocumentAction;
use App\Modules\TypeDocument\Application\Actions\DeleteTypeDocumentAction;
use App\Modules\TypeDocument\Application\Actions\IndexTypeDocumentAction;
use App\Modules\TypeDocument\Application\Actions\ListTypeDocumentAction;
use App\Modules\TypeDocument\Application\Actions\SearchTypeDocumentAction;


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