<?php
namespace App\Modules\State\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\State\Domain\Repositories\IStateRepository;


// Requests
use App\Modules\State\Http\Requests\Manager\CreateStateRequest;
use App\Modules\State\Http\Requests\Manager\UpdateStateRequest;
use App\Modules\State\Http\Requests\Manager\ListStateRequest;
use App\Modules\State\Http\Requests\Manager\SearchStateRequest;

// DTOs
use App\Modules\State\Application\DTOs\CreateStateDTO;
use App\Modules\State\Application\DTOs\UpdateStateDTO;
use App\Modules\State\Application\DTOs\SearchStateDTO;

// Actions
use App\Modules\State\Application\Actions\CreateStateAction;
use App\Modules\State\Application\Actions\UpdateStateAction;
use App\Modules\State\Application\Actions\DeleteStateAction;
use App\Modules\State\Application\Actions\IndexStateAction;
use App\Modules\State\Application\Actions\ListStateAction;
use App\Modules\State\Application\Actions\SearchStateAction;


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