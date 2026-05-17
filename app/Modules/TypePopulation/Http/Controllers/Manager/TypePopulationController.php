<?php

namespace App\Modules\TypePopulation\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\TypePopulation\Domain\Repositories\ITypePopulationRepository;


// Requests
use App\Modules\TypePopulation\Http\Requests\Manager\CreateTypePopulationRequest;
use App\Modules\TypePopulation\Http\Requests\Manager\UpdateTypePopulationRequest;
use App\Modules\TypePopulation\Http\Requests\Manager\ListTypePopulationRequest;
use App\Modules\TypePopulation\Http\Requests\Manager\SearchTypePopulationRequest;

// DTOs
use App\Modules\TypePopulation\Application\DTOs\CreateTypePopulationDTO;
use App\Modules\TypePopulation\Application\DTOs\UpdateTypePopulationDTO;
use App\Modules\TypePopulation\Application\DTOs\SearchTypePopulationDTO;

// Actions
use App\Modules\TypePopulation\Application\Actions\CreateTypePopulationAction;
use App\Modules\TypePopulation\Application\Actions\UpdateTypePopulationAction;
use App\Modules\TypePopulation\Application\Actions\DeleteTypePopulationAction;
use App\Modules\TypePopulation\Application\Actions\IndexTypePopulationAction;
use App\Modules\TypePopulation\Application\Actions\ListTypePopulationAction;
use App\Modules\TypePopulation\Application\Actions\SearchTypePopulationAction;


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