<?php
namespace App\Modules\School\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\School\Domain\Repositories\ISchoolRepository;


// Requests
use App\Modules\School\Http\Requests\Manager\CreateSchoolRequest;
use App\Modules\School\Http\Requests\Manager\UpdateSchoolRequest;
use App\Modules\School\Http\Requests\Manager\ListSchoolRequest;
use App\Modules\School\Http\Requests\Manager\SearchSchoolRequest;

// DTOs
use App\Modules\School\Application\DTOs\CreateSchoolDTO;
use App\Modules\School\Application\DTOs\UpdateSchoolDTO;
use App\Modules\School\Application\DTOs\SearchSchoolDTO;

// Actions
use App\Modules\School\Application\Actions\CreateSchoolAction;
use App\Modules\School\Application\Actions\UpdateSchoolAction;
use App\Modules\School\Application\Actions\DeleteSchoolAction;
use App\Modules\School\Application\Actions\IndexSchoolAction;
use App\Modules\School\Application\Actions\ListSchoolAction;
use App\Modules\School\Application\Actions\SearchSchoolAction;


class SchoolController extends Controller
{
	protected ISchoolRepository $repository;

	public function __construct(
		ISchoolRepository $repository,

		private CreateSchoolAction $oCreateSchoolAction,
		private UpdateSchoolAction $oUpdateSchoolAction,
		private DeleteSchoolAction $oDeleteSchoolAction,
		private IndexSchoolAction $oIndexSchoolAction,
		private ListSchoolAction $oListSchoolAction,
		private SearchSchoolAction $oSearchSchoolAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateSchoolRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateSchoolDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateSchoolAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateSchoolRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateSchoolDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateSchoolAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_School)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteSchoolAction->execute($Id_School);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_School)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexSchoolAction->execute($Id_School);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListSchoolRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListSchoolAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchSchoolRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchSchoolDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchSchoolAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}