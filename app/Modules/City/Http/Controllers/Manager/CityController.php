<?php
namespace App\Http\Controllers\Manager\City;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\City\Domain\Repositories\ICityRepository;


// Requests
use App\Modules\City\Http\Requests\Manager\CreateCityRequest;
use App\Modules\City\Http\Requests\Manager\UpdateCityRequest;
use App\Modules\City\Http\Requests\Manager\ListCityRequest;
use App\Modules\City\Http\Requests\Manager\SearchCityRequest;

// DTOs
use App\Modules\City\Application\DTOs\CreateCityDTO;
use App\Modules\City\Application\DTOs\UpdateCityDTO;
use App\Modules\City\Application\DTOs\SearchCityDTO;

// Actions
use App\Modules\City\Application\Actions\CreateCityAction;
use App\Modules\City\Application\Actions\UpdateCityAction;
use App\Modules\City\Application\Actions\DeleteCityAction;
use App\Modules\City\Application\Actions\IndexCityAction;
use App\Modules\City\Application\Actions\ListCityAction;
use App\Modules\City\Application\Actions\SearchCityAction;


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