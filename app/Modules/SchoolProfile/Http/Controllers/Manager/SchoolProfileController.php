<?php
namespace App\Modules\SchoolProfile\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\SchoolProfile\Domain\Repositories\ISchoolProfileRepository;


// Requests
use App\Modules\SchoolProfile\Http\Requests\Manager\CreateSchoolProfileRequest;
use App\Modules\SchoolProfile\Http\Requests\Manager\UpdateSchoolProfileRequest;
use App\Modules\SchoolProfile\Http\Requests\Manager\ListSchoolProfileRequest;
use App\Modules\SchoolProfile\Http\Requests\Manager\SearchSchoolProfileRequest;

// DTOs
use App\Modules\SchoolProfile\Application\DTOs\CreateSchoolProfileDTO;
use App\Modules\SchoolProfile\Application\DTOs\UpdateSchoolProfileDTO;
use App\Modules\SchoolProfile\Application\DTOs\SearchSchoolProfileDTO;

// Actions
use App\Modules\SchoolProfile\Application\Actions\CreateSchoolProfileAction;
use App\Modules\SchoolProfile\Application\Actions\UpdateSchoolProfileAction;
use App\Modules\SchoolProfile\Application\Actions\DeleteSchoolProfileAction;
use App\Modules\SchoolProfile\Application\Actions\IndexSchoolProfileAction;
use App\Modules\SchoolProfile\Application\Actions\ListSchoolProfileAction;
use App\Modules\SchoolProfile\Application\Actions\SearchSchoolProfileAction;


class SchoolProfileController extends Controller
{
	protected ISchoolProfileRepository $repository;

	public function __construct(
		ISchoolProfileRepository $repository,

		private CreateSchoolProfileAction $oCreateSchoolProfileAction,
		private UpdateSchoolProfileAction $oUpdateSchoolProfileAction,
		private DeleteSchoolProfileAction $oDeleteSchoolProfileAction,
		private IndexSchoolProfileAction $oIndexSchoolProfileAction,
		private ListSchoolProfileAction $oListSchoolProfileAction,
		private SearchSchoolProfileAction $oSearchSchoolProfileAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateSchoolProfileRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateSchoolProfileDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateSchoolProfileAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateSchoolProfileRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateSchoolProfileDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateSchoolProfileAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_SchoolProfile)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteSchoolProfileAction->execute($Id_SchoolProfile);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_SchoolProfile)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexSchoolProfileAction->execute($Id_SchoolProfile);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(int $Id_School, ListSchoolProfileRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListSchoolProfileAction->execute($Id_School, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(int $Id_School, SearchSchoolProfileRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchSchoolProfileDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchSchoolProfileAction->execute($Id_School, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}