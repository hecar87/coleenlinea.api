<?php

namespace App\Modules\District\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\District\Domain\Repositories\IDistrictRepository;


// Requests
use App\Modules\District\Http\Requests\Manager\CreateDistrictRequest;
use App\Modules\District\Http\Requests\Manager\UpdateDistrictRequest;
use App\Modules\District\Http\Requests\Manager\ListDistrictRequest;
use App\Modules\District\Http\Requests\Manager\SearchDistrictRequest;

// DTOs
use App\Modules\District\Application\DTOs\CreateDistrictDTO;
use App\Modules\District\Application\DTOs\UpdateDistrictDTO;
use App\Modules\District\Application\DTOs\SearchDistrictDTO;

// Actions
use App\Modules\District\Application\Actions\CreateDistrictAction;
use App\Modules\District\Application\Actions\UpdateDistrictAction;
use App\Modules\District\Application\Actions\DeleteDistrictAction;
use App\Modules\District\Application\Actions\IndexDistrictAction;
use App\Modules\District\Application\Actions\ListDistrictAction;
use App\Modules\District\Application\Actions\SearchDistrictAction;


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