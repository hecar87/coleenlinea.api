<?php
namespace App\Modules\SchoolBranch\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\SchoolBranch\Domain\Repositories\ISchoolBranchRepository;


// Requests
use App\Modules\SchoolBranch\Http\Requests\Manager\CreateSchoolBranchRequest;
use App\Modules\SchoolBranch\Http\Requests\Manager\UpdateSchoolBranchRequest;
use App\Modules\SchoolBranch\Http\Requests\Manager\ListSchoolBranchRequest;
use App\Modules\SchoolBranch\Http\Requests\Manager\SearchSchoolBranchRequest;

// DTOs
use App\Modules\SchoolBranch\Application\DTOs\CreateSchoolBranchDTO;
use App\Modules\SchoolBranch\Application\DTOs\UpdateSchoolBranchDTO;
use App\Modules\SchoolBranch\Application\DTOs\SearchSchoolBranchDTO;

// Actions
use App\Modules\SchoolBranch\Application\Actions\CreateSchoolBranchAction;
use App\Modules\SchoolBranch\Application\Actions\UpdateSchoolBranchAction;
use App\Modules\SchoolBranch\Application\Actions\DeleteSchoolBranchAction;
use App\Modules\SchoolBranch\Application\Actions\IndexSchoolBranchAction;
use App\Modules\SchoolBranch\Application\Actions\ListSchoolBranchAction;
use App\Modules\SchoolBranch\Application\Actions\SearchSchoolBranchAction;


class SchoolBranchController extends Controller
{
	protected ISchoolBranchRepository $repository;

	public function __construct(
		ISchoolBranchRepository $repository,

		private CreateSchoolBranchAction $oCreateSchoolBranchAction,
		private UpdateSchoolBranchAction $oUpdateSchoolBranchAction,
		private DeleteSchoolBranchAction $oDeleteSchoolBranchAction,
		private IndexSchoolBranchAction $oIndexSchoolBranchAction,
		private ListSchoolBranchAction $oListSchoolBranchAction,
		private SearchSchoolBranchAction $oSearchSchoolBranchAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateSchoolBranchRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateSchoolBranchDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateSchoolBranchAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateSchoolBranchRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateSchoolBranchDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateSchoolBranchAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_SchoolBranch)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteSchoolBranchAction->execute($Id_SchoolBranch);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_SchoolBranch)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexSchoolBranchAction->execute($Id_SchoolBranch);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(int $Id_School, ListSchoolBranchRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListSchoolBranchAction->execute($Id_School, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(int $Id_School, SearchSchoolBranchRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchSchoolBranchDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchSchoolBranchAction->execute($Id_School, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}