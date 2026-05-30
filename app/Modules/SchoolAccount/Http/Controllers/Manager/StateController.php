<?php
namespace App\Modules\SchoolAccount\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\SchoolAccount\Domain\Repositories\ISchoolAccountRepository;


// Requests
use App\Modules\SchoolAccount\Http\Requests\Manager\CreateSchoolAccountRequest;
use App\Modules\SchoolAccount\Http\Requests\Manager\UpdateSchoolAccountRequest;
use App\Modules\SchoolAccount\Http\Requests\Manager\ListSchoolAccountRequest;
use App\Modules\SchoolAccount\Http\Requests\Manager\SearchSchoolAccountRequest;

// DTOs
use App\Modules\SchoolAccount\Application\DTOs\CreateSchoolAccountDTO;
use App\Modules\SchoolAccount\Application\DTOs\UpdateSchoolAccountDTO;
use App\Modules\SchoolAccount\Application\DTOs\SearchSchoolAccountDTO;

// Actions
use App\Modules\SchoolAccount\Application\Actions\CreateSchoolAccountAction;
use App\Modules\SchoolAccount\Application\Actions\UpdateSchoolAccountAction;
use App\Modules\SchoolAccount\Application\Actions\DeleteSchoolAccountAction;
use App\Modules\SchoolAccount\Application\Actions\IndexSchoolAccountAction;
use App\Modules\SchoolAccount\Application\Actions\ListSchoolAccountAction;
use App\Modules\SchoolAccount\Application\Actions\SearchSchoolAccountAction;


class SchoolAccountController extends Controller
{
	protected ISchoolAccountRepository $repository;

	public function __construct(
		ISchoolAccountRepository $repository,

		private CreateSchoolAccountAction $oCreateSchoolAccountAction,
		private UpdateSchoolAccountAction $oUpdateSchoolAccountAction,
		private DeleteSchoolAccountAction $oDeleteSchoolAccountAction,
		private IndexSchoolAccountAction $oIndexSchoolAccountAction,
		private ListSchoolAccountAction $oListSchoolAccountAction,
		private SearchSchoolAccountAction $oSearchSchoolAccountAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateSchoolAccountRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateSchoolAccountDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateSchoolAccountAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateSchoolAccountRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateSchoolAccountDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateSchoolAccountAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_SchoolAccount)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteSchoolAccountAction->execute($Id_SchoolAccount);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_SchoolAccount)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexSchoolAccountAction->execute($Id_SchoolAccount);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListSchoolAccountRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListSchoolAccountAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchSchoolAccountRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchSchoolAccountDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchSchoolAccountAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}