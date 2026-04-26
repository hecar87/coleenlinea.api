<?php
namespace App\Http\Controllers\Manager\District;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\District\Repositories\IDistrictRepository;


// Requests
use App\Http\Controllers\Manager\District\Requests\CreateDistrictRequest;
use App\Http\Controllers\Manager\District\Requests\UpdateDistrictRequest;
use App\Http\Controllers\Manager\District\Requests\ListDistrictRequest;
use App\Http\Controllers\Manager\District\Requests\SearchDistrictRequest;

// DTOs
use App\Application\District\DTOs\CreateDistrictDTO;
use App\Application\District\DTOs\UpdateDistrictDTO;
use App\Application\District\DTOs\SearchDistrictDTO;

// Actions
use App\Application\District\Actions\CreateDistrictAction;
use App\Application\District\Actions\UpdateDistrictAction;
use App\Application\District\Actions\DeleteDistrictAction;
use App\Application\District\Actions\IndexDistrictAction;
use App\Application\District\Actions\ListDistrictAction;
use App\Application\District\Actions\SearchDistrictAction;


class DistrictController extends Controller
{
	protected IDistrictRepository $repository;

	public function __construct(
		IDistrictRepository $repository,

		private CreateDistrictAction $oCreateDistrictAction,
		private UpdateDistrictAction $oUpdateDistrictAction,
		private DeleteDistrictAction $oDeleteDistrictAction,
		private IndexDistrictAction $oIndexDistrictAction,
		private ListDistrictAction $oListDistrictAction,
		private SearchDistrictAction $oSearchDistrictAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateDistrictRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateDistrictDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateDistrictAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateDistrictRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateDistrictDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateDistrictAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_District)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteDistrictAction->execute($Id_District);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_District)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexDistrictAction->execute($Id_District);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(int $Id_City, ListDistrictRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListDistrictAction->execute($Id_City, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(int $Id_City, SearchDistrictRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchDistrictDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchDistrictAction->execute($Id_City,$oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}