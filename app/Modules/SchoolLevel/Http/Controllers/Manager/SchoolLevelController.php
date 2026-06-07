<?php
namespace App\Modules\SchoolLevel\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\SchoolLevel\Domain\Repositories\ISchoolLevelRepository;


// Requests
use App\Modules\SchoolLevel\Http\Requests\Manager\CreateSchoolLevelRequest;
use App\Modules\SchoolLevel\Http\Requests\Manager\UpdateSchoolLevelRequest;
use App\Modules\SchoolLevel\Http\Requests\Manager\ListSchoolLevelRequest;
use App\Modules\SchoolLevel\Http\Requests\Manager\SearchSchoolLevelRequest;

// DTOs
use App\Modules\SchoolLevel\Application\DTOs\CreateSchoolLevelDTO;
use App\Modules\SchoolLevel\Application\DTOs\UpdateSchoolLevelDTO;
use App\Modules\SchoolLevel\Application\DTOs\SearchSchoolLevelDTO;

// Actions
use App\Modules\SchoolLevel\Application\Actions\CreateSchoolLevelAction;
use App\Modules\SchoolLevel\Application\Actions\UpdateSchoolLevelAction;
use App\Modules\SchoolLevel\Application\Actions\DeleteSchoolLevelAction;
use App\Modules\SchoolLevel\Application\Actions\IndexSchoolLevelAction;
use App\Modules\SchoolLevel\Application\Actions\ListSchoolLevelAction;
use App\Modules\SchoolLevel\Application\Actions\SearchSchoolLevelAction;


class SchoolLevelController extends Controller
{
	protected ISchoolLevelRepository $repository;

	public function __construct(
		ISchoolLevelRepository $repository,

		private CreateSchoolLevelAction $oCreateSchoolLevelAction,
		private UpdateSchoolLevelAction $oUpdateSchoolLevelAction,
		private DeleteSchoolLevelAction $oDeleteSchoolLevelAction,
		private IndexSchoolLevelAction $oIndexSchoolLevelAction,
		private ListSchoolLevelAction $oListSchoolLevelAction,
		private SearchSchoolLevelAction $oSearchSchoolLevelAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateSchoolLevelRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateSchoolLevelDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateSchoolLevelAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateSchoolLevelRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateSchoolLevelDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateSchoolLevelAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_SchoolLevel)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteSchoolLevelAction->execute($Id_SchoolLevel);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_SchoolLevel)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexSchoolLevelAction->execute($Id_SchoolLevel);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(int $Id_School, ListSchoolLevelRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListSchoolLevelAction->execute($Id_School, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(int $Id_School, SearchSchoolLevelRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchSchoolLevelDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchSchoolLevelAction->execute($Id_School, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}