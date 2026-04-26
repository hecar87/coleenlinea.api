<?php
namespace App\Http\Controllers\Manager\State;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\State\Repositories\IStateRepository;


// Requests
use App\Http\Controllers\Manager\State\Requests\CreateStateRequest;
use App\Http\Controllers\Manager\State\Requests\UpdateStateRequest;
use App\Http\Controllers\Manager\State\Requests\ListStateRequest;
use App\Http\Controllers\Manager\State\Requests\SearchStateRequest;

// DTOs
use App\Application\State\DTOs\CreateStateDTO;
use App\Application\State\DTOs\UpdateStateDTO;
use App\Application\State\DTOs\SearchStateDTO;

// Actions
use App\Application\State\Actions\CreateStateAction;
use App\Application\State\Actions\UpdateStateAction;
use App\Application\State\Actions\DeleteStateAction;
use App\Application\State\Actions\IndexStateAction;
use App\Application\State\Actions\ListStateAction;
use App\Application\State\Actions\SearchStateAction;


class StateController extends Controller
{
	protected IStateRepository $repository;

	public function __construct(
		IStateRepository $repository,

		private CreateStateAction $oCreateStateAction,
		private UpdateStateAction $oUpdateStateAction,
		private DeleteStateAction $oDeleteStateAction,
		private IndexStateAction $oIndexStateAction,
		private ListStateAction $oListStateAction,
		private SearchStateAction $oSearchStateAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateStateRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateStateDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateStateAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateStateRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateStateDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateStateAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_State)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteStateAction->execute($Id_State);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_State)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexStateAction->execute($Id_State);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListStateRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListStateAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchStateRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchStateDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchStateAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}