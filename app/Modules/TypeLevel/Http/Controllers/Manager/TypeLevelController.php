<?php

namespace App\Modules\TypeLevel\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\TypeLevel\Domain\Repositories\ITypeLevelRepository;


// Requests
use App\Modules\TypeLevel\Http\Requests\Manager\CreateTypeLevelRequest;
use App\Modules\TypeLevel\Http\Requests\Manager\UpdateTypeLevelRequest;
use App\Modules\TypeLevel\Http\Requests\Manager\ListTypeLevelRequest;
use App\Modules\TypeLevel\Http\Requests\Manager\SearchTypeLevelRequest;

// DTOs
use App\Modules\TypeLevel\Application\DTOs\CreateTypeLevelDTO;
use App\Modules\TypeLevel\Application\DTOs\UpdateTypeLevelDTO;
use App\Modules\TypeLevel\Application\DTOs\SearchTypeLevelDTO;

// Actions
use App\Modules\TypeLevel\Application\Actions\CreateTypeLevelAction;
use App\Modules\TypeLevel\Application\Actions\UpdateTypeLevelAction;
use App\Modules\TypeLevel\Application\Actions\DeleteTypeLevelAction;
use App\Modules\TypeLevel\Application\Actions\IndexTypeLevelAction;
use App\Modules\TypeLevel\Application\Actions\ListTypeLevelAction;
use App\Modules\TypeLevel\Application\Actions\SearchTypeLevelAction;


class TypeLevelController extends Controller
{
	protected ITypeLevelRepository $repository;

	public function __construct(
		ITypeLevelRepository $repository,

		private CreateTypeLevelAction $oCreateTypeLevelAction,
		private UpdateTypeLevelAction $oUpdateTypeLevelAction,
		private DeleteTypeLevelAction $oDeleteTypeLevelAction,
		private IndexTypeLevelAction $oIndexTypeLevelAction,
		private ListTypeLevelAction $oListTypeLevelAction,
		private SearchTypeLevelAction $oSearchTypeLevelAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypeLevelRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypeLevelDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypeLevelAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypeLevelRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypeLevelDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypeLevelAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypeLevel)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypeLevelAction->execute($Id_TypeLevel);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypeLevel)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypeLevelAction->execute($Id_TypeLevel);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypeLevelRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypeLevelAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypeLevelRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypeLevelDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypeLevelAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}