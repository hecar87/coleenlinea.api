<?php
namespace App\Http\Controllers\Manager\TypeLevel;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\TypeLevel\Repositories\ITypeLevelRepository;


// Requests
use App\Http\Controllers\Manager\TypeLevel\Requests\CreateTypeLevelRequest;
use App\Http\Controllers\Manager\TypeLevel\Requests\UpdateTypeLevelRequest;
use App\Http\Controllers\Manager\TypeLevel\Requests\ListTypeLevelRequest;
use App\Http\Controllers\Manager\TypeLevel\Requests\SearchTypeLevelRequest;

// DTOs
use App\Application\TypeLevel\DTOs\CreateTypeLevelDTO;
use App\Application\TypeLevel\DTOs\UpdateTypeLevelDTO;
use App\Application\TypeLevel\DTOs\SearchTypeLevelDTO;

// Actions
use App\Application\TypeLevel\Actions\CreateTypeLevelAction;
use App\Application\TypeLevel\Actions\UpdateTypeLevelAction;
use App\Application\TypeLevel\Actions\DeleteTypeLevelAction;
use App\Application\TypeLevel\Actions\IndexTypeLevelAction;
use App\Application\TypeLevel\Actions\ListTypeLevelAction;
use App\Application\TypeLevel\Actions\SearchTypeLevelAction;


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