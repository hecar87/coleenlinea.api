<?php

namespace App\Modules\TypeGender\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\TypeGender\Domain\Repositories\ITypeGenderRepository;


// Requests
use App\Modules\TypeGender\Http\Requests\Manager\CreateTypeGenderRequest;
use App\Modules\TypeGender\Http\Requests\Manager\UpdateTypeGenderRequest;
use App\Modules\TypeGender\Http\Requests\Manager\ListTypeGenderRequest;
use App\Modules\TypeGender\Http\Requests\Manager\SearchTypeGenderRequest;

// DTOs
use App\Modules\TypeGender\Application\DTOs\CreateTypeGenderDTO;
use App\Modules\TypeGender\Application\DTOs\UpdateTypeGenderDTO;
use App\Modules\TypeGender\Application\DTOs\SearchTypeGenderDTO;

// Actions
use App\Modules\TypeGender\Application\Actions\CreateTypeGenderAction;
use App\Modules\TypeGender\Application\Actions\UpdateTypeGenderAction;
use App\Modules\TypeGender\Application\Actions\DeleteTypeGenderAction;
use App\Modules\TypeGender\Application\Actions\IndexTypeGenderAction;
use App\Modules\TypeGender\Application\Actions\ListTypeGenderAction;
use App\Modules\TypeGender\Application\Actions\SearchTypeGenderAction;


class TypeGenderController extends Controller
{
	protected ITypeGenderRepository $repository;

	public function __construct(
		ITypeGenderRepository $repository,

		private CreateTypeGenderAction $oCreateTypeGenderAction,
		private UpdateTypeGenderAction $oUpdateTypeGenderAction,
		private DeleteTypeGenderAction $oDeleteTypeGenderAction,
		private IndexTypeGenderAction $oIndexTypeGenderAction,
		private ListTypeGenderAction $oListTypeGenderAction,
		private SearchTypeGenderAction $oSearchTypeGenderAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypeGenderRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypeGenderDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypeGenderAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypeGenderRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypeGenderDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypeGenderAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypeGender)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypeGenderAction->execute($Id_TypeGender);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypeGender)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypeGenderAction->execute($Id_TypeGender);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypeGenderRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypeGenderAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypeGenderRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypeGenderDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypeGenderAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}