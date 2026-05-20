<?php

namespace App\Modules\TypeSchool\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\TypeSchool\Domain\Repositories\ITypeSchoolRepository;


// Requests
use App\Modules\TypeSchool\Http\Requests\Manager\CreateTypeSchoolRequest;
use App\Modules\TypeSchool\Http\Requests\Manager\UpdateTypeSchoolRequest;
use App\Modules\TypeSchool\Http\Requests\Manager\ListTypeSchoolRequest;
use App\Modules\TypeSchool\Http\Requests\Manager\SearchTypeSchoolRequest;

// DTOs
use App\Modules\TypeSchool\Application\DTOs\CreateTypeSchoolDTO;
use App\Modules\TypeSchool\Application\DTOs\UpdateTypeSchoolDTO;
use App\Modules\TypeSchool\Application\DTOs\SearchTypeSchoolDTO;

// Actions
use App\Modules\TypeSchool\Application\Actions\CreateTypeSchoolAction;
use App\Modules\TypeSchool\Application\Actions\UpdateTypeSchoolAction;
use App\Modules\TypeSchool\Application\Actions\DeleteTypeSchoolAction;
use App\Modules\TypeSchool\Application\Actions\IndexTypeSchoolAction;
use App\Modules\TypeSchool\Application\Actions\ListTypeSchoolAction;
use App\Modules\TypeSchool\Application\Actions\SearchTypeSchoolAction;


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