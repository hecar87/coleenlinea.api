<?php

namespace App\Modules\TypeCivil\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\TypeCivil\Domain\Repositories\ITypeCivilRepository;


// Requests
use App\Modules\TypeCivil\Http\Requests\Manager\CreateTypeCivilRequest;
use App\Modules\TypeCivil\Http\Requests\Manager\UpdateTypeCivilRequest;
use App\Modules\TypeCivil\Http\Requests\Manager\ListTypeCivilRequest;
use App\Modules\TypeCivil\Http\Requests\Manager\SearchTypeCivilRequest;

// DTOs
use App\Modules\TypeCivil\Application\DTOs\CreateTypeCivilDTO;
use App\Modules\TypeCivil\Application\DTOs\UpdateTypeCivilDTO;
use App\Modules\TypeCivil\Application\DTOs\SearchTypeCivilDTO;

// Actions
use App\Modules\TypeCivil\Application\Actions\CreateTypeCivilAction;
use App\Modules\TypeCivil\Application\Actions\UpdateTypeCivilAction;
use App\Modules\TypeCivil\Application\Actions\DeleteTypeCivilAction;
use App\Modules\TypeCivil\Application\Actions\IndexTypeCivilAction;
use App\Modules\TypeCivil\Application\Actions\ListTypeCivilAction;
use App\Modules\TypeCivil\Application\Actions\SearchTypeCivilAction;


class TypeCivilController extends Controller
{
	protected ITypeCivilRepository $repository;

	public function __construct(
		ITypeCivilRepository $repository,

		private CreateTypeCivilAction $oCreateTypeCivilAction,
		private UpdateTypeCivilAction $oUpdateTypeCivilAction,
		private DeleteTypeCivilAction $oDeleteTypeCivilAction,
		private IndexTypeCivilAction $oIndexTypeCivilAction,
		private ListTypeCivilAction $oListTypeCivilAction,
		private SearchTypeCivilAction $oSearchTypeCivilAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypeCivilRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypeCivilDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypeCivilAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypeCivilRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypeCivilDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypeCivilAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypeCivil)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypeCivilAction->execute($Id_TypeCivil);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypeCivil)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypeCivilAction->execute($Id_TypeCivil);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypeCivilRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypeCivilAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypeCivilRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypeCivilDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypeCivilAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}