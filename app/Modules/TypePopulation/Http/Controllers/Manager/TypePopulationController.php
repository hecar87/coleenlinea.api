<?php
namespace App\Http\Controllers\Manager\TypePopulation;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\TypePopulation\Repositories\ITypePopulationRepository;


// Requests
use App\Http\Controllers\Manager\TypePopulation\Requests\CreateTypePopulationRequest;
use App\Http\Controllers\Manager\TypePopulation\Requests\UpdateTypePopulationRequest;
use App\Http\Controllers\Manager\TypePopulation\Requests\ListTypePopulationRequest;
use App\Http\Controllers\Manager\TypePopulation\Requests\SearchTypePopulationRequest;

// DTOs
use App\Application\TypePopulation\DTOs\CreateTypePopulationDTO;
use App\Application\TypePopulation\DTOs\UpdateTypePopulationDTO;
use App\Application\TypePopulation\DTOs\SearchTypePopulationDTO;

// Actions
use App\Application\TypePopulation\Actions\CreateTypePopulationAction;
use App\Application\TypePopulation\Actions\UpdateTypePopulationAction;
use App\Application\TypePopulation\Actions\DeleteTypePopulationAction;
use App\Application\TypePopulation\Actions\IndexTypePopulationAction;
use App\Application\TypePopulation\Actions\ListTypePopulationAction;
use App\Application\TypePopulation\Actions\SearchTypePopulationAction;


class TypePopulationController extends Controller
{
	protected ITypePopulationRepository $repository;

	public function __construct(
		ITypePopulationRepository $repository,

		private CreateTypePopulationAction $oCreateTypePopulationAction,
		private UpdateTypePopulationAction $oUpdateTypePopulationAction,
		private DeleteTypePopulationAction $oDeleteTypePopulationAction,
		private IndexTypePopulationAction $oIndexTypePopulationAction,
		private ListTypePopulationAction $oListTypePopulationAction,
		private SearchTypePopulationAction $oSearchTypePopulationAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypePopulationRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypePopulationDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypePopulationAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypePopulationRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypePopulationDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypePopulationAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypePopulation)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypePopulationAction->execute($Id_TypePopulation);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypePopulation)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypePopulationAction->execute($Id_TypePopulation);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypePopulationRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypePopulationAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypePopulationRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypePopulationDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypePopulationAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}