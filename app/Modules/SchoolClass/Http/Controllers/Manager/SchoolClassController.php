<?php
namespace App\Modules\SchoolClass\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\SchoolClass\Domain\Repositories\ISchoolClassRepository;


// Requests
use App\Modules\SchoolClass\Http\Requests\Manager\CreateSchoolClassRequest;
use App\Modules\SchoolClass\Http\Requests\Manager\UpdateSchoolClassRequest;
use App\Modules\SchoolClass\Http\Requests\Manager\ListSchoolClassRequest;
use App\Modules\SchoolClass\Http\Requests\Manager\SearchSchoolClassRequest;

// DTOs
use App\Modules\SchoolClass\Application\DTOs\CreateSchoolClassDTO;
use App\Modules\SchoolClass\Application\DTOs\UpdateSchoolClassDTO;
use App\Modules\SchoolClass\Application\DTOs\SearchSchoolClassDTO;

// Actions
use App\Modules\SchoolClass\Application\Actions\CreateSchoolClassAction;
use App\Modules\SchoolClass\Application\Actions\UpdateSchoolClassAction;
use App\Modules\SchoolClass\Application\Actions\DeleteSchoolClassAction;
use App\Modules\SchoolClass\Application\Actions\IndexSchoolClassAction;
use App\Modules\SchoolClass\Application\Actions\ListSchoolClassAction;
use App\Modules\SchoolClass\Application\Actions\SearchSchoolClassAction;


class SchoolClassController extends Controller
{
	protected ISchoolClassRepository $repository;

	public function __construct(
		ISchoolClassRepository $repository,

		private CreateSchoolClassAction $oCreateSchoolClassAction,
		private UpdateSchoolClassAction $oUpdateSchoolClassAction,
		private DeleteSchoolClassAction $oDeleteSchoolClassAction,
		private IndexSchoolClassAction $oIndexSchoolClassAction,
		private ListSchoolClassAction $oListSchoolClassAction,
		private SearchSchoolClassAction $oSearchSchoolClassAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateSchoolClassRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateSchoolClassDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateSchoolClassAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateSchoolClassRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateSchoolClassDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateSchoolClassAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_SchoolClass)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteSchoolClassAction->execute($Id_SchoolClass);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_SchoolClass)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexSchoolClassAction->execute($Id_SchoolClass);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(int $Id_School, ListSchoolClassRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListSchoolClassAction->execute($Id_School, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(int $Id_School, SearchSchoolClassRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchSchoolClassDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchSchoolClassAction->execute($Id_School, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}