<?php
namespace App\Http\Controllers\Manager\TypeSchool;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\TypeSchool\Repositories\ITypeSchoolRepository;


// Requests
use App\Http\Controllers\Manager\TypeSchool\Requests\CreateTypeSchoolRequest;
use App\Http\Controllers\Manager\TypeSchool\Requests\UpdateTypeSchoolRequest;
use App\Http\Controllers\Manager\TypeSchool\Requests\ListTypeSchoolRequest;
use App\Http\Controllers\Manager\TypeSchool\Requests\SearchTypeSchoolRequest;

// DTOs
use App\Application\TypeSchool\DTOs\CreateTypeSchoolDTO;
use App\Application\TypeSchool\DTOs\UpdateTypeSchoolDTO;
use App\Application\TypeSchool\DTOs\SearchTypeSchoolDTO;

// Actions
use App\Application\TypeSchool\Actions\CreateTypeSchoolAction;
use App\Application\TypeSchool\Actions\UpdateTypeSchoolAction;
use App\Application\TypeSchool\Actions\DeleteTypeSchoolAction;
use App\Application\TypeSchool\Actions\IndexTypeSchoolAction;
use App\Application\TypeSchool\Actions\ListTypeSchoolAction;
use App\Application\TypeSchool\Actions\SearchTypeSchoolAction;


class TypeSchoolController extends Controller
{
	protected ITypeSchoolRepository $repository;

	public function __construct(
		ITypeSchoolRepository $repository,

		private CreateTypeSchoolAction $oCreateTypeSchoolAction,
		private UpdateTypeSchoolAction $oUpdateTypeSchoolAction,
		private DeleteTypeSchoolAction $oDeleteTypeSchoolAction,
		private IndexTypeSchoolAction $oIndexTypeSchoolAction,
		private ListTypeSchoolAction $oListTypeSchoolAction,
		private SearchTypeSchoolAction $oSearchTypeSchoolAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypeSchoolRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypeSchoolDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypeSchoolAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypeSchoolRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypeSchoolDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypeSchoolAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypeSchool)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypeSchoolAction->execute($Id_TypeSchool);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypeSchool)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypeSchoolAction->execute($Id_TypeSchool);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypeSchoolRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypeSchoolAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypeSchoolRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypeSchoolDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypeSchoolAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}