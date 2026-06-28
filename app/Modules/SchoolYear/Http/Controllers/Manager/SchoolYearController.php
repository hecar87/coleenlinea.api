<?php
namespace App\Modules\SchoolYear\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\SchoolYear\Domain\Repositories\ISchoolYearRepository;


// Requests
use App\Modules\SchoolYear\Http\Requests\Manager\CreateSchoolYearRequest;
use App\Modules\SchoolYear\Http\Requests\Manager\UpdateSchoolYearRequest;
use App\Modules\SchoolYear\Http\Requests\Manager\ListSchoolYearRequest;
use App\Modules\SchoolYear\Http\Requests\Manager\SearchSchoolYearRequest;

// DTOs
use App\Modules\SchoolYear\Application\DTOs\CreateSchoolYearDTO;
use App\Modules\SchoolYear\Application\DTOs\UpdateSchoolYearDTO;
use App\Modules\SchoolYear\Application\DTOs\SearchSchoolYearDTO;

// Actions
use App\Modules\SchoolYear\Application\Actions\CreateSchoolYearAction;
use App\Modules\SchoolYear\Application\Actions\UpdateSchoolYearAction;
use App\Modules\SchoolYear\Application\Actions\DeleteSchoolYearAction;
use App\Modules\SchoolYear\Application\Actions\IndexSchoolYearAction;
use App\Modules\SchoolYear\Application\Actions\ListSchoolYearAction;
use App\Modules\SchoolYear\Application\Actions\SearchSchoolYearAction;


class SchoolYearController extends Controller
{
	protected ISchoolYearRepository $repository;

	public function __construct(
		ISchoolYearRepository $repository,

		private CreateSchoolYearAction $oCreateSchoolYearAction,
		private UpdateSchoolYearAction $oUpdateSchoolYearAction,
		private DeleteSchoolYearAction $oDeleteSchoolYearAction,
		private IndexSchoolYearAction $oIndexSchoolYearAction,
		private ListSchoolYearAction $oListSchoolYearAction,
		private SearchSchoolYearAction $oSearchSchoolYearAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateSchoolYearRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateSchoolYearDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateSchoolYearAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateSchoolYearRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateSchoolYearDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateSchoolYearAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_SchoolYear)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteSchoolYearAction->execute($Id_SchoolYear);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_SchoolYear)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexSchoolYearAction->execute($Id_SchoolYear);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(int $Id_School, ListSchoolYearRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListSchoolYearAction->execute($Id_School, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(int $Id_School, SearchSchoolYearRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchSchoolYearDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchSchoolYearAction->execute($Id_School, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}