<?php
namespace App\Http\Controllers\Manager\City;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\City\Repositories\ICityRepository;


// Requests
use App\Http\Controllers\Manager\City\Requests\CreateCityRequest;
use App\Http\Controllers\Manager\City\Requests\UpdateCityRequest;
use App\Http\Controllers\Manager\City\Requests\ListCityRequest;
use App\Http\Controllers\Manager\City\Requests\SearchCityRequest;

// DTOs
use App\Application\City\DTOs\CreateCityDTO;
use App\Application\City\DTOs\UpdateCityDTO;
use App\Application\City\DTOs\SearchCityDTO;

// Actions
use App\Application\City\Actions\CreateCityAction;
use App\Application\City\Actions\UpdateCityAction;
use App\Application\City\Actions\DeleteCityAction;
use App\Application\City\Actions\IndexCityAction;
use App\Application\City\Actions\ListCityAction;
use App\Application\City\Actions\SearchCityAction;


class CityController extends Controller
{
	protected ICityRepository $repository;

	public function __construct(
		ICityRepository $repository,

		private CreateCityAction $oCreateCityAction,
		private UpdateCityAction $oUpdateCityAction,
		private DeleteCityAction $oDeleteCityAction,
		private IndexCityAction $oIndexCityAction,
		private ListCityAction $oListCityAction,
		private SearchCityAction $oSearchCityAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateCityRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateCityDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateCityAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateCityRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateCityDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateCityAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_City)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteCityAction->execute($Id_City);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_City)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexCityAction->execute($Id_City);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(int $Id_State, ListCityRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListCityAction->execute($Id_State, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(int $Id_State, SearchCityRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchCityDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchCityAction->execute($Id_State, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}